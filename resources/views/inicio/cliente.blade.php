@extends('main')
@section('titulo', 'Início - Cliente')
@section('conteudo')

<div class="container mt-2">
                <div class="row mb-3">
                    <div class="col-12">
                        <div style="text-align: center; padding: 3rem 2rem;">
                            <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 25px; color: #111;"> Sistema Garage-Subsolo</h1>
                            <div
                                style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block;">
                                <p style="font-size: 16px; color: #374151; margin-bottom: 0;">
                                    Usuário logado: <strong
                                        style="color: #1D9E75;">{{ Session::get('usuario_nome') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

    <div class="row">
        <div class="col-12" style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">

            <a href="{{ route('ordem_servico.formclientes') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;"></div>
                    <h5 class="card-title" style="font-size: 24px;">Solicitar Serviço</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Solicite uma manutenção ou serviço para suas bicicletas</p>
                </div>
            </a>

            <a href="{{ route('ordem_servico.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;"></div>
                    <h5 class="card-title" style="font-size: 24px;">Visualizar Ordens de Serviços</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Acompanhe suas Ordens de Serviços</p>
                </div>
            </a>

            <a href="{{ route('atualizacao_servico.listclientes') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;"></div>
                    <h5 class="card-title" style="font-size: 24px;">Atualizações da minha OS</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Veja o histórico de atualizações das suas ordens de serviço</p>
                </div>
            </a>

            <a href="{{ route('ordem_compra.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;"></div>
                    <h5 class="card-title" style="font-size: 24px;">Visualizar Compras</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Acompanhe suas Ordens de Compras</p>
                </div>
            </a>

            <a href="{{ route('pagamento.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;"></div>
                    <h5 class="card-title" style="font-size: 24px;">Visualizar Pagamentos de Serviços</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Acompanhe seus pagamentos de Serviços</p>
                </div>
            </a>

            <a href="{{ route('pagamentoCompra.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;"></div>
                    <h5 class="card-title" style="font-size: 24px;">Visualizar Pagamentos de Compras</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Acompanhe seus pagamentos de Compras</p>
                </div>
            </a>

        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(29, 158, 117, 0.15) !important;
    }

    .card-body {
        background: white;
    }

    .card-title {
        color: #111;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
</style>

@endsection
