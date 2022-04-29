@extends('layouts.app')

@section('title')
パスワード再設定
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <p>
                パスワード再設定用のURLを記載したメールを送信します。<br>
                ご登録されたメールアドレスを入力してください。
            </p>
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <table class="form">
                    <tr class="email">
                        <th>メールアドレス</th>
                        <td><input type="text" name="email" value="{{ old('email') }}"></td>
                    </tr>
                    @error('email')
                    <tr class="error-messages">
                        <th></th>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror
                </table>

                <div class="submit">
                    <button class="btn" type="submit">送信する</button>
                </div>
                <div class="back">
                    <a href="/" class="btn">トップに戻る</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
