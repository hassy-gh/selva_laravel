@extends('layouts.app')

@section('title')
ログインフォーム
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>ログイン</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <table class="form">
                    <tr class="email">
                        <th>メールアドレス（ID）</th>
                        <td><input type="email" name="email" value="{{ old('email') }}"></td>
                    </tr>
                    @error('email')
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

                    <tr class="password-reset-link">
                        <th></th>
                        <td><a href="{{ route('password.request') }}" class="">パスワードを忘れた方はこちら</a></td>
                    </tr>
                </table>

                <div class="submit">
                    <button class="btn" type="submit">ログイン</button>
                </div>
                <div class="back">
                    <a href="/" class="btn">トップに戻る</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
