@extends('layouts.admin_app')

@section('title')
会員一覧ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '会員一覧', 'route' => 'admin.top', 'text' => 'トップに戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="submit mb-5" style="text-align: left;">
        <a href="{{ route('admin.members.show_register') }}" class="btn">会員登録</a>
      </div>
      <form action="" method="GET" class="search-form">
        <table class="form" border="1">
          <tr class="id">
            <th>ID</th>
            <td><input type="text" name="id" value="{{ $defaults['id'] }}"></td>
          </tr>

          <tr class="gender">
            <th>性別</th>
            <td>
              <label for="man">
                <input id="man" type="checkbox" name="man" value="1" {{ $defaults['man'] ? 'checked' : '' }}>男性
              </label>
              <label for="woman">
                <input id="woman" type="checkbox" name="woman" value="2" {{ $defaults['woman'] ? 'checked' : '' }}>女性
              </label>
            </td>
          </tr>

          <tr class="free-word">
            <th>フリーワード</th>
            <td><input type="text" name="free_word" value="{{ $defaults['free_word'] }}"></td>
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
              <th>
                ID
                <form action="{{ request()->fullUrl() }}" method="GET" class="sort">
                  <input type="hidden" name="id" value="{{ $defaults['id'] }}">
                  <input type="hidden" name="man" value="{{ $defaults['man'] }}">
                  <input type="hidden" name="woman" value="{{ $defaults['woman'] }}">
                  <input type="hidden" name="free_word" value="{{ $defaults['free_word'] }}">
                  <button type="submit" name="sort" value="{{ $sort == '' ? 1 : '' }}">
                    @if ($sort == 0)
                    <i class="fas fa-caret-square-down"></i>
                    @else
                    <i class="fas fa-caret-square-up"></i>
                    @endif
                  </button>
                </form>
              </th>
              <th>氏名</th>
              <th>メールアドレス</th>
              <th>性別</th>
              <th>
                登録日時
                <form action="{{ request()->fullUrl() }}" method="GET" class="sort">
                  <input type="hidden" name="id" value="{{ $defaults['id'] }}">
                  <input type="hidden" name="man" value="{{ $defaults['man'] }}">
                  <input type="hidden" name="woman" value="{{ $defaults['woman'] }}">
                  <input type="hidden" name="free_word" value="{{ $defaults['free_word'] }}">
                  <button type="submit" name="sort" value="{{ $sort == '' ? 1 : '' }}">
                    @if ($sort == 0)
                    <i class="fas fa-caret-square-down"></i>
                    @else
                    <i class="fas fa-caret-square-up"></i>
                    @endif
                  </button>
                </form>
              </th>
              <th>編集</th>
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
              <td><a href="{{ route('admin.members.show_edit', $member->id) }}">編集</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pager">
          {{ $members->appends(request()->query())->links('vendor.pagination.original_pagination') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
