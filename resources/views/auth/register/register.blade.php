@extends('layouts.app')

@section('title')
会員情報登録
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>会員情報登録</h2>
            <form method="POST" action="{{ route('member.register_post') }}">
                @csrf
                <table class="form">
                    <tr class="name">
                        <th>氏名</th>
                        <td>
                            <label for="name_sei">
                                姓　<input id="name_sei" type="text" name="name_sei" value="{{ old('name_sei') }}">
                            </label>
                            <label for="name_mei">
                                名　<input id="name_mei" type="text" name="name_mei" value="{{ old('name_mei') }}">
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
                        <td><input type="text" name="nickname" value="{{ old('nickname') }}"></td>
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
                            <label for="man">
                                <input id="man" type="radio" name="gender" value="1" {{ old('gender') == 1 ? 'checked' : '' }}>男性
                            </label>
                            <label for="woman">
                                <input id="woman" type="radio" name="gender" value="2" {{ old('gender') == 2 ? 'checked' : '' }}>女性
                            </label>
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
                        <td><input type="password" name="password" value="{{ old('password') }}"></td>
                    </tr>
                    @error('password')
                    <tr class="error-messages">
                        <th></th>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror

                    <tr class="password-confirmation">
                        <th>パスワード確認</th>
                        <td><input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"></td>
                    </tr>
                    @error('password_confirmation')
                    <tr class="error-messages">
                        <th></th>
                        <td>{{ $message }}</td>
                    </tr>
                    @enderror

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
                    <button type="submit" class="btn">確認画面へ</button>
                </div>
                <div class="back">
                    <a href="/" class="btn">トップに戻る</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
