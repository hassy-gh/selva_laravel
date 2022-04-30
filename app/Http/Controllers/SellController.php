<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = ProductCategory::all();
        return view('sell.form')
            ->with('categories', $categories);
    }

    public function category(Request $request)
    {
        $cateVal = $request['category_val'];
        $subcategories = ProductSubcategory::where('product_category_id', $cateVal)->get();
        return response()->json($subcategories);
    }
}
