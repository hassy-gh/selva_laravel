<?php

namespace App\Http\Controllers\Admin;

use App\Review;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Product;
use Carbon\Carbon;
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

    private $show_register = 'Admin\ReviewsController@showRegisterForm';
    private $show_confirm = 'Admin\ReviewsController@showConfirmForm';
    private $show_edit = 'Admin\ReviewsController@showEditForm';
    private $show_edit_confirm = 'Admin\ReviewsController@showEditConfirmForm';

    private $formItems = [
        'product',
        'evaluation',
        'comment',
    ];

    public function showRegisterForm()
    {
        $products = Product::whereNull('deleted_at')->get();

        return view('admin.reviews.register')
            ->with('products', $products)
            ->with('register', true);
    }

    public function post(ReviewRequest $request)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_confirm);
    }

    public function showConfirmForm(Request $request)
    {
        $input = $request->session()->get('form_input');

        if (!$input) {
            return redirect()->action($this->show_register);
        }

        $product = Product::find($input['product']);
        $evaluations = config('master.evaluations');
        $average = Review::where('product_id', $product->id)
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();

        return view('admin.reviews.register_confirm', [
            'input' => $input,
            'product' => $product,
            'evaluations' => $evaluations,
            'average' => $average,
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

        Review::create([
            'member_id' => 1,
            'product_id' => $input['product'],
            'evaluation' => $input['evaluation'],
            'comment' => $input['comment'],
        ]);

        $request->session()->forget('form_input');

        return redirect('/admin/reviews');
    }

    public function showEditForm(Review $review)
    {
        $evaluations = config('master.evaluations');
        $average = Review::where('product_id', $review->product->id)
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();

        return view('admin.reviews.edit')
            ->with('review', $review)
            ->with('evaluations', $evaluations)
            ->with('average', $average)
            ->with('register', false);
    }

    public function edit(ReviewRequest $request, Review $review)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->show_edit_confirm, $review);
    }

    public function showEditConfirmForm(Request $request, Review $review)
    {
        $input = $request->session()->get('form_input');

        if (!$input) {
            return redirect()->action($this->show_edit, $review);
        }

        $evaluations = config('master.evaluations');
        $average = Review::where('product_id', $review->product->id)
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();


        return view('admin.reviews.edit_confirm')
            ->with('input', $input)
            ->with('review', $review)
            ->with('evaluations', $evaluations)
            ->with('average', $average)
            ->with('register', false);
    }

    public function update(Request $request, Review $review)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->show_edit, $review)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->show_edit, $review);
        }

        $review->update([
            'evaluation' => $input['evaluation'],
            'comment' => $input['comment'],
        ]);

        $request->session()->forget('form_input');

        return redirect('/admin/reviews');
    }

    public function showDetail(Review $review)
    {
        $evaluations = config('master.evaluations');
        $average = Review::where('product_id', $review->product->id)
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();

        return view('admin.reviews.detail')
            ->with('review', $review)
            ->with('evaluations', $evaluations)
            ->with('average', $average);
    }

    public function delete(Review $review)
    {
        $review->deleted_at = Carbon::now();
        $review->save();

        return redirect('/admin/reviews');
    }
}
