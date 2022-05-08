<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $gender = config('master.gender');

        return view('mypage.profile')
            ->with('member', Auth::user())
            ->with('gender', $gender);
    }
}
