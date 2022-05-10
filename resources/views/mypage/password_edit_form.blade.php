@extends('layouts.app')

@section('title')
パスワード変更ページ
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>パスワード変更</h2>
      <form action="{{ route('mypage.password_update') }}" method="POST" class="password-edit">
        @csrf
        <table class="form">
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
        </table>
        <div class="submit">
          <button class="btn" type="submit">パスワードを変更</button>
        </div>
        <div class="back">
          <a href="{{ route('mypage.profile') }}" class="btn">マイページに戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
