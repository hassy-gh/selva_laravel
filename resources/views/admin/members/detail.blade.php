@extends('layouts.admin_app')

@section('title')
会員詳細画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '会員詳細', 'route' => 'admin.members.members', 'text' => '一覧へ戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="profile">
        <tr class="id">
          <th>ID</th>
          <td>{{ $member->id }}</td>
        </tr>

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
      <div class="buttons justify-content-center">
        <div class="back mr-3">
          <a href="{{ route('admin.members.show_edit', $member->id) }}" class="btn">
            編集
          </a>
        </div>
        <div class="back">
          <form id="delete-form" action="{{ route('admin.members.delete', $member->id) }}" method="POST">
            @csrf
            <button class="btn" type="submit">削除</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
