@extends('layouts.app')

@section('title')
会員情報変更確認画面
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>会員情報変更確認画面</h2>
      <form action="{{ route('mypage.profile_update') }}" method="POST" class="profile-edit">
        @csrf
        <table class="form">
          <tr class="name">
            <th>氏名</th>
            <td>
              {{ $input['name_sei'] . ' ' . $input['name_mei'] }}
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
              {{ $gender[$input['gender']] }}
              <input type="hidden" name="gender" value="{{ $input['gender'] }}">
            </td>
          </tr>
        </table>
        <div class="submit">
          <button class="btn" type="submit">変更完了</button>
        </div>
        <div class="back">
          <button class="btn" type="submit" name="back">前に戻る</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
