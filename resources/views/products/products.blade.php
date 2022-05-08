@extends('layouts.app')

@section('title')
商品一覧
@endsection

@section('content')
@include('components.products_header')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="" method="GET" class="search-form">
        <table class="form">
          <tr class="category">
            <th>カテゴリ</th>
            <td>
              <select name="product_category_id" id="parent">
                <option value="">選択してください</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $defaults['category'] == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
              <select name="product_subcategory_id" id="child">
                @if ($defaults['category'])
                <option value="">選択してください</option>
                @foreach ($subcategories as $subcategory)
                @if ($defaults['category'] == $subcategory->product_category_id)
                <option value="{{ $subcategory->id }}" {{ $defaults['subcategory'] == $subcategory->id ? 'selected' : '' }}>
                  {{ $subcategory->name }}
                </option>
                @endif
                @endforeach
                @endif
              </select>
            </td>
          </tr>

          <tr class="free-word">
            <th>フリーワード</th>
            <td><input type="text" name="free_word" value="{{ $defaults['free_word'] }}"></td>
          </tr>
        </table>
        <div class="submit">
          <button class="btn" type="submit">商品検索</button>
        </div>
      </form>

      <div class="products">
        @foreach ($products as $product)
        <div class="product">
          <div class="product-image">
            @if (!is_null($product->image_1))
            <img src="/storage/products/{{ $product->image_1 }}" alt="">
            @else
            <img src="/images/product-image-default.png" alt="">
            @endif
          </div>
          <div class="product-caption">
            <span class="category">
              {{ $config_categories[$product->product_category_id] }}>{{ $config_subcategories[$product->product_subcategory_id] }}
            </span>
            <a href="{{ route('products.detail', [$product->id]) }}">{{ $product->name }}</a>
            <p>
              @if ($averages[$product->id])
              {{ $evaluations[ceil($averages[$product->id])] }} {{ ceil($averages[$product->id]) }}
              @else
              レビューがありません
              @endif
            </p>
          </div>
          <div class="submit" style="text-align: right;">
            <a href="{{ route('products.detail', [$product->id]) }}" class="btn">詳細</a>
          </div>
        </div>
        @endforeach
        <div class="pager">
          {{ $products->links('vendor.pagination.original_pagination') }}
        </div>
      </div>
      <div class="back">
        <a href="/" class="btn">トップに戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection
