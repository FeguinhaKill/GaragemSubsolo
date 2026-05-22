<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FuncionarioController;

Route::get('/', function () {
    return view('index');
});

//USUÁRIOS
Route::post('usuarios/search', [UsuarioController::class, 'search'])->name('usuarios.search');
Route::resource('usuarios', UsuarioController::class);


//FUNCIONÁRIOS
Route::resource('funcionarios', FuncionarioController::class);
Route::post('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');