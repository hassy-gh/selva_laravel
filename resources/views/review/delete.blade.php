@extends('layouts.app')

@section('title')
商品レビュー削除確認画面
@endsection

@section('content')
@include('components.review_header', ['title' => '商品レビュー削除確認'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="product-wrapper">
        <div class="product-image">
          @if (!is_null($product->image_1))
          <img src="/storage/products/{{ $product->image_1 }}" alt="">
          @else
          <img src="/images/product-image-default.png" alt="">
          @endif
        </div>
        <div class="product-caption">
          <p class="name">{{ $product->name }}</p>
          <p>
            総合評価
            @if ($average)
            {{ $evaluations[ceil($average)] }} {{ ceil($average) }}
            @else
            レビューがありません
            @endif
          </p>
        </div>
      </div>
      <form action="{{ route('review.delete', [$product->id, $review->id]) }}" method="POST" class="review-form">
        @csrf
        <table class="form">
          <tr class="evaluation">
            <th>商品評価</th>
            <td>
              {{ $review->evaluation }}
            </td>
          </tr>

          <tr class="comment">
            <th>商品コメント</th>
            <td>
              {!! nl2br($review->comment) !!}
            </td>
          </tr>
        </table>
        <div class="submit">
          <button class="btn" type="submit">レビューを削除する</button>
        </div>
        <div class="back">
          <a href="{{ route('mypage.reviews') }}" class="btn">前に戻る</a>
        </div>
    </div>
  </div>
</div>
@endsection
