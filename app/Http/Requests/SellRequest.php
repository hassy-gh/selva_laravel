<?php

namespace App\Http\Requests;

use App\ProductCategory;
use App\ProductSubcategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SellRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'product_category_id' => ['required', 'integer'],
            'product_subcategory_id' => [
                'required',
                'integer',
            ],
            'image_1' => ['nullable'],
            'image_2' => ['nullable'],
            'image_3' => ['nullable'],
            'image_4' => ['nullable'],
            'product_content' => ['required', 'string', 'max:500'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $categories = ProductCategory::whereNull('deleted_at')->pluck('id')->toArray();
        $validator->sometimes('product_category_id', Rule::in($categories), function ($input) {
            return $input->product_category_id == true;
        });

        if (!is_null($this->product_category_id)) {
            $category = ProductCategory::find($this->product_category_id);
            $subcategories = $category->productSubcategories()
                ->pluck('id')
                ->toArray();

            $validator->sometimes('product_subcategory_id', Rule::in($subcategories), function ($input) {
                return $input->product_category_id == true;
            });
        }


        // $validator->sometimes('product_subcategory_id', Rule::in([1, 2, 3, 4, 5]), function ($input) {
        //     return $input->product_category_id == 1;
        // });

        // $validator->sometimes('product_subcategory_id', Rule::in([6, 7, 8, 9, 10]), function ($input) {
        //     return $input->product_category_id == 2;
        // });

        // $validator->sometimes('product_subcategory_id', Rule::in([11, 12, 13, 14, 15]), function ($input) {
        //     return $input->product_category_id == 3;
        // });

        // $validator->sometimes('product_subcategory_id', Rule::in([16, 17, 18, 19, 20]), function ($input) {
        //     return $input->product_category_id == 4;
        // });

        // $validator->sometimes('product_subcategory_id', Rule::in([21, 22, 23, 24, 25]), function ($input) {
        //     return $input->product_category_id == 5;
        // });
    }

    public function attributes()
    {
        return [
            'name' => '商品名',
            'product_category_id' => '商品カテゴリ大',
            'product_subcategory_id' => '商品カテゴリ小',
            'image_1' => '商品写真１',
            'image_2' => '商品写真２',
            'image_3' => '商品写真３',
            'image_4' => '商品写真４',
            'product_content' => '商品説明',
        ];
    }
}
