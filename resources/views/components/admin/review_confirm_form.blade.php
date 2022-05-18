<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="product-wrapper">
        <div class="product-image">
          @if ($register ? !is_null($product->image_1) : !is_null($review->product->image_1))
          <img src="/storage/products/{{ $register ? $product->image_1 : $review->product->image_1 }}" alt="">
          @else
          <img src="/images/product-image-default.png" alt="">
          @endif
        </div>
        <div class="product-caption">
          <p>商品ID {{ $register ? $product->id : $review->product->id }}</p>
          <p class="name">{{ $register ? $product->name : $review->product->name }}</p>
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
      <form method="POST" action="{{ $route }}">
        @csrf
        <table class="form">
          <tr class="id">
            <th>ID</th>
            <td>{{ $register ? '登録後に自動採番' : $review->id }}</td>
          </tr>
          <tr class="evaluation">
            <th>商品評価</th>
            <td>
              {{ $input['evaluation'] }}
              <input type="hidden" name="evaluation" value="{{ $input['evaluation'] }}">
            </td>
          </tr>

          <tr class="comment">
            <th>商品コメント</th>
            <td>
              {!! nl2br($input['comment']) !!}
              <textarea name="comment" cols="30" rows="5" style="display: none;"></textarea>
            </td>
          </tr>
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
