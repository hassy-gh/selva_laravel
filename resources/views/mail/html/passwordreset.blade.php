@extends('layouts/app')

@section('content')
<div class="mail-header">
  <table>
    <tr>
      <th>差出人：</th>
      <td>{{ config('mail.from.address') }}</td>
    </tr>
    <tr>
      <th>宛先：</th>
      <td>{{ $to }}</td>
    </tr>
    <tr>
      <th>件名：</th>
      <td>{{$title}}</td>
    </tr>
  </table>
</div>
<div class="mail-title">
  <h2>パスワード再発行</h2>
</div>
<div class="mail-content">
  <p>以下のURLをクリックしてパスワードを再発行してください。</p>
  <div class="submit">
    <a href="{{$reset_url}}" class="btn">{{$reset_url}}</a>
  </div>
</div>
@endsection
