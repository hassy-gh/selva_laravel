@extends('layouts.app')

@section('title')
パスワード再設定
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
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
                    <button class="btn" type="submit">パスワードリセット</button>
                </div>
                <div class="back">
                    <a href="/" class="btn">トップに戻る</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
