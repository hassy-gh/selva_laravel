<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use App\Http\Controllers\Controller;
use App\ProductSubcategory;
use Illuminate\Http\Request;

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

        $cateNames = config('master.product_category');

        return view('admin.categories.categories')
            ->with('categories', $categories)
            ->with('defaults', $defaults)
            ->with('sort', $sort)
            ->with('cateNames', $cateNames);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }
}
