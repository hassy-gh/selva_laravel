@extends('layouts.app')

@section('title')
退会ページ
@endsection

@section('content')
@include('components.profile_header', ['title' => ''])
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <p class="mt-5" style="text-align: center;">退会します。よろしいですか？</p>
      <div class="back">
        <a href="{{ route('mypage.profile') }}" class="btn">マイページに戻る</a>
      </div>
      <div class="submit mt-5">
        <form id="logout-form" action="{{ route('mypage.withdrawal') }}" method="POST">
          @csrf
          <button class="btn" type="submit">退会</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
