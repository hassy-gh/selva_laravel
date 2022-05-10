@extends('layouts/app')

@section('content')
<div class="mail-title">
  <h2>メールアドレス変更の認証コード</h2>
</div>
<div class="mail-content">
  <p>以下の認証コードを入力してください。</p>
  <p>【{{ $auth_code }}】</p>
</div>
@endsection
