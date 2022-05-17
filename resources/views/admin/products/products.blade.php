@extends('layouts.admin_app')

@section('title')
商品一覧ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品一覧', 'route' => 'admin.top', 'text' => 'トップに戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="submit mb-5" style="text-align: left;">
        <a href="{{ route('admin.products.show_register') }}" class="btn">商品登録</a>
      </div>
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
      <div class="products">
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
              <th>商品名</th>
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
              <th>詳細</th>
            </tr>
          </thead>

          <tbody>
            @foreach ($products as $product)
            <tr>
              <td class="id">{{ $product->id }}</td>
              <td class="name">
                <a href="{{ route('admin.products.detail', $product->id) }}">
                  {{ $product->name }}
                </a>
              </td>
              <td class="created_at">{{ $product->created_at->format('Y/n/j') }}</td>
              <td>
                <a href="{{ route('admin.products.show_edit', $product->id) }}">
                  編集
                </a>
              </td>
              <td>
                <a href="{{ route('admin.products.detail', $product->id) }}">
                  詳細
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pager">
          {{ $products->appends(request()->query())->links('vendor.pagination.original_pagination') }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
