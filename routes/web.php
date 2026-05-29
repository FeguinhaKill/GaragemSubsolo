<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\OremServicoItemController;

Route::get('/', function () {
    return view('index');
});

//USUÁRIOS
Route::resource('usuarios', UsuarioController::class);
Route::post('usuarios/search', [UsuarioController::class, 'search'])->name('usuarios.search');

//FUNCIONÁRIOS
Route::resource('funcionarios', FuncionarioController::class);
Route::post('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');

Route::get('/pagamento', [PagamentoController::class, 'index'])->name('pagamento.index');
Route::get('/pagamento/create', [PagamentoController::class, 'create'])->name('pagamento.create');
Route::post('/pagamento', [PagamentoController::class, 'store'])->name('pagamento.store');
Route::get('/pagamento/{id}/edit', [PagamentoController::class, 'edit'])->name('pagamentos.editar');
Route::put('/pagamento/{id}', [PagamentoController::class, 'update'])->name('pagamento.update');
Route::delete('/pagamento/{id}', [PagamentoController::class, 'destroy'])->name('pagamentos.deletar');
Route::post('/pagamento/search', [PagamentoController::class, 'search'])->name('pagamento.search');



Route::get('/ordem_servico', [OrdemServicoController::class, 'index'])->name('ordem_servico.index');
Route::get('/ordem_servico/create', [OrdemServicoController::class, 'create'])->name('ordem_servico.create');
Route::post('/ordem_servico', [OrdemServicoController::class, 'store'])->name('ordem_servico.store');
Route::delete('/ordem_servico/{id}', [OrdemServicoController::class, 'destroy'])
    ->name('ordem_servico.destroy');
Route::get('/ordem_servico/edit/{id}', [OrdemServicoController::class, 'edit'])->name('ordem_servico.edit');
Route::put('/ordem_servico/update/{id}', [OrdemServicoController::class, 'update'])->name('ordem_servico.update');
Route::post('/ordem_servico/search', [OrdemServicoController::class, 'search'])->name('ordem_servico.search');

