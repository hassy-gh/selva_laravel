@extends('layouts.app')

@section('title')
マイページ
@endsection

@section('content')
@include('components.profile_header', ['title' => 'マイページ'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="profile">
        <tr class="name">
          <th>氏名</th>
          <td>{{ $member->name_sei . ' ' . $member->name_mei }}</td>
        </tr>

        <tr class="nickname">
          <th>ニックネーム</th>
          <td>{{ $member->nickname }}</td>
        </tr>

        <tr class="gender">
          <th>性別</th>
          <td>{{ $gender[$member->gender] }}</td>
        </tr>

        <tr>
          <th></th>
          <td>
            <div class="submit" style="text-align: left;">
              <a href="{{ route('mypage.show_profile_edit') }}" class="btn">
                会員情報変更
              </a>
            </div>
          </td>
        </tr>

        <tr class="password">
          <th>パスワード</th>
          <td>セキュリティのため非表示</td>
        </tr>

        <tr>
          <th></th>
          <td>
            <div class="submit" style="text-align: left;">
              <a href="{{ route('mypage.show_password_edit') }}" class="btn">
                パスワード変更
              </a>
            </div>
          </td>
        </tr>

        <tr class="email">
          <th>メールアドレス</th>
          <td>{{ $member->email }}</td>
        </tr>

        <tr>
          <th></th>
          <td>
            <div class="submit" style="text-align: left;">
              <a href="{{ route('mypage.show_email_edit') }}" class="btn">
                メールアドレス変更
              </a>
            </div>
          </td>
        </tr>

        <tr>
          <th></th>
          <td>
            <div class="submit" style="text-align: left;">
              <a href="{{ route('mypage.reviews') }}" class="btn">
                商品レビュー管理
              </a>
            </div>
          </td>
        </tr>
      </table>
      <div class="back">
        <a href="{{ route('mypage.withdrawal_confirm') }}" class="btn">退会</a>
      </div>
    </div>
  </div>
</div>
@endsection
