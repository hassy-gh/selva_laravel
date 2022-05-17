@extends('layouts.admin_app')

@section('title')
商品登録確認画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品登録確認', 'route' => 'admin.products.products', 'text' => '一覧へ戻る'])
@include('components.admin.product_confirm_form', ['route' => route('admin.products.register')])
@endsection
