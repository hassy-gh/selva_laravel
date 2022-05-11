@extends('layouts.app')

@section('title')
商品レビュー編集確認画面
@endsection

@section('content')
@include('components.review_header', ['title' => '商品レビュー編集確認'])
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
      <form action="{{ route('review.update', [$product->id, $review->id]) }}" method="POST" class="review-form">
        @csrf
        <table class="form">
          <tr class="evaluation">
            <th>商品評価</th>
            <td>
              {{ $input['evaluation'] }}
              <input type="hidden" name="evaluation" value="{{ $input['evaluation'] }}">
            </td>
          </tr>

          <tr class="comment">
            <th>商品コメント</th>
            <td>
              {!! nl2br($input['comment']) !!}
              <textarea name="comment" cols="30" rows="5" style="display: none;"></textarea>
            </td>
          </tr>
        </table>
        <div class="submit">
          <button class="btn" type="submit">更新する</button>
        </div>
        <div class="back">
          <button type="submit" class="btn" name="back">前に戻る</button>
        </div>
    </div>
  </div>
</div>
@endsection
