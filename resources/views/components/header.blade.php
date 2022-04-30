<header>
  @guest
  <div class="header-right">
    <a class="btn" href="{{ route('member.register_show') }}">新規会員登録</a>
    <a class="btn" href="{{ route('login') }}">ログイン</a>
  </div>
  @else
  <div class="header-left">
    <p>ようこそ {{ auth()->user()->name_sei }} {{ auth()->user()->name_mei }}様</p>
  </div>
  <div class="header-right">
    <a href="{{ route('sell.show') }}" class="btn">新規商品登録</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST">
      @csrf
      <button class="btn" type="submit">ログアウト</button>
    </form>
  </div>
  @endguest
</header>
