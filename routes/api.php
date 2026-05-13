<?php

use App\Http\Controllers\Api\TodoApiController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Middleware\ApiTokenAuth;
use Illuminate\Support\Facades\Route;


// Route::middleware([ApiTokenAuth::class])->group(function () {
//   Route::get('/todos', [TodoApiController::class, 'index']);
//   Route::post('/todos', [TodoApiController::class, 'store']);
// });

Route::apiResource('todos', TodoController::class)->only(['index', 'show', 'store']);
