@extends('layouts.admin_app')

@section('title')
商品編集確認画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品編集確認', 'route' => 'admin.products.products', 'text' => '一覧へ戻る'])
@include('components.admin.product_confirm_form', ['route' => route('admin.products.update', $product->id)])
@endsection
