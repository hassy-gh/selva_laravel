@extends('layouts.app')

@section('title')
商品詳細
@endsection

@section('content')
@include('components.product_detail_header')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="product-detail">
        <p class="category">
          {{ $categories->find($product->product_category_id)->name }}
          >
          {{ $subcategories->find($product->product_subcategory_id)->name }}
        </p>
        <h3 class="name">{{ $product->name }}</h3>
        <span class="updated-at">更新日時：{{ $product->updated_at->format('Ymd') }}</span>
        <ul class="images">
          <li>
            @if (!is_null($product->image_1))
            <img src="/storage/products/{{ $product->image_1 }}" alt="">
            @else
            <img src="/images/product-image-default.png" alt="">
            @endif
          </li>
          <li>
            @if (!is_null($product->image_2))
            <img src="/storage/products/{{ $product->image_2 }}" alt="">
            @else
            <img src="/images/product-image-default.png" alt="">
            @endif
          </li>
          <li>
            @if (!is_null($product->image_3))
            <img src="/storage/products/{{ $product->image_3 }}" alt="">
            @else
            <img src="/images/product-image-default.png" alt="">
            @endif
          </li>
          <li>
            @if (!is_null($product->image_4))
            <img src="/storage/products/{{ $product->image_4 }}" alt="">
            @else
            <img src="/images/product-image-default.png" alt="">
            @endif
          </li>
        </ul>
        <div class="description">
          <p>■商品説明</p>
          <p>
            {!! nl2br($product->product_content) !!}
          </p>
        </div>
        <div>
          <p>■商品レビュー</p>
          <p>
            総合評価
            @if ($average)
            {{ $evaluations[ceil($average)] }} {{ ceil($average) }}
            @else
            レビューがありません
            @endif
          </p>
          <p><a href="{{ route('review.reviews', $product->id) }}">>>レビューを見る</a></p>
        </div>
      </div>
      @auth
      <div class="submit" style="text-align: right;">
        <a href="{{ route('review.form', [$product->id]) }}" class="btn">
          この商品についてのレビューを登録
        </a>
      </div>
      @endauth
      <div class="back" style="text-align: right;">
        @if (strpos(url()->previous(), '/products?'))
        <a href="{{ url()->previous() }}" class="btn">商品一覧に戻る</a>
        @else
        <a href="{{ route('products.index') }}" class="btn">商品一覧に戻る</a>
        @endif
      </div>

    </div>
  </div>
</div>
@endsection
