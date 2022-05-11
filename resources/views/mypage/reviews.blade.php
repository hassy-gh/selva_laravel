@extends('layouts.app')

@section('title')
商品レビュー管理
@endsection

@section('content')
@include('components.review_header', ['title' => '商品レビュー管理'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="mypage-reviews">
        @foreach ($reviews as $review)
        <div class="review">
          <div class="product-image">
            @if (!is_null($review->product->image_1))
            <img src="/storage/products/{{ $review->product->image_1 }}" alt="">
            @else
            <img src="/images/product-image-default.png" alt="">
            @endif
          </div>
          <div class="review-content">
            <span class="category">
              {{ $categories[$review->product->product_category_id] }}>{{ $subcategories[$review->product->product_subcategory_id] }}
            </span>
            <h3>{{ $review->product->name }}</h3>
            <p>{{ $evaluations[$review->evaluation]. ' ' . $review->evaluation }}</p>
            <p>{!! Str::limit(nl2br($review->comment), 32) !!}</p>
            <div class="buttons">
              <div class="submit">
                <a href="{{ route('review.show_edit', [$review->product_id, $review->id]) }}" class="btn">レビュー編集</a>
              </div>
              <div class="submit">
                <a href="{{ route('review.delete', [$review->product_id, $review->id]) }}" class="btn">レビュー削除</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="pager">
        {{ $reviews->links('vendor.pagination.original_pagination') }}
      </div>
      <div class="submit">
        <a href="{{ route('mypage.profile') }}" class="btn">マイページに戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection
