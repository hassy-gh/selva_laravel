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
              @if (!$register)
              <input type="hidden" name="id" value="{{ $member->id }}">
              @endif
            </td>
          </tr>
          <tr class="name">
            <th>氏名</th>
            <td>
              <label for="name_sei">
                姓　<input id="name_sei" type="text" name="name_sei" value="{{ $register ? old('name_sei') : old('name_sei', $member->name_sei) }}">
              </label>
              <label for="name_mei">
                名　<input id="name_mei" type="text" name="name_mei" value="{{ $register ? old('name_mei') : old('name_mei', $member->name_mei) }}">
              </label>
            </td>
          </tr>
          @error('name_sei')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror
          @error('name_mei')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="nickname">
            <th>ニックネーム</th>
            <td><input type="text" name="nickname" value="{{ $register ? old('nickname') : old('nickname', $member->nickname) }}"></td>
          </tr>
          @error('nickname')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="gender">
            <th>性別</th>
            <td>
              @if ($register)
              <label for="man">
                <input id="man" type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性
              </label>
              <label for="woman">
                <input id="woman" type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性
              </label>
              @else
              <label for="man">
                <input id="man" type="radio" name="gender" value="1" {{ old('gender', $member->gender) == 1 ? 'checked' : '' }}>男性
              </label>
              <label for="woman">
                <input id="woman" type="radio" name="gender" value="2" {{ old('gender', $member->gender) == 2 ? 'checked' : '' }}>女性
              </label>
              @endif
            </td>
          </tr>
          @error('gender')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="password">
            <th>パスワード</th>
            <td><input type="password" name="password"></td>
          </tr>
          @error('password')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="password-confirmation">
            <th>パスワード確認</th>
            <td><input type="password" name="password_confirmation"></td>
          </tr>
          @error('password_confirmation')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror

          <tr class="email">
            <th>メールアドレス</th>
            <td><input type="text" name="email" value="{{ $register ? old('email') : old('email', $member->email) }}"></td>
          </tr>
          @error('email')
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
