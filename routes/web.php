<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagamentoController;
Route::get('/', function () {
    return view('index');
});
Route::get('/pagamento', [PagamentoController::class, 'index'])->name('pagamento.index');
Route::get('/pagamento/create', [PagamentoController::class, 'create'])->name('pagamento.create');
Route::post('/pagamento', [PagamentoController::class, 'store'])->name('pagamento.store');
Route::delete('/pagamento/{id}', [PagamentoController::class, 'destroy'])
    ->name('pagamento.destroy');
Route::get('pagamento/edit/{id}', [PagamentoController::class, 'edit'])->name('pagamento.edit');
Route::put('pagamento/update/{id}', [PagamentoController::class, 'update'])->name('pagamento.update');
Route::post('/pagamento/search', [PagamentoController::class, 'search'])->name('pagamento.search');
