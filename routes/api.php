<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function(){
    return [
        'pong' => true];
});

// CRUD DO TODO
// CREATE -> Métodos para criar uma tarefa
// READ -> Métodos para ler uma ou todas as tarefas
// UPDATE -> Métodos para atualizar uma tarefa
// DELETE -> Métodos para deletar uma tarefa

Route::post('/todo', [ApiController::class, 'createTodo']);

Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);

Route::put('/todo/{id}', [ApiController::class, 'updateTodo']);

Route::delete('/todo/{id}', [ApiController::class, 'deleteTodo']);
