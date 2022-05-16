@extends('layouts.admin_app')

@section('title')
商品カテゴリ編集ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品カテゴリ編集', 'route' => 'admin.categories.categories', 'text' => '一覧へ戻る'])
@include('components.admin.category_form', ['route' => route('admin.categories.edit', $category->id)])
@endsection
