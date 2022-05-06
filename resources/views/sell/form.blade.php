@extends('layouts.app')

@section('title')
商品登録フォーム
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>商品登録</h2>
      <form action="{{ route('sell.sell') }}" method="POST" class="product-form" enctype="multipart/form-data">
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
                <option value="" hidden>選択してください</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
              <select name="product_subcategory_id" id="child">
                @if (old('product_subcategory_id'))
                @foreach ($subcategories as $subcategory)
                @if (old('product_category_id') == $subcategory->product_category_id)
                <option value="{{ $subcategory->id }}" {{ old('product_subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                  {{ $subcategory->name }}
                </option>
                @endif
                @endforeach
                @endif
              </select>
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

          <tr class="images image-1">
            <th>商品写真</th>
            <td>
              <p>写真1</p>
              <input type="file" name="image_1_file" id="image_1" accept=".jpg,.jpeg,.png,.gif">
              <input type="hidden" name="image_1" class="image-1-text" value="{{ old('image_1') }}">
              @if (old('image_1'))
              <img src="/storage/products/{{ old('image_1') }}" alt="" class="show_image_1">
              @else
              <img src="/images/product-image-default.png" alt="" class="show_image_1">
              @endif
              <label for="image_1" class="back">
                <p class="btn">アップロード</p>
              </label>
            </td>
          </tr>
          @error('image_1')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images image-2">
            <th></th>
            <td>
              <p>写真2</p>
              <input type="file" name="image_2_file" id="image_2" accept=".jpg,.jpeg,.png,.gif">
              <input type="hidden" name="image_2" class="image-2-text" value="{{ old('image_2') }}">
              @if (old('image_2'))
              <img src="/storage/products/{{ old('image_2') }}" alt="" class="show_image_2">
              @else
              <img src="/images/product-image-default.png" alt="" class="show_image_2">
              @endif
              <label for="image_2" class="back">
                <p class="btn">アップロード</p>
              </label>
            </td>
          </tr>
          @error('image_2')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images image-3">
            <th></th>
            <td>
              <p>写真3</p>
              <input type="file" name="image_3_file" id="image_3" accept=".jpg,.jpeg,.png,.gif">
              <input type="hidden" name="image_3" class="image-3-text" value="{{ old('image_3') }}">
              @if (old('image_3'))
              <img src="/storage/products/{{ old('image_3') }}" alt="" class="show_image_3">
              @else
              <img src="/images/product-image-default.png" alt="" class="show_image_3">
              @endif
              <label for="image_3" class="back">
                <p class="btn">アップロード</p>
              </label>
            </td>
          </tr>
          @error('image_3')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="images image-4">
            <th></th>
            <td>
              <p>写真4</p>
              <input type="file" name="image_4_file" id="image_4" accept=".jpg,.jpeg,.png,.gif">
              <input type="hidden" name="image_4" class="image-4-text" value="{{ old('image_4') }}">
              @if (old('image_4'))
              <img src="/storage/products/{{ old('image_4') }}" alt="" class="show_image_4">
              @else
              <img src="/images/product-image-default.png" alt="" class="show_image_4">
              @endif
              <label for="image_4" class="back">
                <p class="btn">アップロード</p>
              </label>
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
            <td>
              <textarea name="product_content" cols="30" rows="5">{{ old('product_content') }}</textarea>
            </td>
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
        @if (url()->previous() === env('APP_URL'))
        <div class="back">
          <a href="/" class="btn">トップに戻る</a>
        </div>
        @else
        <div class="back">
          <a href="/products" class="btn">商品一覧に戻る</a>
        </div>
        @endif
      </form>
    </div>
  </div>
</div>
@endsection
