<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form method="POST" action="{{ $route }}">
        @csrf
        <table class="form">
          <tr class="id">
            <th>ID</th>
            <td>
              {{ $register ? '登録後に自動採番' : $member->id }}
            </td>
          </tr>
          <tr class="name">
            <th>氏名</th>
            <td>
              {{ $input['name_sei'] }} {{ $input['name_mei'] }}
              <input type="hidden" name="name_sei" value="{{ $input['name_sei'] }}">
              <input type="hidden" name="name_mei" value="{{ $input['name_mei'] }}">
            </td>
          </tr>

          <tr class="nickname">
            <th>ニックネーム</th>
            <td>
              {{ $input['nickname'] }}
              <input type="hidden" name="nickname" value="{{ $input['nickname'] }}">
            </td>
          </tr>

          <tr class="gender">
            <th>性別</th>
            <td>
              {{ $gender[$input['gender']] }}
              <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            </td>
          </tr>

          <tr class="password">
            <th>パスワード</th>
            <td>
              セキュリティのため非表示
              <input type="hidden" name="password" value="{{ $input['password'] }}">
              <input type="hidden" name="password_confirmation" value="{{ $input['password_confirmation'] }}">
            </td>
          </tr>

          <tr class="email">
            <th>メールアドレス</th>
            <td>
              {{ $input['email'] }}
              <input type="hidden" name="email" value="{{ $input['email'] }}">
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
