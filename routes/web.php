<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentoController;
Route::get('/', function () {
    return view('index');
});

//USUÁRIOS
Route::resource('usuarios', UsuarioController::class);
Route::post('usuarios/search', [UsuarioController::class, 'search'])->name('usuarios.search');

//FUNCIONÁRIOS
Route::resource('funcionarios', FuncionarioController::class);
Route::post('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');