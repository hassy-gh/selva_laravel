@extends('layouts.admin_app')

@section('title')
商品詳細画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品詳細', 'route' => 'admin.products.products', 'text' => '一覧へ戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="profile">
        <tr class="id">
          <th>ID</th>
          <td>{{ $product->id }}</td>
        </tr>

        <tr class="name">
          <th>商品名</th>
          <td>{{ $product->name }}</td>
        </tr>

        <tr class="category">
          <th>商品カテゴリ</th>
          <td>{{ $category->name . '>' . $subcategory->name }}</td>
        </tr>

        @if ($product->image_1)
        <tr class="images image-1">
          <th>商品写真</th>
          <td>
            <p>写真1</p>
            <img src="/storage/products/{{ $product->image_1 }}">
          </td>
        </tr>
        @endif

        @if ($product->image_2)
        <tr class="images image-2">
          <th></th>
          <td>
            <p>写真2</p>
            <img src="/storage/products/{{ $product->image_2 }}">
          </td>
        </tr>
        @endif

        @if ($product->image_3)
        <tr class="images image-3">
          <th></th>
          <td>
            <p>写真3</p>
            <img src="/storage/products/{{ $product->image_3 }}">
          </td>
        </tr>
        @endif

        @if ($product->image_4)
        <tr class="images image-4">
          <th></th>
          <td>
            <p>写真4</p>
            <img src="/storage/products/{{ $product->image_4 }}">
          </td>
        </tr>
        @endif

        <tr class="product-content">
          <th>商品説明</th>
          <td>
            {!! nl2br($product->product_content) !!}
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
<div class="divider">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h3>総合評価</h3>
        <p>
          @if ($average)
          {{ $evaluations[ceil($average)] }} {{ ceil($average) }}
          @else
          レビューがありません
          @endif
        </p>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="reviews">
        @foreach ($reviews as $review)
        <table class="review">
          <tr>
            <th>商品レビューID</th>
            <td>{{ $review->id }}</td>
          </tr>
          <tr>
            <th>
              <a href="{{ route('admin.members.detail', $review->member->id) }}">
                {{ $review->member->name_sei . ' ' . $review->member->name_mei }}さん
              </a>
            </th>
            <td>
              {{ $evaluations[$review->evaluation] }} {{ $review->evaluation }}
            </td>
          </tr>
          <tr>
            <th>商品コメント</th>
            <td>{!! nl2br($review->comment) !!}</td>
          </tr>
          <tr>
            <th></th>
            <td class="submit">
              <a href="{{ route('admin.reviews.detail', $review->id) }}" class="btn" style="text-align: right;">商品レビュー詳細</a>
            </td>
          </tr>
        </table>
        @endforeach
      </div>
      <div class="pager">
        {{ $reviews->links('vendor.pagination.original_pagination') }}
      </div>
      <div class="buttons justify-content-center">
        <div class="back mr-3">
          <a href="{{ route('admin.products.show_edit', $product->id) }}" class="btn">
            編集
          </a>
        </div>
        <div class="back">
          <form id="delete-form" action="{{ route('admin.products.delete', $product->id) }}" method="POST">
            @csrf
            <button class="btn" type="submit">削除</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
