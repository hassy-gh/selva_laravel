@extends('layouts.admin_app')

@section('title')
商品カテゴリ詳細画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品カテゴリ詳細', 'route' => 'admin.categories.categories', 'text' => '一覧へ戻る'])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <table class="profile">
        <tr class="category-id">
          <th>商品大カテゴリID</th>
          <td>{{ $category->id }}</td>
        </tr>

        <tr class="category-name">
          <th>商品大カテゴリ</th>
          <td>{{ $category->name }}</td>
        </tr>

        @foreach ($subcategories as $key => $subcategory)
        <tr class="subcategory-name">
          <th>{{ $key == 0 ? '商品小カテゴリ' : '' }}</th>
          <td>{{ $subcategory->name }}</td>
        </tr>
        @endforeach
      </table>
      <div class="buttons justify-content-center">
        <div class="back mr-3">
          <a href="{{ route('admin.categories.show_edit', $category->id) }}" class="btn">
            編集
          </a>
        </div>
        <div class="back">
          <form id="delete-form" action="{{ route('admin.categories.delete', $category->id) }}" method="POST">
            @csrf
            <button class="btn" type="submit">削除</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
