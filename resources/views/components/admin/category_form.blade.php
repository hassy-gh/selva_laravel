<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="{{ $route }}">
        @csrf
        <table class="form">
          <tr class="category-id">
            <th>商品大カテゴリID</th>
            <td>
              {{ $register ? '登録後に自動採番' : $category->id }}
              @if (!$register)
              <input type="hidden" name="id" value="{{ $category->id }}">
              @endif
            </td>
          </tr>
          <tr class="category-name">
            <th>商品大カテゴリ</th>
            <td>
              <input type="text" name="category_name" value="{{ $register ? old('category_name') : old('category_name', $category->name) }}">
            </td>
          </tr>
          @error('category_name')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          @for ($i = 0; $i < 10; $i++) <tr class="subcategory-name">
            <th>{{ $i == 0 ? '商品小カテゴリ' : '' }}</th>
            <td>
              @if (isset($subcategories[$i]))
              <input type="text" name="subcategory_name[]" value="{{ $register ? old("subcategory_name.$i") : old("subcategory_name.$i", $subcategories[$i]->name) }}">
              @else
              <input type="text" name="subcategory_name[]" value="{{ $register ? old("subcategory_name.$i") : old("subcategory_name.$i") }}">
              @endif
            </td>
            </tr>
            @endfor
            @error('subcategory_name.*')
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
