<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if (!$register)
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
      @endif
      <form method="POST" action="{{ $route }}">
        @csrf
        <table class="form">
          @if ($register)
          <tr class="product">
            <th>商品</th>
            <td>
              <select name="product" id="">
                @foreach ($products as $product)
                <option value="{{ $product->id }}" {{ old('product') == $product->id ? 'selected' : '' }}>
                  {{ $product->name . '（商品ID：' . $product->id . '）' }}
                </option>
                @endforeach
              </select>
            </td>
          </tr>
          @endif
          <tr class="id">
            <th>ID</th>
            <td>
              {{ $register ? '登録後に自動採番' : $review->id }}
              @if (!$register)
              <input type="hidden" name="id" value="{{ $review->id }}">
              @endif
            </td>
          </tr>
          <tr class="evaluation">
            <th>商品評価</th>
            <td>
              <select name="evaluation">
                <option value="" hidden>選択してください</option>
                @for ($i = 1; $i <= 5; $i++) @if ($register) <option value="{{ $i }}" {{ old('evaluation') == $i ? 'selected' : '' }}>
                  @else
                  <option value="{{ $i }}" {{ old('evaluation', $review->evaluation) == $i ? 'selected' : '' }}>
                    @endif
                    {{ $i }}
                  </option>
                  @endfor
              </select>
            </td>
          </tr>
          @error('evaluation')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="comment">
            <th>商品コメント</th>
            <td>
              <textarea name="comment" cols="30" rows="5">{{ $register ? old('comment') : old('comment', $review->comment) }}</textarea>
            </td>
          </tr>
          @error('comment')
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
