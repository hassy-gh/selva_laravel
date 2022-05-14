@extends('layouts.admin_app')

@section('title')
会員登録確認画面
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '会員登録', 'route' => 'admin.members.members', 'text' => '一覧へ戻る'])
@include('components.admin.member_confirm_form', ['route' => route('admin.members.register')])
@endsection
