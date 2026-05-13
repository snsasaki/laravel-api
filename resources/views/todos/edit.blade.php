<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Todo編集</title>
</head>

<body>
  <h1>Todo編集</h1>

  <form action="{{ route('todos.update', $todo) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
      <label for="title">カテゴリ</label>
      <select name="category_id" id="category_id">
        @foreach ($categories as $category)
			    <option value="{{ $category->id }}" @selected($todo->category_id == $category->id || old('category_id')==$category->id)>
				    {{ $category->name }}
			    </option>
			  @endforeach
      </select>
      @error('title')
        <p>{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="title">タイトル</label>
      <input type="text" name="title" value="{{ old('title', $todo->title) }}">
      @error('title')
      <p>{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="body">内容</label>
      <textarea id="body" name="body">{{ old('body', $todo->body) }}</textarea>
      @error('body')
      <p>{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label>
        <input type="checkbox" name="is_done" value="1" @checked(old('is_done', $todo->is_done))>
        完了済みにする
      </label>
      @error('is_done')
      <p>{{ $message }}</p>
      @enderror
    </div>

    <button type="submit">更新</button>
  </form>

  <p>
    <a href="{{ route('todos.index') }}">一覧へ戻る</a>
  </p>
</body>

</html>