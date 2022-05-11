<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\ProfileEditRequest;

class ProfileController extends Controller
{
    private $show_edit_profile = 'ProfileController@showProfileEditForm';
    private $show_confirm = 'ProfileController@showConfirmForm';

    private $profileEditFormItems = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
    ];

    public function showProfile()
    {
        $gender = config('master.gender');

        return view('mypage.profile')
            ->with('member', Auth::user())
            ->with('gender', $gender);
    }

    public function showProfileEditForm()
    {
        return view('mypage.profile_edit_form')
            ->with('member', Auth::user());
    }

    public function profileEdit(ProfileEditRequest $request)
    {
        $input = $request->only($this->profileEditFormItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_confirm);
    }

    public function showConfirmForm(Request $request)
    {
        $input = $request->session()->get('form_input');
        $gender = config('master.gender');

        if (!$input) {
            return redirect()->action($this->show_edit_profile);
        }

        return view('mypage.profile_edit_confirm')
            ->with('input', $input)
            ->with('gender', $gender);
    }

    public function profileUpdate(Request $request)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_edit_profile)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_edit_profile);
        }

        $member = Auth::user();

        $member->update([
            'name_sei' => $input['name_sei'],
            'name_mei' => $input['name_mei'],
            'nickname' => $input['nickname'],
            'gender' => $input['gender'],
        ]);

        $request->session()->forget('form_input');

        return redirect('/mypage');
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

    public function showReviews()
    {
        $member = Auth::user();
        $reviews = $member->reviews()->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(5);
        $categories = config('master.product_category');
        $subcategories = config('master.product_subcategory');
        $evaluations = config('master.evaluations');

        return view('mypage.reviews')
            ->with('reviews', $reviews)
            ->with('categories', $categories)
            ->with('subcategories', $subcategories)
            ->with('evaluations', $evaluations);
    }
}
