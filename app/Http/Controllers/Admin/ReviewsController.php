<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function showReviews(Request $request)
    {
        $query = Review::query();

        // IDで検索
        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        // フリーワードで絞り込み
        if ($request->filled('free_word')) {
            $free_word = '%' . $this->escape($request->input('free_word')) . '%';
            $query->where('comment', 'LIKE', $free_word);
        }

        $defaults = [
            'id' => $request->input('id'),
            'free_word' => $request->input('free_word'),
        ];

        $sort = $request->get('sort');

        if ($sort == '1') {
            $reviews = $query->whereNull('deleted_at')
                ->orderBy('id', 'ASC')
                ->paginate(10);
        } else {
            $reviews = $query->whereNull('deleted_at')
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return view('admin.reviews.reviews')
            ->with('reviews', $reviews)
            ->with('defaults', $defaults)
            ->with('sort', $sort);
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
