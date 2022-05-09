<header>
  <div class="header-left">
    <h3>{{ $title }}</h3>
  </div>
  <div class="header-right">
    <a href="/" class="btn">トップに戻る</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn" type="submit">ログアウト</button>
    </form>
  </div>
</header>
