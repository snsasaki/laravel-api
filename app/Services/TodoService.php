<?php

namespace App\Services;

use App\Models\Todo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TodoCreatedNotification;


class TodoService
{
  public function create(array $data, ?UploadedFile $attachment = null): Todo
  {
    $attachmentPath = null;

    if ($attachment) {
      $attachmentPath = $attachment->store('todos', 'public');
    }

    $todo = Todo::create([
      'category_id' => $data['category_id'],
      'title' => $data['title'],
      'body' => $data['body'] ?? null,
      'is_done' => false,
      'attachment_path' => $attachmentPath,
      'user_id' => Auth::id(),
      // 'user_id' => 1,
    ]);

    Auth::user()?->notify(new TodoCreatedNotification());

    return $todo;
  }
}
