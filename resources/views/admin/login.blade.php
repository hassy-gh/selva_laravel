@extends('layouts.admin_app')

@section('title')
管理者ログインフォーム
@endsection

@section('content')
@include('components.admin_header')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>管理画面</h2>
      <form action="{{ route('admin.login') }}" method="POST">
        @csrf
        <table class="form">
          <tr class="login-id">
            <th>ログインID</th>
            <td><input type="text" name="login_id" value="{{ old('login_id') }}"></td>
          </tr>
          @error('login_id')
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
        </table>
        <div class="submit">
          <button class="btn" type="submit">ログイン</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
