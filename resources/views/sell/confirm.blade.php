@extends('layouts.app')

@section('title')
商品登録確認画面
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>商品登録確認画面</h2>
      <form action="{{ route('sell.confirm') }}" method="POST" class="product-form" enctype="multipart/form-data">
        @csrf
        <table class="form">
          <tr class="name">
            <th>商品名</th>
            <td>
              {{ $input['name'] }}
              <input type="hidden" name="name" value="{{ $input['name'] }}">
            </td>
          </tr>

          <tr class="category">
            <th>商品カテゴリ</th>
            <td>
              {{ $category->name }} > {{ $subcategory->name }}
              <input type="hidden" name="product_category_id" value="{{ $input['product_category_id'] }}">
              <input type="hidden" name="product_subcategory_id" value="{{ $input['product_subcategory_id'] }}">
            </td>
          </tr>

          @if ($input['image_1'])
          <tr class="images image-1">
            <th>商品写真</th>
            <td>
              <p>写真1</p>
              <input type="hidden" name="image_1" value="{{ $input['image_1'] }}">
              <img src="/storage/products/{{ $input['image_1'] }}">
            </td>
          </tr>
          @endif

          @if ($input['image_2'])
          <tr class="images image-2">
            <th></th>
            <td>
              <p>写真2</p>
              <input type="hidden" name="image_2" value="{{ $input['image_2'] }}">
              <img src="/storage/products/{{ $input['image_2'] }}">
            </td>
          </tr>
          @endif

          @if ($input['image_3'])
          <tr class="images image-3">
            <th></th>
            <td>
              <p>写真3</p>
              <input type="hidden" name="image_3" value="{{ $input['image_3'] }}">
              <img src="/storage/products/{{ $input['image_3'] }}">
            </td>
          </tr>
          @endif

          @if ($input['image_4'])
          <tr class="images image-4">
            <th></th>
            <td>
              <p>写真4</p>
              <input type="hidden" name="image_4" value="{{ $input['image_4'] }}">
              <img src="/storage/products/{{ $input['image_4'] }}">
            </td>
          </tr>
          @endif

          <tr class="product-content">
            <th>商品説明</th>
            <td>
              {!! nl2br($input['product_content']) !!}
              <textarea name="product_content" cols="30" rows="5" style="display: none;"></textarea>
            </td>
          </tr>
        </table>

        <div class="submit">
          <button class="btn" type="submit">商品を登録する</button>
        </div>
        <div class="back">
          <button type="submit" class="btn" name="back">前に戻る</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
