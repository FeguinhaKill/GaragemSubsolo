@extends('main')
@section('titulo', 'Início - Bicicleta')
@section('conteudo')

<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-12">
            <div style="text-align: center; padding: 3rem 2rem;">
                <div style="font-size: 72px; margin-bottom: 20px;">🚲</div>
                <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 15px; color: #111;">Bem-vindo ao Sistema Bicicleta</h1>
                <p style="font-size: 18px; color: #6b7280; margin-bottom: 30px;">Gerenciador de ordens de serviço e estoque</p>

                <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block;">
                    <p style="font-size: 16px; color: #374151; margin-bottom: 0;">
                        Usuário logado: <strong style="color: #1D9E75;">{{ Session::get('usuario_nome') }}</strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 mb-4">
            <a href="{{ route('produtos.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body text-center" style="padding: 2rem;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📦</div>
                    <h5 class="card-title">Produtos</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar produtos</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="{{ route('estoque.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body text-center" style="padding: 2rem;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📊</div>
                    <h5 class="card-title">Estoque</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 14px;">Controlar estoque</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="{{ route('usuarios.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body text-center" style="padding: 2rem;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">👥</div>
                    <h5 class="card-title">Usuários</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar usuários</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="{{ route('ordem_servico.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body text-center" style="padding: 2rem;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">🔧</div>
                    <h5 class="card-title">Ordens de Serviço</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar ordens</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="{{ route('pagamento.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body text-center" style="padding: 2rem;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">💳</div>
                    <h5 class="card-title">Pagamentos</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar pagamentos</p>
                </div>
            </a>
        </div>

        <div class="col-md-3 mb-4">
            <a href="{{ route('ordem_servico_item.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                <div class="card-body text-center" style="padding: 2rem;">
                    <div style="font-size: 48px; margin-bottom: 1rem;">📝</div>
                    <h5 class="card-title">Itens</h5>
                    <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar itens</p>
                </div>
            </a>
        </div>
    </div>
</div>

-

@endsection
