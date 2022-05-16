@extends('layouts.admin_app')

@section('title')
商品カテゴリ登録確認画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品カテゴリ登録確認', 'route' => 'admin.categories.categories', 'text' => '一覧へ戻る'])
@include('components.admin.category_confirm_form', ['route' => route('admin.categories.register')])
@endsection
