<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductSubcategory;
use App\Review;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function showProducts(Request $request)
    {
        $query = Product::query();

        // カテゴリで検索
        if ($request->filled('product_subcategory_id')) {
            $query->where('product_subcategory_id', $request->product_subcategory_id);
        } elseif ($request->filled('product_category_id')) {
            $query->where('product_category_id', $request->product_category_id);
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
            'category' => $request->input('product_category_id'),
            'subcategory' => $request->input('product_subcategory_id'),
            'free_word' => $request->input('free_word'),
        ];

        $products = $query->orderBy('id', 'DESC')->paginate(10);
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();

        $averages = [];
        foreach ($products as $product) {
            $averages[$product->id] = $product->reviews()
                ->pluck('evaluation')
                ->avg();
        }
        $config_evaluations = config('master.evaluations');

        return view('products.products')
            ->with('products', $products)
            ->with('defaults', $defaults)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('averages', $averages)
            ->with('evaluations', $config_evaluations);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    public function showProductDetail(Product $product)
    {
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();

        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('products.product_detail')
            ->with('product', $product)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('average', $average)
            ->with('evaluations', $config_evaluations);
    }
}
