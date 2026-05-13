<!-- <!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>新規作成</title>
</head>

<body>
	<h1>新規作成</h1>

	<form action="/todos" method="POST">
		@csrf
		<div>
			<label for="title">タイトル</label>
			<input id="title" type="text" name="title" value="{{ old('title') }}">

			@error('title')
			<p>{{ $message }}</p>
			@enderror
		</div>

		<div>
			<label for="body">内容</label>
			<textarea id="body" name="body">{{ old('body') }}</textarea>

			@error('body')
			<p>{{ $message }}</p>
			@enderror
		</div>
		<button type="submit">作成</button>
	</form>

</html> -->

@extends('layouts.app')

@section('title', 'Todo作成')

@section('content')
<h2>Todo作成</h2>

<form method="POST" action="{{ route('todos.store') }}" enctype="multipart/form-data">
	@csrf

	<div>
		<label for="category_id">カテゴリ</label>

		<select id="category_id" name="category_id">
			<option value="">選択してください</option>

			@foreach ($categories as $category)
			<option value="{{ $category->id }}" @selected(old('category_id')==$category->id)>
				{{ $category->name }}
			</option>
			@endforeach
		</select>

		@error('category_id')
		<p>{{ $message }}</p>
		@enderror
	</div>

	<div>
		<label for="title">タイトル</label>
		<input id="title" type="text" name="title" value="{{ old('title') }}">

		@error('title')
		<p>{{ $message }}</p>
		@enderror
	</div>

	<div>
		<label for="body">内容</label>
		<textarea id="body" name="body">{{ old('body') }}</textarea>

		@error('body')
		<p>{{ $message }}</p>
		@enderror
	</div>

	<div>
		<label for="attachment"></label>
		<input type="file" name="attachment">
		@error('attachment')
		<p>{{ $message }}</p>
		@enderror
	</div>

	<button type="submit">登録</button>
</form>
@endsection