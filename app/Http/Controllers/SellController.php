<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellRequest;
use App\Product;
use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        return view('sell.form')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    public function category(Request $request)
    {
        $cateVal = $request['category_val'];
        $subcategories = ProductSubcategory::where('product_category_id', $cateVal)->get();
        return response()->json($subcategories);
    }

    public function sellProduct(SellRequest $request)
    {
        $member = Auth::user();

        $product = new Product();
        $product->member_id = $member->id;
        $product->product_category_id = $request->input('product_category_id');
        $product->product_subcategory_id = $request->input('product_subcategory_id');
        $product->name = $request->input('name');
        $product->image_1 = $request->file('image_1');
        $product->image_2 = $request->file('image_2');
        $product->image_3 = $request->file('image_3');
        $product->image_4 = $request->file('image_4');
        $product->product_content = $request->input('product_content');
        $product->save();

        return redirect('/');
    }

    public function imageUpload(Request $request)
    {
        $file = $request->file('image');

        $filePath = Storage::disk('public')
            ->putFile('products', new File($file));

        return basename($filePath);
    }
}
