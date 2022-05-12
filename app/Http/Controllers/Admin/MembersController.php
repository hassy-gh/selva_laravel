<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function showMembers(Request $request)
    {
        $members = Member::whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $gender = config('master.gender');

        return view('admin.members.members')
            ->with('members', $members)
            ->with('gender', $gender);
    }
}
