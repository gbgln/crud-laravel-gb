<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
	$usuarios = User::all();
	return view('home', ['usuarios' => $usuarios]);
});
Route::post('/registrar', [UsuarioController::class, 'registrar']);
Route::post('/logout', [UsuarioController::class, 'logout']);
Route::post('/login', [UsuarioController::class, 'login']);
Route::get('/editar/{id}', [UsuarioController::class, 'editar']);
Route::post('/editar/{id}', [UsuarioController::class, 'atualizar']);
Route::delete('/deletar/{id}', [UsuarioController::class, 'deletar']);