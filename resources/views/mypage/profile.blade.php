@extends('layouts.app')

@section('title')
マイページ
@endsection

@section('content')
@include('components.profile_header')
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

        <tr class="password">
          <th>パスワード</th>
          <td>セキュリティのため非表示</td>
        </tr>

        <tr class="email">
          <th>メールアドレス</th>
          <td>{{ $member->email }}</td>
        </tr>
      </table>
    </div>
  </div>
</div>
@endsection
