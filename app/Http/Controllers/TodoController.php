<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TodoController extends Controller
{
	use AuthorizesRequests;

	private TodoService $todoService;

	public function __construct(TodoService $todoService)
	{
		$this->todoService = $todoService;
	}

	public function index(): View
	{
		// $todos = Todo::all();

		$todos = Todo::with('category')
			->latest()
			->get();

		return view('todos.index', compact('todos'));
		//compact('todos') → Viewにデータを渡す
	}
	public function search(Request $request)
	{
		$request->validate([
			'keyword' => 'nullable',
		]);

		$keyword = $request->keyword;

		// $todos = Todo::where('title', 'like', '%' . $keyword . '%')->get();
		$records = Todo::all();

		$key = 'title';

		$todos = $records->filter(function ($records) use ($key, $keyword) {
			return stripos($records[$key], $keyword) !== false;
		});

		// var_dump($filtered);
		return view('todos.index', compact('todos'));
		//compact('todos') → Viewにデータを渡す
	}

	public function create()
	{

		$categories = Category::orderBy('name')->get();

		return view('todos.create', compact('categories'));
	}

	public function store(Request $request)
	{

		$request->validate([
			'category_id' => ['required', 'exists:categories,id'],
			'title' => ['required', 'string', 'max:255'],
			'body' => ['nullable', 'string'],
			'attachment' => ['nullable', 'file', 'max:2048'],
		]);

		$this->todoService->create(
			$request->all(),
			$request->file('attachment')
		);

		return redirect()
			->route('todos.index')
			->with('success', 'Todoを作成しました。');
	}
	public function edit(Todo $todo)
	{
		$categories = Category::orderBy('name')->get();

		return view('todos.edit', compact('todo', 'categories'));
	}
	public function update(Request $request, Todo $todo)
	{

		$this->authorize('update', $todo);

		$validated = $request->validate([
			'category_id' => ['required', 'exists:categories,id'],
			'title' => 'required|max:255',
			'body' => 'nullable',
			'is_done' => 'nullable',
			'boolean',
		]);

		$validated['is_done'] = $request->boolean('is_done');

		$todo->update($validated);

		return redirect()
			->route('todos.index')
			->with('success', 'Todoを更新しました。');
	}
	public function destroy(Todo $todo)
	{
		$todo->delete();

		return redirect()->route('todos.index');
	}
}
