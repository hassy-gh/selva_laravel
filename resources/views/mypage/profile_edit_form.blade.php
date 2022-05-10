@extends('layouts.app')

@section('title')
会員情報変更ページ
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>会員情報変更</h2>
      <form action="{{ route('mypage.profile_edit') }}" method="POST" class="profile-edit">
        @csrf
        <table class="form">
          <tr class="name">
            <th>氏名</th>
            <td>
              <label for="name_sei">
                姓　<input id="name_sei" type="text" name="name_sei" value="{{ old('name_sei', $member->name_sei) }}">
              </label>
              <label for="name_mei">
                名　<input id="name_mei" type="text" name="name_mei" value="{{ old('name_mei', $member->name_mei) }}">
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
            <td><input type="text" name="nickname" value="{{ old('nickname', $member->nickname) }}"></td>
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
                <input id="man" type="radio" name="gender" value="1" {{ old('gender', $member->gender) == 1 ? 'checked' : '' }}>男性
              </label>
              <label for="woman">
                <input id="woman" type="radio" name="gender" value="2" {{ old('gender', $member->gender) == 2 ? 'checked' : '' }}>女性
              </label>
            </td>
          </tr>
          @error('gender')
          <tr class="error-messages">
            <th></th>
            <td>{{ $message }}</td>
          </tr>
          @enderror
        </table>
        <div class="submit">
          <button class="btn" type="submit">確認画面へ</button>
        </div>
        <div class="back">
          <a href="{{ route('mypage.profile') }}" class="btn">マイページに戻る</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
