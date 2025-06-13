<?php

use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/todo', function (Request $request) {
    return $request;
});

Route::post('/todo/create', [TodoController::class, 'store']);

Route::get('/todo', [TodoController::class, 'index']);

Route::get('/todo/{id}/detail', [TodoController::class, 'show']);

Route::get('/todo/search', [TodoController::class, 'search']);

Route::get('/todo/chart', [TodoController::class, 'chart']);

Route::post('/todo/export', [TodoController::class, 'export']);
