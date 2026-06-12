@extends('main')
@section('titulo', 'Início - Cliente')
@section('conteudo')
@section('body_class', 'sticky-footer')

<div style="padding: 1.5rem 60px;">

    {{-- boas vindas --}}
    <div style="background: var(--color-background-secondary, #f3f4f6); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
        <div>
            <h2 style="font-size: 20px; font-weight: 500; margin: 0 0 4px;">Bem-vindo de volta</h2>
            <p style="font-size: 13px; color: #6b7280; margin: 0;">O que você precisa hoje?</p>
        </div>
        <span style="background: #E1F5EE; color: #0F6E56; font-size: 13px; font-weight: 500; padding: 6px 14px; border-radius: 20px;">
            {{ Session::get('usuario_nome') }}
        </span>
    </div>

    {{-- grid de cards --}}
    <div style="display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 12px;">

        <a href="{{ route('ordem_servico.formclientes') }}" class="dash-card">
            <div class="dash-icon" style="background: #E1F5EE; color: #0F6E56;">🔧</div>
            <p class="dash-title">Solicitar serviço</p>
            <p class="dash-desc">Solicite manutenção ou serviço para suas bicicletas</p>

        </a>

        <a href="{{ route('atualizacao_servico.listclientes') }}" class="dash-card">
            <div class="dash-icon" style="background: #E6F1FB; color: #185FA5;">📅</div>
            <p class="dash-title">Atualizações da OS</p>
            <p class="dash-desc">Veja o histórico de atualizações das suas ordens</p>

        </a>

        <a href="{{ route('pagamento.index') }}" class="dash-card">
            <div class="dash-icon" style="background: #EAF3DE; color: #3B6D11;">🧾</div>
            <p class="dash-title">Pagamentos de serviços</p>
            <p class="dash-desc">Acompanhe seus pagamentos de serviços</p>

        </a>

        <a href="{{ route('pagamentoCompra.index') }}" class="dash-card">
            <div class="dash-icon" style="background: #FBEAF0; color: #993556;">💳</div>
            <p class="dash-title">Pagamentos de compras</p>
            <p class="dash-desc">Acompanhe seus pagamentos de compras</p>

        </a>

    </div>
</div>

<style>
    .dash-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.25rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        gap: 10px;
        transition: border-color 0.15s, transform 0.15s;
    }
    .dash-card:hover {
        border-color: #1D9E75;
        transform: translateY(-2px);
        color: inherit;
    }
    .dash-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    .dash-title {
        font-size: 14px;
        font-weight: 500;
        margin: 0;
        color: #111;
    }
    .dash-desc {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
        line-height: 1.5;
    }
    .dash-arrow {
        font-size: 14px;
        color: #9ca3af;
        margin-top: auto;
    }
</style>

@endsection
