<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MemberEditRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\MemberRegisterRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
    public function showMembers(Request $request)
    {
        $query = Member::query();

        // IDで検索
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // 性別で検索
        if ($request->filled('man') && $request->filled('woman')) {
            $query->where(function ($query) use ($request) {
                $query->where('gender', $request->man);
                $query->orWhere('gender', $request->woman);
            });
        } elseif ($request->filled('man')) {
            $query->where('gender', $request->man);
        } elseif ($request->filled('woman')) {
            $query->where('gender', $request->woman);
        }

        // フリーワードで絞り込み
        if ($request->filled('free_word')) {
            $free_word = '%' . $this->escape($request->input('free_word')) . '%';
            $query->where(function ($query) use ($free_word) {
                $query->where('name_sei', 'LIKE', $free_word);
                $query->orWhere('name_mei', 'LIKE', $free_word);
                $query->orWhere('email', 'LIKE', $free_word);
            });
        }

        $defaults = [
            'id' => $request->input('id'),
            'man' => $request->input('man'),
            'woman' => $request->input('woman'),
            'free_word' => $request->input('free_word'),
        ];

        $sort = $request->get('sort');

        if ($sort == '1') {
            $members = $query->whereNull('deleted_at')
                ->orderBy('id', 'ASC')
                ->paginate(10);
        } else {
            $members = $query->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        $gender = config('master.gender');

        return view('admin.members.members')
            ->with('members', $members)
            ->with('defaults', $defaults)
            ->with('sort', $sort)
            ->with('gender', $gender);
    }

    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    private $show_register = 'Admin\MembersController@showRegisterForm';
    private $show_confirm = 'Admin\MembersController@showConfirmForm';
    private $show_edit = 'Admin\MembersController@showEditForm';
    private $show_edit_confirm = 'Admin\MembersController@showEditConfirmForm';

    private $formItems = [
        'name_sei',
        'name_mei',
        'nickname',
        'gender',
        'password',
        'password_confirmation',
        'email',
    ];

    public function showRegisterForm()
    {
        return view('admin.members.register')
            ->with('register', true);
    }

    public function post(MemberRegisterRequest $request)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_confirm);
    }

    public function showConfirmForm(Request $request)
    {
        $input = $request->session()->get('form_input');

        $gender = config('master.gender');

        if (!$input) {
            return redirect()->action($this->show_register);
        }

        return view('admin.members.register_confirm', [
            'input' => $input,
            'gender' => $gender,
            'register' => true,
        ]);
    }

    public function register(Request $request)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_register)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_register);
        }

        Member::create([
            'name_sei' => $input['name_sei'],
            'name_mei' => $input['name_mei'],
            'nickname' => $input['nickname'],
            'gender' => $input['gender'],
            'password' => Hash::make($input['password']),
            'email' => $input['email'],
        ]);

        $request->session()->forget('form_input');

        return redirect('/admin/members');
    }

    public function showEditForm(Member $member)
    {
        return view('admin.members.edit')
            ->with('member', $member)
            ->with('register', false);
    }

    public function edit(MemberEditRequest $request, Member $member)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_edit_confirm, $member);
    }

    public function showEditConfirmForm(Request $request, Member $member)
    {
        $input = $request->session()->get('form_input');

        $gender = config('master.gender');

        if (!$input) {
            return redirect()->action($this->show_edit, $member);
        }

        return view('admin.members.edit_confirm')
            ->with('input', $input)
            ->with('member', $member)
            ->with('gender', $gender)
            ->with('register', false);
    }

    public function update(Request $request, Member $member)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_edit, $member)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_edit, $member);
        }

        $member->update([
            'name_sei' => $input['name_sei'],
            'name_mei' => $input['name_mei'],
            'nickname' => $input['nickname'],
            'gender' => $input['gender'],
            'password' => Hash::make($input['password']),
            'email' => $input['email'],
        ]);

        $request->session()->forget('form_input');

        return redirect('/admin/members');
    }

    public function showDetail(Member $member)
    {
        $gender = config('master.gender');

        return view('admin.members.detail')
            ->with('member', $member)
            ->with('gender', $gender);
    }

    public function delete(Member $member)
    {
        $member->deleted_at = Carbon::now();
        $member->save();
        return redirect('/admin/members');
    }
}
