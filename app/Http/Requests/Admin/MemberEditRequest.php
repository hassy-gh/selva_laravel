<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hankaku;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberEditRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name_sei' => ['required', 'string', 'max:20'],
            'name_mei' => ['required', 'string', 'max:20'],
            'nickname' => ['required', 'string', 'max:10'],
            'gender' => ['required', 'integer', 'in:1,2'],
            'password' => ['nullable', 'required_with:password_confirmation', 'string', new Hankaku(), 'between:8,20', 'confirmed'],
            'password_confirmation' => ['nullable', 'required_with:password', 'string', new Hankaku(), 'between:8,20'],
            'email' => [
                'required',
                'string',
                "regex:/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",
                'email',
                'max:200',
                Rule::unique('members')->ignore($request->id, 'id'),
            ],
        ];
    }
}
