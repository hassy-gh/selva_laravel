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
    private $form_show = 'SellController@showSellForm';
    private $form_confirm = 'SellController@showConfirmForm';

    private $formItems = [
        'product_category_id',
        'product_subcategory_id',
        'name',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
        'product_content'
    ];

    public function showSellForm()
    {
        $categories = ProductCategory::whereNull('deleted_at')->get();
        $subcategories = ProductSubcategory::whereNull('deleted_at')->get();
        return view('sell.form')
            ->with('categories', $categories)
            ->with('subcategories', $subcategories);
    }

    public function sellProduct(SellRequest $request)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->form_confirm);
    }

    public function showConfirmForm(Request $request)
    {
        $input = $request->session()->get('form_input');
        $category = ProductCategory::find($input['product_category_id']);
        $subcategory = ProductSubcategory::find($input['product_subcategory_id']);

        if (!$input) {
            return redirect()->action($this->form_show);
        }

        return view('sell.confirm', [
            'input' => $input,
            'category' => $category,
            'subcategory' => $subcategory,
        ]);
    }

    public function confirm(Request $request)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->form_show)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->form_show);
        }

        $member = Auth::user();

        $product = new Product();
        $product->member_id = $member->id;
        $product->product_category_id = $input['product_category_id'];
        $product->product_subcategory_id = $input['product_subcategory_id'];
        $product->name = $input['name'];
        $product->image_1 = $input['image_1'];
        $product->image_2 = $input['image_2'];
        $product->image_3 = $input['image_3'];
        $product->image_4 = $input['image_4'];
        $product->product_content = $input['product_content'];
        $product->save();

        $request->session()->forget('form_input');

        return redirect('/products');
    }



    public function category(Request $request)
    {
        $cateVal = $request['category_val'];
        $subcategories = ProductSubcategory::where('product_category_id', $cateVal)
            ->whereNull('deleted_at')
            ->get();
        return response()->json($subcategories);
    }

    public function imageUpload(Request $request)
    {
        $file = $request->file('image');

        $filePath = Storage::disk('public')
            ->putFile('products', new File($file));

        return basename($filePath);
    }
}
