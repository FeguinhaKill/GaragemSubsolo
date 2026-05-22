<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FuncionarioController;

Route::get('/', function () {
    return view('index');
});

use App\Http\Controllers\ProdutoController;

//produtos aqui

Route::get('/produtos/estoque', [ProdutoController::class, 'consultarEstoque'])->name('produtos.estoque');


Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::post('/produtos/search', [ProdutoController::class, 'search'])->name('produtos.search');


Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('produtos.criar');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');


Route::get('/produtos/{id}/editar', [ProdutoController::class, 'edit'])->name('produtos.editar');
Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');


Route::put('/produtos/{id}/atualizar-preco', [ProdutoController::class, 'atualizarPreco'])->name('produtos.atualizarPreco');

Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.exibir');
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

//USUÁRIOS
Route::resource('usuarios', UsuarioController::class);
Route::post('usuarios/search', [UsuarioController::class, 'search'])->name('usuarios.search');

//FUNCIONÁRIOS
Route::resource('funcionarios', FuncionarioController::class);
Route::post('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');
