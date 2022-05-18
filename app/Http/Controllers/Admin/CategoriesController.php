<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\ProductSubcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    public function showCategories(Request $request)
    {
        $query = ProductCategory::query();

        // IDで検索
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // フリーワードで絞り込み
        if ($request->filled('free_word')) {
            $free_word = '%' . $this->escape($request->input('free_word')) . '%';
            $subcategories = ProductSubcategory::where('name', 'LIKE', $free_word)->whereNull('deleted_at')
                ->pluck('product_category_id');
            $query->where(function ($query) use ($free_word, $subcategories) {
                $query->where('name', 'LIKE', $free_word);
                foreach ($subcategories as $subcategory) {
                    $query->orWhere('id', $subcategory);
                }
            });
        }

        $defaults = [
            'id' => $request->input('id'),
            'free_word' => $request->input('free_word'),
        ];

        $sort = $request->get('sort');

        if ($sort == '1') {
            $categories = $query->whereNull('deleted_at')
                ->orderBy('id', 'ASC')
                ->paginate(10);
        } else {
            $categories = $query->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('admin.categories.categories')
            ->with('categories', $categories)
            ->with('defaults', $defaults)
            ->with('sort', $sort);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    private $show_register = 'Admin\CategoriesController@showRegisterForm';
    private $show_confirm = 'Admin\CategoriesController@showConfirmForm';
    private $show_edit = 'Admin\CategoriesController@showEditForm';
    private $show_edit_confirm = 'Admin\CategoriesController@showEditConfirmForm';

    private $formItems = [
        'category_name',
        'subcategory_name',
    ];

    public function showRegisterForm()
    {
        return view('admin.categories.register')
            ->with('register', true);
    }

    public function post(CategoryRequest $request)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_confirm);
    }

    public function showConfirmForm(Request $request)
    {
        $input = $request->session()->get('form_input');

        if (!$input) {
            return redirect()->action($this->show_register);
        }

        return view('admin.categories.register_confirm', [
            'input' => $input,
            'register' => true,
        ]);
    }

    public function register(Request $request)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_register)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_register);
        }

        DB::beginTransaction();

        if (count($input['subcategory_name']) <= 10) {

            $category = ProductCategory::create([
                'name' => $input['category_name'],
            ]);

            foreach ($input['subcategory_name'] as $key => $name) {
                if ($name) {
                    ProductSubcategory::create([
                        'product_category_id' => $category->id,
                        'name' => $name,
                    ]);
                }
            }
        } else {
            DB::rollBack();
            return redirect()->action($this->show_register)
                ->withErrors('※商品小カテゴリは最大10個まで入力可能です。')
                ->withInput();
        }

        DB::commit();

        $request->session()->forget('form_input');

        return redirect('/admin/categories');
    }

    public function showEditForm(ProductCategory $category)
    {
        $subcategories = $category->productSubcategories()
            ->whereNull('deleted_at')
            ->get();

        return view('admin.categories.edit')
            ->with('category', $category)
            ->with('subcategories', $subcategories)
            ->with('register', false);
    }

    public function edit(CategoryRequest $request, ProductCategory $category)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_edit_confirm, $category);
    }

    public function showEditConfirmForm(Request $request, ProductCategory $category)
    {
        $input = $request->session()->get('form_input');

        if (!$input) {
            return redirect()->action($this->show_edit, $category);
        }

        return view('admin.categories.edit_confirm')
            ->with('input', $input)
            ->with('category', $category)
            ->with('register', false);
    }

    public function update(Request $request, ProductCategory $category)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_edit, $category)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_edit, $category);
        }

        DB::beginTransaction();

        if (count($input['subcategory_name']) <= 10) {

            $category->update([
                'name' => $input['category_name'],
            ]);

            $subcategories = $category->productSubcategories()->get();
            foreach ($subcategories as $subcategory) {
                $subcategory->delete();
            }

            foreach ($input['subcategory_name'] as $key => $name) {
                if ($name) {
                    ProductSubcategory::create([
                        'product_category_id' => $category->id,
                        'name' => $name,
                    ]);
                }
            }
        } else {
            DB::rollBack();
            return redirect()->action($this->show_edit, $category->id)
                ->withErrors('※商品小カテゴリは最大10個まで入力可能です。')
                ->withInput();
        }

        DB::commit();

        $request->session()->forget('form_input');

        return redirect('/admin/categories');
    }

    public function showDetail(ProductCategory $category)
    {
        $subcategories = $category->productSubcategories()
            ->whereNull('deleted_at')
            ->get();

        return view('admin.categories.detail')
            ->with('category', $category)
            ->with('subcategories', $subcategories);
    }

    public function delete(ProductCategory $category)
    {
        $category->deleted_at = Carbon::now();
        $category->save();

        $subcategories = $category->productSubcategories()
            ->whereNull('deleted_at')
            ->get();
        foreach ($subcategories as $subcategory) {
            $subcategory->deleted_at = Carbon::now();
            $subcategory->save();
        }
        return redirect('/admin/categories');
    }
}
