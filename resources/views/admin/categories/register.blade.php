@extends('layouts.admin_app')

@section('title')
商品カテゴリ登録ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品カテゴリ登録', 'route' => 'admin.categories.categories', 'text' => '一覧へ戻る'])
@include('components.admin.category_form', ['route' => route('admin.categories.post')])
@endsection
