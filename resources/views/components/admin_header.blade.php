<header class="admin-header">
  @auth(('administer'))
  <div class="header-left">
    <h3>管理画面メインメニュー</h3>

  </div>
  <div class="header-right">
    <p>ようこそ {{ auth()->user()->name }} さん</p>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
      @csrf
      <button class="btn" type="submit">ログアウト</button>
    </form>
  </div>
  @endguest
</header>
