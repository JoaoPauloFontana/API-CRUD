<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function(){
    return [
        'pong' => true];
});

// Rotas do TODO
Route::post('/todo', [ApiController::class, 'createTodo']);

Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);

Route::put('/todo/{id}', [ApiController::class, 'updateTodo']);

Route::delete('/todo/{id}', [ApiController::class, 'deleteTodo']);



// Rotas do Cadastro
Route::post('/user', [AuthController::class, 'create']);
