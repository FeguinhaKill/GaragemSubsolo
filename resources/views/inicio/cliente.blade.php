@extends('main')
@section('titulo', 'Início - Cliente')
@section('conteudo')

<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <div style="text-align: center; padding: 3rem 2rem;">
                <div style="font-size: 72px; margin-bottom: 20px;">🚲</div>
                <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 15px; color: #111;">Bem-vindo ao Sistema Bicicleta</h1>
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 30px;">Gerenciador de ordens de serviço</p>
                
                <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block;">
                    <p style="font-size: 16px; color: #374151; margin-bottom: 0;">
                        Bem-vindo, <strong style="color: #1D9E75;">{{ Session::get('usuario_nome') }}</strong>!
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12" style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
            
            <a href="{{ route('ordem_servico.create') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;">🔧</div>
                    <h5 class="card-title" style="font-size: 24px;">Criar Ordem de Serviço</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Solicit uma manutenção ou serviço para suas bicicletas</p>
                </div>
            </a>

            <a href="{{ route('pagamento.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s; width: 300px;">
                <div class="card-body text-center" style="padding: 3rem 2rem;">
                    <div style="font-size: 64px; margin-bottom: 1rem;">💳</div>
                    <h5 class="card-title" style="font-size: 24px;">Visualizar Pagamentos</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 16px; margin-top: 1rem;">Acompanhe o status de seus pagamentos</p>
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
