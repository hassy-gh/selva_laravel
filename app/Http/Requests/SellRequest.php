<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
            'product_category_id' => ['required', 'integer', Rule::in([1, 2, 3, 4, 5])],
            'product_subcategory_id' => [
                'required',
                'integer',
                Rule::in([
                    1, 2, 3, 4, 5, 6, 7, 8, 9, 10,
                    11, 12, 13, 14, 15, 16, 17, 18, 19, 20,
                    21, 22, 23, 24, 25
                ])
            ],
            'image_1' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'image_2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'image_3' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'image_4' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:10240'],
            'product_content' => ['required', 'string', 'max:500'],
        ];
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
