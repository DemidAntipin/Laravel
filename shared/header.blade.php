<header>
    <a href="/">Главная</a>
    <a href="/authours">Авторы</a>
    @if(Auth::check()) <!-- Проверка, авторизован ли пользователь -->
    <a href="{{ route('Auth::id()/posts') }}">Мои посты</a>
    <a href="{{ route('logout') }}">Выход</a>
    @else
    a href="{{ route('login') }}">Авторизация</a>
    @endif
</header>
