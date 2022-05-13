<header class="admin-header">
  <div class="header-left">
    <h3>{{ $title }}</h3>
  </div>
  @auth
  <div class="header-right">
    <a href="{{ route($route) }}" class="btn">{{ $text }}</a>
  </div>
  @endauth
</header>
