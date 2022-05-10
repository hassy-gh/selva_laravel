@extends('layouts.app')

@section('title')
メールアドレス変更認証ページ
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>メールアドレス変更　認証コード入力</h2>
      <p>
        （※メールアドレスの変更はまだ完了していません）<br>
        変更後のメールアドレスにお送りしましたメールに記載されている「認証コード」を入力してください。
      </p>
      <form action="{{ route('mypage.email_update') }}" method="POST" class="profile-edit">
        @csrf
        <table class="form">
          <tr class="auth_code">
            <th>認証コード</th>
            <td><input type="text" name="auth_code"></td>
          </tr>
          @error('auth_code')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror
        </table>
        <div class="submit">
          <button class="btn" type="submit">認証コードを送信してメールアドレスの変更を完了する</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
