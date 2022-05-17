<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use App\ProductSubcategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function showProducts(Request $request)
    {
        $query = Product::query();

        // IDで検索
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // フリーワードで絞り込み
        if ($request->filled('free_word')) {
            $free_word = '%' . $this->escape($request->input('free_word')) . '%';
            $query->where(function ($query) use ($free_word) {
                $query->where('name', 'LIKE', $free_word);
                $query->orWhere('product_content', 'LIKE', $free_word);
            });
        }

        $defaults = [
            'id' => $request->input('id'),
            'free_word' => $request->input('free_word'),
        ];

        $sort = $request->get('sort');

        if ($sort == '1') {
            $products = $query->whereNull('deleted_at')
                ->orderBy('id', 'ASC')
                ->paginate(10);
        } else {
            $products = $query->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('admin.products.products')
            ->with('products', $products)
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

    private $show_register = 'Admin\ProductsController@showRegisterForm';
    private $show_confirm = 'Admin\ProductsController@showConfirmForm';
    private $show_edit = 'Admin\ProductsController@showEditForm';
    private $show_edit_confirm = 'Admin\ProductsController@showEditConfirmForm';

    private $formItems = [
        'product_category_id',
        'product_subcategory_id',
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'product_content',
    ];

    public function showRegisterForm()
    {
        $categories = ProductCategory::whereNull('deleted_at')->get();
        $subcategories = ProductSubcategory::whereNull('deleted_at')->get();

        return view('admin.products.register')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('register', true);
    }

    public function post(SellRequest $request)
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

        $category = ProductCategory::find($input['product_category_id']);
        $subcategory = ProductSubcategory::find($input['product_subcategory_id']);

        return view('admin.products.register_confirm', [
            'input' => $input,
            'category' => $category,
            'subcategory' => $subcategory,
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

        Product::create([
            'member_id' => 1,
            'product_category_id' => $input['product_category_id'],
            'product_subcategory_id' => $input['product_subcategory_id'],
            'name' => $input['name'],
            'image_1' => $input['image_1'],
            'image_2' => $input['image_2'],
            'image_3' => $input['image_3'],
            'image_4' => $input['image_4'],
            'product_content' => $input['product_content'],
        ]);

        $request->session()->forget('form_input');

        return redirect('/admin/products');
    }

    public function showEditForm(Product $product)
    {
        $categories = ProductCategory::whereNull('deleted_at')->get();
        $subcategories = ProductSubcategory::whereNull('deleted_at')->get();

        return view('admin.products.edit')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('register', false);
    }

    public function edit(SellRequest $request, Product $product)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_edit_confirm, $product);
    }

    public function showEditConfirmForm(Request $request, Product $product)
    {
        $input = $request->session()->get('form_input');

        $category = ProductCategory::find($input['product_category_id']);
        $subcategory = ProductSubcategory::find($input['product_subcategory_id']);

        if (!$input) {
            return redirect()->action($this->show_edit, $product);
        }

        return view('admin.products.edit_confirm')
            ->with('input', $input)
            ->with('product', $product)
            ->with('category', $category)
            ->with('subcategory', $subcategory)
            ->with('register', false);
    }

    public function update(Request $request, Product $product)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_edit, $product)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_edit, $product);
        }

        $product->update([
            'product_category_id' => $input['product_category_id'],
            'product_subcategory_id' => $input['product_subcategory_id'],
            'name' => $input['name'],
            'image_1' => $input['image_1'],
            'image_2' => $input['image_2'],
            'image_3' => $input['image_3'],
            'image_4' => $input['image_4'],
            'product_content' => $input['product_content']
        ]);

        $request->session()->forget('form_input');

        return redirect('/admin/products');
    }
}
