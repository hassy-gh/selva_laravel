@extends('layouts.admin_app')

@section('title')
会員編集ページ
@endsection

@section('content')
@include('components.admin.members_header', ['title' => '会員編集', 'route' => 'admin.members.members', 'text' => '一覧へ戻る'])
@include('components.admin.member_form', ['route' => route('admin.members.edit', $member->id)])
@endsection
