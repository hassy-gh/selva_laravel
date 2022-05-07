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
          {{ $config_categories[$product->product_category_id] }}
          >
          {{ $config_subcategories[$product->product_subcategory_id] }}
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
        <p>■商品説明</p>
        <p>
          {!! nl2br($product->product_content) !!}
        </p>
      </div>
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
