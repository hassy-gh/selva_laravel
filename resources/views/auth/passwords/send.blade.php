@extends('layouts.app')

@section('title')
パスワード再設定
@endsection

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <p style="text-align: center;">
        パスワード再設定の案内メールを送信しました。<br>
        （まだパスワード再設定は完了しておりません。）<br>
        届きましたメールに記載されている<br>
        『パスワード再設定URL』をクリックし、<br>
        パスワードの再設定を完了させてください。
      </p>
      <div class="back">
        <a href="/" class="btn">トップに戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection
