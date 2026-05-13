<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Services\TodoService;
use Illuminate\Http\Request;

class TodoApiController extends Controller
{
	private TodoService $todoService;

	public function index()
	{
		$todos = Todo::latest()->get();

		return response()->json($todos);
	}
	public function store(Request $request)
	{
		$request->validate([
			'category_id' => ['required', 'exists:categories,id'],
			'title' => ['required', 'string', 'max:255'],
			'body' => ['nullable', 'string'],
		]);

		$this->todoService = new TodoService;

		$todo = $this->todoService->create($request->all());
		// return json_encode('success');

		return response()->json($todo, 201);
	}
}
