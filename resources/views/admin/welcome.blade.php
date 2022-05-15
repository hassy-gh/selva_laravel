@extends('layouts.admin_app')

@section('title')
管理画面トップ画面
@endsection

@section('content')
@include('components.admin.header')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="back">
        <a href="{{ route('admin.members.members') }}" class="btn">会員一覧</a>
      </div>
      <div class="back">
        <a href="{{ route('admin.categories.categories') }}" class="btn">商品カテゴリ一覧</a>
      </div>
    </div>
  </div>
</div>
@endsection
