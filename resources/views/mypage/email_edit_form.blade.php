@extends('layouts.app')

@section('title')
メールアドレス変更
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>メールアドレス変更</h2>
      <form action="{{ route('mypage.email_edit') }}" method="POST" class="email-edit">
        @csrf
        <table class="form">
          <tr class="email">
            <th>現在のメールアドレス</th>
            <td>
              {{ $member->email }}
            </td>
          </tr>

          <tr class="email">
            <th>変更後のメールアドレス</th>
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
          <button class="btn" type="submit">認証メール送信</button>
        </div>
        <div class="back">
          <a href="{{ route('mypage.profile') }}" class="btn">マイページに戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
