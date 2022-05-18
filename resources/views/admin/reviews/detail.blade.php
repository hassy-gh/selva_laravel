@extends('layouts.admin_app')

@section('title')
商品レビュー詳細画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品レビュー詳細', 'route' => 'admin.reviews.reviews', 'text' => '一覧へ戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="product-wrapper">
        <div class="product-image">
          @if (!is_null($review->product->image_1))
          <img src="/storage/products/{{ $review->product->image_1 }}" alt="">
          @else
          <img src="/images/product-image-default.png" alt="">
          @endif
        </div>
        <div class="product-caption">
          <p>商品ID {{ $review->product->id }}</p>
          <p class="name">{{ $review->product->name }}</p>
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
      <table class="profile">
        <tr class="id">
          <th>ID</th>
          <td>{{ $review->id }}</td>
        </tr>

        <tr class="evaluation">
          <th>商品評価</th>
          <td>{{ $review->evaluation }}</td>
        </tr>

        <tr class="comment">
          <th>商品コメント</th>
          <td>{!! nl2br($review->comment) !!}</td>
        </tr>
      </table>
      <div class="buttons justify-content-center">
        <div class="back mr-3">
          <a href="{{ route('admin.reviews.show_edit', $review->id) }}" class="btn">
            編集
          </a>
        </div>
        <div class="back">
          <form id="delete-form" action="{{ route('admin.reviews.delete', $review->id) }}" method="POST">
            @csrf
            <button class="btn" type="submit">削除</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
