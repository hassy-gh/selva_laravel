@extends('layouts.admin_app')

@section('title')
商品レビュー登録ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品レビュー登録', 'route' => 'admin.reviews.reviews', 'text' => '一覧へ戻る'])
@include('components.admin.review_form', ['route' => route('admin.reviews.post')])
@endsection
