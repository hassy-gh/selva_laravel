@extends('layouts.admin_app')

@section('title')
商品編集ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品編集', 'route' => 'admin.products.products', 'text' => '一覧へ戻る'])
@include('components.admin.product_form', ['route' => route('admin.products.edit', $product->id)])
@endsection
