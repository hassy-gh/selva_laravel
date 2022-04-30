@extends('layouts.app')

@section('title')
商品登録フォーム
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>商品登録</h2>
      <form action="" method="POST" class="product-form">
        @csrf
        <table class="form">
          <tr class="name">
            <th>商品名</th>
            <td><input type="text" name="name" value="{{ old('name') }}"></td>
          </tr>
          @error('name')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="category">
            <th>商品カテゴリ</th>
            <td>
              <select name="product_category_id" id="parent">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
              <select name="product_subcategory_id" id="child"></select>
            </td>
          </tr>
          @error('product_category_id')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror
          @error('product_subcategory_id')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images">
            <th></th>
            <td>
              <p>写真1</p>
              <input type="file" name="image_1">
            </td>
          </tr>
          @error('image_1')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images">
            <th></th>
            <td>
              <p>写真2</p>
              <input type="file" name="image_2">
            </td>
          </tr>
          @error('image_2')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images">
            <th></th>
            <td>
              <p>写真3</p>
              <input type="file" name="image_3">
            </td>
          </tr>
          @error('image_3')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images">
            <th></th>
            <td>
              <p>写真4</p>
              <input type="file" name="image_4">
            </td>
          </tr>
          @error('image_4')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="product-content">
            <th>商品説明</th>
            <td><textarea name="product_content" cols="30" rows="5"></textarea></td>
          </tr>
          @error('product_content')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror
        </table>

        <div class="submit">
          <button class="btn" type="submit">確認画面へ</button>
        </div>
        <div class="back">
          <a href="/" class="btn">トップに戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
