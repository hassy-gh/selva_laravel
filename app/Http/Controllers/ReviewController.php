<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Product;
use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $form_show = 'ReviewController@showReviewForm';
    private $form_confirm = 'ReviewController@showConfirmForm';
    private $form_complete = 'ReviewController@complete';
    private $edit_form_show = 'ReviewController@showReviewEditForm';
    private $edit_form_confirm = 'ReviewController@showReviewEditConfirmForm';

    private $formItems = [
        'evaluation',
        'comment',
    ];

    public function showReviewForm(Product $product)
    {
        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.form')
            ->with('product', $product)
            ->with('average', $average)
            ->with('evaluations', $config_evaluations);
    }

    public function reviewPost(ReviewRequest $request, Product $product)
    {
        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->form_confirm, $product);
    }

    public function showConfirmForm(Request $request, Product $product)
    {
        $input = $request->session()->get('form_input');

        if (!$input) {
            return redirect()->action($this->form_show, $product);
        }

        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.confirm', [
            'input' => $input,
            'product' => $product,
            'average' => $average,
            'evaluations' => $config_evaluations,
        ]);
    }

    public function confirm(Request $request, Product $product)
    {
        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->form_show, $product)
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->form_show, $product);
        }

        $member = Auth::user();

        $review = new Review();
        $review->member_id = $member->id;
        $review->product_id = $product->id;
        $review->evaluation = $input['evaluation'];
        $review->comment = $input['comment'];
        $review->save();

        $request->session()->forget('form_input');

        return redirect()->action($this->form_complete, $product);
    }

    public function complete(Product $product)
    {
        return view('review.complete', ['product' => $product]);
    }

    public function showReviews(Product $product)
    {
        $reviews = $product->reviews()->whereNull('deleted_at')->orderBy('id', 'DESC')->paginate(5);
        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.reviews')
            ->with('reviews', $reviews)
            ->with('product', $product)
            ->with('average', $average)
            ->with('evaluations', $config_evaluations);
    }

    public function showReviewEditForm(Product $product, Review $review)
    {
        $member = Auth::user();
        if (!is_null($review->deleted_at) || $review->member_id != $member->id) {
            return redirect()->route('mypage.reviews');
        }

        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.edit_form')
            ->with('product', $product)
            ->with('review', $review)
            ->with('average', $average)
            ->with('evaluations', $config_evaluations);
    }

    public function reviewEdit(ReviewRequest $request, Product $product, Review $review)
    {
        $member = Auth::user();
        if (!is_null($review->deleted_at) || $review->member_id != $member->id) {
            return redirect()->route('mypage.reviews');
        }

        $input = $request->only($this->formItems);

        $request->session()->put('form_input', $input);

        return redirect()->action($this->edit_form_confirm, [$product, $review]);
    }

    public function showReviewEditConfirmForm(Request $request, Product $product, Review $review)
    {
        $member = Auth::user();
        if (!is_null($review->deleted_at) || $review->member_id != $member->id) {
            return redirect()->route('mypage.reviews');
        }

        $input = $request->session()->get('form_input');

        if (!$input) {
            return redirect()->action($this->edit_form_show, [$product, $review]);
        }

        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.edit_confirm', [
            'input' => $input,
            'product' => $product,
            'review' => $review,
            'average' => $average,
            'evaluations' => $config_evaluations,
        ]);
    }

    public function reviewUpdate(Request $request, Product $product, Review $review)
    {
        $member = Auth::user();
        if (!is_null($review->deleted_at) || $review->member_id != $member->id) {
            return redirect()->route('mypage.reviews');
        }

        $input = $request->session()->get('form_input');

        if ($request->has('back')) {
            return redirect()->action($this->edit_form_show, [$product, $review])
                ->withInput($input);
        }

        if (!$input) {
            return redirect()->action($this->edit_form_show, [$product, $review]);
        }

        $review->update([
            'evaluation' => $input['evaluation'],
            'comment' => $input['comment'],
        ]);

        $request->session()->forget('form_input');

        return redirect()->route('mypage.reviews');
    }

    public function showReviewDeleteForm(Product $product, Review $review)
    {
        $member = Auth::user();
        if (!is_null($review->deleted_at) || $review->member_id != $member->id) {
            return redirect()->route('mypage.reviews');
        }

        $average = $product->reviews()
            ->whereNull('deleted_at')
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.delete')
            ->with('product', $product)
            ->with('review', $review)
            ->with('average', $average)
            ->with('evaluations', $config_evaluations);
    }

    public function reviewDelete(Product $product, Review $review)
    {
        $member = Auth::user();
        if (!is_null($review->deleted_at) || $review->member_id != $member->id) {
            return redirect()->route('mypage.reviews');
        }

        $review->deleted_at = Carbon::now();
        $review->save();

        return redirect()->route('mypage.reviews');
    }
}
