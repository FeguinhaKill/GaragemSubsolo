<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Models\Usuario;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\OrdemServicoItemController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;


// ROTAS DE AUTENTICAÇÃO (SEM MIDDLEWARE)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/funcionario/login', [AuthController::class, 'showFuncionarioLogin'])->name('funcionario.login');
Route::post('/funcionario/login', [AuthController::class, 'loginFuncionario'])->name('funcionario.auth.login');
Route::get('/registro', [AuthController::class, 'showRegister'])->name('auth.register');
Route::post('/registro', [AuthController::class, 'register'])->name('auth.register');

// ROTA INICIAL
Route::get('/', function () {
    $produtos = \App\Models\Produto::where('tipo', 'Bicicleta')
                    ->inRandomOrder()
                    ->take(5)
                    ->get();
    return view('index', compact('produtos'));
})->name('home');

// TODAS AS ROTAS PROTEGIDAS COM MIDDLEWARE DE VERIFICAÇÃO DE LOGIN
Route::middleware(['verify_login', 'restrict_client'])->group(function () {

    // INÍCIO
    Route::get('/inicio', function () {
        $usuarioLogado = Usuario::find(Session::get('usuario_id'));

        if ($usuarioLogado && $usuarioLogado->categoria_usuario === 'cliente') {
            return view('inicio.cliente');
        }

        return view('main');
    })->name('inicio');

    // LOGOUT
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    // USUÁRIOS
    Route::resource('usuarios', UsuarioController::class);
    Route::post('usuarios/search', [UsuarioController::class, 'search'])->name('usuarios.search');

    // FUNCIONÁRIOS
    Route::resource('funcionarios', FuncionarioController::class);
    Route::post('funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');

    // PAGAMENTOS
    Route::get('/pagamento', [PagamentoController::class, 'index'])->name('pagamento.index');
    Route::get('/pagamento/create', [PagamentoController::class, 'create'])->name('pagamento.create');
    Route::post('/pagamento', [PagamentoController::class, 'store'])->name('pagamento.store');
    Route::get('/pagamento/{id}/show', [PagamentoController::class, 'show'])->name('pagamento.show');
    Route::get('/pagamento/{id}/edit', [PagamentoController::class, 'edit'])->name('pagamentos.editar');
    Route::put('/pagamento/{id}', [PagamentoController::class, 'update'])->name('pagamento.update');
    Route::post('/pagamento/{id}/pagar', [PagamentoController::class, 'pagar'])->name('pagamento.pagar');
    Route::delete('/pagamento/{id}', [PagamentoController::class, 'destroy'])->name('pagamentos.deletar');
    Route::post('/pagamento/search', [PagamentoController::class, 'search'])->name('pagamento.search');
    Route::get('/pagamento/ordem_servico/{id}', [PagamentoController::class, 'searchByOrdemServico'])->name('pagamento.by_ordem_servico');

    // PRODUTOS
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
    Route::get('/produtos/edit/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/update/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::post('/produtos/search', [ProdutoController::class, 'search'])->name('produtos.search');

    // ORDENS DE SERVIÇO
    Route::get('/ordem_servico', [OrdemServicoController::class, 'index'])->name('ordem_servico.index');
    Route::get('/ordem_servico/create', [OrdemServicoController::class, 'create'])->name('ordem_servico.create');
    Route::post('/ordem_servico', [OrdemServicoController::class, 'store'])->name('ordem_servico.store');
    Route::delete('/ordem_servico/{id}', [OrdemServicoController::class, 'destroy'])
        ->name('ordem_servico.destroy');
    Route::get('/ordem_servico/edit/{id}', [OrdemServicoController::class, 'edit'])->name('ordem_servico.edit');
    Route::put('/ordem_servico/update/{id}', [OrdemServicoController::class, 'update'])->name('ordem_servico.update');
    Route::post('/ordem_servico/search', [OrdemServicoController::class, 'search'])->name('ordem_servico.search');

    // ITENS DE ORDEM DE SERVIÇO
    Route::get('/ordem_servico_item', [OrdemServicoItemController::class, 'index'])->name('ordem_servico_item.index');
    Route::get('/ordem_servico_item/create', [OrdemServicoItemController::class, 'create'])->name('ordem_servico_item.create');
    Route::post('/ordem_servico_item', [OrdemServicoItemController::class, 'store'])->name('ordem_servico_item.store');
    Route::delete('/ordem_servico_item/{id}', [OrdemServicoItemController::class, 'destroy'])
        ->name('ordem_servico_item.destroy');
    Route::get('/ordem_servico_item/edit/{id}', [OrdemServicoItemController::class, 'edit'])->name('ordem_servico_item.edit');
    Route::put('/ordem_servico_item/update/{id}', [OrdemServicoItemController::class, 'update'])->name('ordem_servico_item.update');
    Route::post('/ordem_servico_item/search', [OrdemServicoItemController::class, 'search'])->name('ordem_servico_item.search');

    // ESTOQUE
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque.index');
    Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
    Route::post('/estoque', [EstoqueController::class, 'store'])->name('estoque.store');
    Route::delete('/estoque/{id}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');
    Route::get('/estoque/edit/{id}', [EstoqueController::class, 'edit'])->name('estoque.edit');
    Route::put('/estoque/update/{id}', [EstoqueController::class, 'update'])->name('estoque.update');
    Route::post('/estoque/search', [EstoqueController::class, 'search'])->name('estoque.search');

});
