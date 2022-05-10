<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasswordUpdateController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|alpha_num|between:8,20|confirmed',
            'password_confirmation' => 'required|string|alpha_num|between:8,20',
        ]);
    }

    public function showPasswordEditForm()
    {
        return view('mypage.password_edit_form');
    }

    public function passwordUpdate(Request $request)
    {
        $member = Auth::user();

        $this->validator($request->all())->validate();

        $member->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/mypage');
    }
}
