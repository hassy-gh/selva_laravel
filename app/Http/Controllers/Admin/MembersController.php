<?php

namespace App\Http\Controllers\Admin;

use App\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
