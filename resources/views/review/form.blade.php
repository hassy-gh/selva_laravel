@extends('layouts.app')

@section('title')
商品レビュー登録
@endsection

@section('content')
@include('components.review_header', ['title' => '商品レビュー登録'])
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
          <p>総合評価</p>
        </div>
      </div>
      <form action="{{ route('review.post', $product->id) }}" method="POST" class="review-form">
        @csrf
        <table class="form">
          <tr class="evaluation">
            <th>商品評価</th>
            <td>
              <select name="evaluation">
                <option value="" hidden>選択してください</option>
                @for ($i = 1; $i <= 5; $i++) <option value="{{ $i }}" {{ old('evaluation') == $i ? 'selected' : '' }}>
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
              <textarea name="comment" id="" cols="30" rows="5">{{ old('comment') }}</textarea>
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
          <button class="btn" type="submit">商品レビュー登録確認</button>
        </div>
        <div class="back">
          <a href="{{ route('products.detail', $product->id) }}" class="btn">商品詳細に戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
