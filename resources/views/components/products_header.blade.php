<header>
  <div class="header-left">
    <h3>商品一覧</h3>
  </div>
  @auth
  <div class="header-right">
    <a href="{{ route('sell.show') }}" class="btn">新規商品登録</a>
  </div>
  @endauth
</header>
