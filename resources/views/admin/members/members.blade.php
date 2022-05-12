@extends('layouts.admin_app')

@section('title')
会員一覧ページ
@endsection

@section('content')
@include('components.admin_header')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="" method="GET" class="search-form">
        <table class="form" border="1">
          <tr class="id">
            <th>ID</th>
            <td><input type="text" name="id"></td>
          </tr>

          <tr class="gender">
            <th>性別</th>
            <td>
              <label for="man">
                <input id="man" type="checkbox" name="gender" value="1">男性
              </label>
              <label for="woman">
                <input id="woman" type="checkbox" name="gender" value="2">女性
              </label>
            </td>
          </tr>

          <tr class="free-word">
            <th>フリーワード</th>
            <td><input type="text" name="free_word"></td>
          </tr>
        </table>
        <div class="submit">
          <button class="btn" type="submit">検索する</button>
        </div>
      </form>
      <div class="members">
        <table border="1">
          <thead>
            <tr>
              <th>ID</th>
              <th>氏名</th>
              <th>メールアドレス</th>
              <th>性別</th>
              <th>登録日時</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($members as $member)
            <tr>
              <td class="id">{{ $member->id }}</td>
              <td class="name">{{ $member->name_sei . ' ' . $member->name_mei }}</td>
              <td class="email">{{ $member->email }}</td>
              <td class="gender">{{ $gender[$member->gender] }}</td>
              <td class="created_at">{{ $member->created_at->format('Y/n/j') }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pager">
          {{ $members->links('vendor.pagination.original_pagination') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
