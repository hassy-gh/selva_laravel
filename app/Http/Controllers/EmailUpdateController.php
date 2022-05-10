<?php

namespace App\Http\Controllers;

use App\Mail\EmailUpdateAuthCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailUpdateController extends Controller
{
    private $show_email_edit = 'EmailUpdateController@showAuthForm';
    private $show_auth = 'EmailUpdateController@showAuthForm';

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => [
                "required",
                "regex:/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",
                "email",
                "max:200",
                "unique:members"
            ],
        ]);
    }

    public function showEmailEditForm()
    {
        return view('mypage.email_edit_form')
            ->with('member', Auth::user());
    }

    public function emailEdit(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->session()->put('new_email', $request->email);

        $random_code = '';

        for ($i = 0; $i < 6; $i++) {
            $random_code .= strval(rand(0, 9));
        }

        $member = Auth::user();
        $member->auth_code = $random_code;
        $member->save();

        Mail::to($request->email)->send(new EmailUpdateAuthCode($random_code));

        return redirect()->action($this->show_email_edit);
    }

    public function showAuthForm()
    {
        return view('mypage.auth_code_form');
    }

    public function emailUpdate(Request $request)
    {
        $member = Auth::user();

        if ($member->auth_code == $request->auth_code) {
            $new_email = $request->session()->get('new_email');

            $member->email = $new_email;
            $member->auth_code = null;
            $member->save();

            $request->session()->forget('new_email');

            return redirect('/mypage');
        } else {
            return redirect()->action($this->show_auth)
                ->withInput()
                ->withErrors(array(
                    'auth_code' => '※認証コードが正しくありません。',
                ));
        }
    }
}
