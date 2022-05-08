@extends('layouts.app')

@section('title')
商品レビュー一覧
@endsectiom

@section('content')
@include('components.review_header', ['title' => '商品レビュー一覧'])
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
      <div class="reviews">
        @foreach ($reviews as $review)
        <table class="review">
          <tr>
            <th>{{ $review->member->name_sei . ' ' . $review->member->name_mei }}さん</th>
            <td>
              {{ $evaluations[$review->evaluation] }} {{ $review->evaluation }}
            </td>
          </tr>
          <tr>
            <th>商品コメント</th>
            <td>{!! nl2br($review->comment) !!}</td>
          </tr>
        </table>
        @endforeach
      </div>
      <div class="pager">
        {{ $reviews->links('vendor.pagination.original_pagination') }}
      </div>
      <div class="submit">
        <a href="{{ route('products.detail', $product->id) }}" class="btn">商品詳細に戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection
