<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function(){
    return [
        'pong' => true];
});

// Rotas do TODO
Route::middleware('auth:sanctum')->post('/todo', [ApiController::class, 'createTodo']);

Route::get('/todos', [ApiController::class, 'readAllTodos']);
Route::get('/todo/{id}', [ApiController::class, 'readTodo']);

Route::middleware('auth:sanctum')->put('/todo/{id}', [ApiController::class, 'updateTodo']);

Route::middleware('auth:sanctum')->delete('/todo/{id}', [ApiController::class, 'deleteTodo']);



// Rotas do Cadastro
Route::post('/user', [AuthController::class, 'create']);
Route::middleware('auth:sanctum')->get('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth', [AuthController::class, 'login']);

Route::get('/unauthenticated', function(){
    return ['error' => 'Usuário não logado!'];
})->name('login');



// file upload route
Route::middleware('auth:sanctum')->post('/upload', function(Request $request){
    $array = [
        'error' => ''
    ];

    // rules for accepting file extensions
    $rules = [
        'foto' => 'required|mimes:jpg,png,jpeg'
    ];

    $validator = Validator::make($request->only('foto'), $rules);

    if($validator->fails()){
        $array['error'] = $validator->messages();
        return $array;
    }

    if($request->hasFile('foto')){
        if($request->file('foto')->isValid()){
            $foto = $request->file('foto')->store('public');

            $url = asset(Storage::url($foto));

            $array['url'] = $url;
        }
    }else{
        $array['error'] = 'Não foi enviado nenhum arquivo';
    }

    return $array;
});
