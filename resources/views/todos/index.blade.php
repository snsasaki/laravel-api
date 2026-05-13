<!-- <!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>Todo一覧</title>
</head>

<body>
    <h1>Todo一覧</h1>

    <p>
        <form action="{{ route('todos.search') }}" method="get">
            <input type="search" name="keyword" placeholder="キーワードを入力">
            <input type="submit" name="検索" value="検索">
        </form>
    </p>

    <p>
        <a href="{{ route('todos.create') }}">新規作成</a>
    </p>

    <div hidden>検索結果</div>


    <ul>
        @foreach ($todos as $todo)
<li>
            {{ $todo->title }}

            @if ($todo->is_done)
（完了）
@else
（未完了）
@endif

            <a href="{{ route('todos.edit', $todo) }}">編集</a>

            <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </li>
@endforeach
    </ul>
</body>

</html> -->

@extends('layouts.app')

@section('title', 'Todo一覧')

@section('content')
	<h2>Todo一覧</h2>

    <p>
        <form action="{{ route('todos.search') }}" method="get">
            <input type="search" name="keyword" placeholder="キーワードを入力">
            <input type="submit" name="検索" value="検索">
        </form>
    </p>
    

	{{-- <a href="{{ route('todos.create') }}">新規作成</a>	 --}}

	@foreach ($todos as $todo)
        {{-- @if ($todo->name == Auth) --}}
            <article>
                <p>カテゴリ: {{ $todo->category->name }}</p>
                <h3>{{ $todo->title }}</h3>
                <p>{{ $todo->body }}</p>

                @if ($todo->is_done)
                <p>状態: 完了</p>
                @else
                <p>状態: 未完了</p>
                @endif
                <a href="{{ route('todos.edit', $todo) }}">編集</a>

                <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('本当に削除しますか？')">削除</button>
                </form>
            </article>
        {{-- @endif --}}
	@endforeach
@endsection