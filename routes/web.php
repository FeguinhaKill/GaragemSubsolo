<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\OremServicoItemController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;


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

//PRODUTOS
Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
Route::put('/produtos/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
Route::post('/produtos/search', [ProdutoController::class, 'search'])->name('produtos.search');


Route::get('/ordem_servico', [OrdemServicoController::class, 'index'])->name('ordem_servico.index');
Route::get('/ordem_servico/create', [OrdemServicoController::class, 'create'])->name('ordem_servico.create');
Route::post('/ordem_servico', [OrdemServicoController::class, 'store'])->name('ordem_servico.store');
Route::delete('/ordem_servico/{id}', [OrdemServicoController::class, 'destroy'])
    ->name('ordem_servico.destroy');
Route::get('/ordem_servico/edit/{id}', [OrdemServicoController::class, 'edit'])->name('ordem_servico.edit');
Route::put('/ordem_servico/update/{id}', [OrdemServicoController::class, 'update'])->name('ordem_servico.update');
Route::post('/ordem_servico/search', [OrdemServicoController::class, 'search'])->name('ordem_servico.search');

//ESTOQUE
Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');
Route::get('/estoque/edit/{id}', [EstoqueController::class, 'edit'])->name('estoque.edit');
Route::put('/estoque/update/{id}', [EstoqueController::class, 'update'])->name('estoque.update');
Route::post('/estoque/search', [EstoqueController::class, 'search'])->name('estoque.search');