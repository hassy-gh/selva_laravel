<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="{{ $route }}">
        @csrf
        <table class="form">
          <tr class="id">
            <th>ID</th>
            <td>
              {{ $register ? '登録後に自動採番' : $product->id }}
              @if (!$register)
              <input type="hidden" name="id" value="{{ $product->id }}">
              @endif
            </td>
          </tr>
          <tr class="name">
            <th>商品名</th>
            <td>
              <input type="text" name="name" value="{{ $register ? old('name') : old('name', $product->name) }}">
            </td>
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
                @if ($register)
                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>
                  @else
                <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                  @endif
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
              <select name="product_subcategory_id" id="child">
                @if ($register)
                @if (old('product_subcategory_id'))
                @foreach ($subcategories as $subcategory)
                @if (old('product_category_id') == $subcategory->product_category_id)
                <option value="{{ $subcategory->id }}" {{ old('product_subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                  {{ $subcategory->name }}
                </option>
                @endif
                @endforeach
                @endif
                @else
                @foreach ($subcategories as $subcategory)
                @if (old('product_category_id', $product->product_category_id) == $subcategory->product_category_id)
                <option value="{{ $subcategory->id }}" {{ old('product_subcategory_id', $product->product_subcategory_id) == $subcategory->id ? 'selected' : '' }}>
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
              <input type="hidden" name="image_1" class="image-1-text" value="{{ $register ? old('image_1') : old('image_1', $product->image_1) }}">
              @if ($register)
              <img src="{{ old('image_1') ? '/storage/products/'.old('image_1') : '/images/product-image-default.png' }}" alt="" class="show_image_1">
              @else
              @if (old('image_1'))
              <img src="{{ '/storage/products/'.old('image_1') }}" alt="" class="show_image_1">
              @else
              <img src="{{ $product->image_1 ? '/storage/products/'.$product->image_1 : '/images/product-image-default.png' }}" alt="" class="show_image_1">
              @endif
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
              <input type="hidden" name="image_2" class="image-2-text" value="{{ $register ? old('image_2') : old('image_2', $product->image_2) }}">
              @if ($register)
              <img src="{{ old('image_2') ? '/storage/products/'.old('image_2') : '/images/product-image-default.png' }}" alt="" class="show_image_2">
              @else
              @if (old('image_2'))
              <img src="{{ '/storage/products/'.old('image_2') }}" alt="" class="show_image_2">
              @else
              <img src="{{ $product->image_2 ? '/storage/products/'.$product->image_2 : '/images/product-image-default.png' }}" alt="" class="show_image_2">
              @endif
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
              <input type="hidden" name="image_3" class="image-3-text" value="{{ $register ? old('image_3') : old('image_3', $product->image_3) }}">
              @if ($register)
              <img src="{{ old('image_3') ? '/storage/products/'.old('image_3') : '/images/product-image-default.png' }}" alt="" class="show_image_3">
              @else
              @if (old('image_3'))
              <img src="{{ '/storage/products/'.old('image_3') }}" alt="" class="show_image_3">
              @else
              <img src="{{ $product->image_3 ? '/storage/products/'.$product->image_3 : '/images/product-image-default.png' }}" alt="" class="show_image_3">
              @endif
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
              <input type="hidden" name="image_4" class="image-4-text" value="{{ $register ? old('image_4') : old('image_4', $product->image_4) }}">
              @if ($register)
              <img src="{{ old('image_4') ? '/storage/products/'.old('image_4') : '/images/product-image-default.png' }}" alt="" class="show_image_4">
              @else
              @if (old('image_4'))
              <img src="{{ '/storage/products/'.old('image_4') }}" alt="" class="show_image_4">
              @else
              <img src="{{ $product->image_4 ? '/storage/products/'.$product->image_4 : '/images/product-image-default.png' }}" alt="" class="show_image_4">
              @endif
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
              <textarea name="product_content" cols="30" rows="5">{{ $register ? old('product_content') : old('product_content', $product->product_content) }}</textarea>
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
          <button type="submit" class="btn">確認画面へ</button>
        </div>
      </form>
    </div>
  </div>
</div>
