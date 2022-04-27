@extends('layouts.app')

@section('title')
会員登録確認画面
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <h2>会員情報確認画面</h2>
      <form method="POST" action="{{ route('member.register_register') }}">
        @csrf
        <table class="form">
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
              {{ $input['gender'] == 1 ? '男性' : '女性' }}
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
          <button type="submit" class="btn">登録完了</button>
        </div>
        <div class="back">
          <button type="submit" class="btn" name="back">前に戻る</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
