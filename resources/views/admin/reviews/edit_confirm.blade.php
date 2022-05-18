@extends('layouts.admin_app')

@section('title')
商品レビュー編集確認画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '商品レビュー編集確認', 'route' => 'admin.reviews.reviews', 'text' => '一覧へ戻る'])
@include('components.admin.review_confirm_form', ['route' => route('admin.reviews.update', $review->id)])
@endsection
