<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Product;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    private $form_show = 'ReviewController@showReviewForm';
    private $form_confirm = 'ReviewController@showConfirmForm';
    private $form_complete = 'ReviewController@complete';

    private $formItems = [
        'evaluation',
        'comment',
    ];

    public function showReviewForm(Product $product)
    {
        $average = $product->reviews()
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
        $reviews = $product->reviews()->orderBy('id', 'DESC')->paginate(5);
        $average = $product->reviews()
            ->pluck('evaluation')
            ->avg();
        $config_evaluations = config('master.evaluations');

        return view('review.reviews')
            ->with('reviews', $reviews)
            ->with('product', $product)
            ->with('average', $average)
            ->with('evaluations', $config_evaluations);
    }
}
