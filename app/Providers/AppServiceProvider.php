<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\OrdemCompra;
use App\Models\OrdemServico;
use App\Models\OrdemServicoitem;
use App\Models\Usuario;
use App\Observers\OrdemCompraObserver;
use App\Observers\OrdemServicoObserver;
use App\Observers\OrdemServicoItemObserver;
use App\Observers\UsuarioObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Observer para OrdemCompra - Cria PagamentoCompra automaticamente
        OrdemCompra::observe(OrdemCompraObserver::class);

        // Observer para OrdemServico - Cria Pagamento automaticamente
        OrdemServico::observe(OrdemServicoObserver::class);

        // Observer para OrdemServicoItem - Atualiza valor total da ordem
        OrdemServicoitem::observe(OrdemServicoItemObserver::class);

        // Observer para Usuario - Cria Funcionário automaticamente para usuários com categoria "funcionário"
        Usuario::observe(UsuarioObserver::class);
    }
}
