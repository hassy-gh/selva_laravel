@extends('layouts.admin_app')

@section('title')
商品カテゴリ一覧ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品カテゴリ一覧', 'route' => 'admin.top', 'text' => 'トップに戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <form action="" method="GET" class="search-form">
        <table class="form" border="1">
          <tr class="id">
            <th>ID</th>
            <td><input type="text" name="id" value="{{ $defaults['id'] }}"></td>
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
      <div class="categories">
        <table border="1">
          <thead>
            <tr>
              <th>
                ID
                <form action="{{ request()->fullUrl() }}" method="GET" class="sort">
                  <input type="hidden" name="id" value="{{ $defaults['id'] }}">
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
              <th>商品カテゴリ大</th>
              <th>
                登録日時
                <form action="{{ request()->fullUrl() }}" method="GET" class="sort">
                  <input type="hidden" name="id" value="{{ $defaults['id'] }}">
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
            @foreach ($categories as $category)
            <tr>
              <td class="id">{{ $category->id }}</td>
              <td class="name">
                <a href="">
                  {{ $category->name }}
                </a>
              </td>
              <td class="created_at">{{ $category->created_at->format('Y/n/j') }}</td>
              <td><a href="">編集</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pager">
          {{ $categories->appends(request()->query())->links('vendor.pagination.original_pagination') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
