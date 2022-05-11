@extends('layouts.app')

@section('title')
商品レビュー編集
@endsection

@section('content')
@include('components.review_header', ['title' => '商品レビュー編集'])
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
      <form action="{{ route('review.edit', [$product->id, $review->id]) }}" method="POST" class="review-form">
        @csrf
        <table class="form">
          <tr class="evaluation">
            <th>商品評価</th>
            <td>
              <select name="evaluation">
                @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ old('evaluation', $review->evaluation) == $i ? 'selected' : '' }}>
                  {{ $i }}
                  </option>
                  @endfor
              </select>
            </td>
          </tr>
          @error('evaluation')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="comment">
            <th>商品コメント</th>
            <td>
              <textarea name="comment" id="" cols="30" rows="5">{{ old('comment', $review->comment) }}</textarea>
            </td>
          </tr>
          @error('comment')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror
        </table>
        <div class="submit">
          <button class="btn" type="submit">商品レビュー編集確認</button>
        </div>
        <div class="back">
          <a href="{{ route('mypage.reviews') }}" class="btn">レビュー管理に戻る</a>
        </div>
    </div>
  </div>
</div>
@endsection
