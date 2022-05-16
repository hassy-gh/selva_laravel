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
            </td>
          </tr>

          <tr class="category-name">
            <th>商品大カテゴリ</th>
            <td>
              {{ $input['category_name'] }}
              <input type="hidden" name="category_name" value="{{ $input['category_name'] }}">
            </td>
          </tr>

          @foreach ($input['subcategory_name'] as $key => $subcategory_name)
          @if (!is_null($subcategory_name))
          <tr class="subcategory_name">
            <th>{{ $key == 0 ? '商品小カテゴリ' : '' }}</th>
            <td>
              {{ $subcategory_name }}
              <input type="hidden" name="subcategory_name[]" value="{{ $subcategory_name }}">
            </td>
          </tr>
          @endif
          @endforeach
        </table>

        <div class="submit">
          <button type="submit" class="btn">{{ $register ? '登録完了' : '編集完了' }}</button>
        </div>
        <div class="back">
          <button class="btn" type="submit" name="back">前に戻る</button>
        </div>
      </form>
    </div>
  </div>
</div>
