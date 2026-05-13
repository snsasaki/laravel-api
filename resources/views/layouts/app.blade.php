<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Todoアプリ')</title>
</head>

<body>
  <header>
    <h1>Todoアプリ</h1>

    <nav>
      @auth
        <a href="{{ route('posts.index') }}">投稿一覧</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">ログアウト</button>
        </form>
      @else
        <a href="{{ route('login') }}">ログイン</a>
      @endauth
      <a href="{{ route('todos.index') }}">一覧</a>
      <a href="{{ route('todos.create') }}">作成</a>
    </nav>
  </header>

  <main>
    @yield('content')
  </main>

  <footer>
    <p>© Todo App</p>
  </footer>
</body>

</html>