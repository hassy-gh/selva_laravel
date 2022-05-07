@extends('layouts.app')

@section('title')
商品レビュー登録完了画面
@endsection

@section('content')
@include('components.review_header', ['title' => '商品レビュー登録完了'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <p class="mt-5" style="text-align: center;">商品レビューの登録が完了しました</p>
      <div class="submit">
        <a href="{{ route('review.reviews', $product->id) }}" class="btn">商品レビュー一覧へ</a>
      </div>
      <div class="back">
        <a href="{{ route('products.detail', $product->id) }}" class="btn">商品詳細に戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection
