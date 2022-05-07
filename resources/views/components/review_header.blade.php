<header>
  <div class="header-left">
    <h3>{{ $title }}</h3>
  </div>
  @auth
  <div class="header-right">
    <a href="/" class="btn">トップに戻る</a>
  </div>
  @endauth
</header>
