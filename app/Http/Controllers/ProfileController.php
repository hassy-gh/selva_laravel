<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $gender = config('master.gender');

        return view('mypage.profile')
            ->with('member', Auth::user())
            ->with('gender', $gender);
    }

    public function showWithdrawalConfirm()
    {
        return view('mypage.withdrawal_confirm');
    }

    public function withdrawal()
    {
        $member = Auth::user();
        $member->deleted_at = Carbon::now();
        $member->save();
        Auth::logout();
        return redirect()->route('top');
    }
}
