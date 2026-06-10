@extends('main')
@section('titulo', 'Atualizações da minha OS')
@section('conteudo')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Atualizações da sua OS</h2>
            <p class="text-muted mb-0">Acompanhe o histórico de andamento das suas ordens de serviço.</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Voltar</a>
    </div>

    @if($atualizacoes->isEmpty())
        <div class="alert alert-info mb-0">
            Ainda não há atualizações registradas para suas ordens de serviço.
        </div>
    @else
        @foreach($atualizacoes as $atualizacao)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                        <div>
                            <h5 class="mb-1">OS #{{ $atualizacao->ordem_servico_id }}</h5>
                            <p class="text-muted mb-0">Atualizado em {{ \Carbon\Carbon::parse($atualizacao->data_atualizacao)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <a href="{{ route('ordem_servico.show', $atualizacao->ordem_servico_id) }}" class="btn btn-sm btn-primary">Abrir OS</a>
                            <span class="badge bg-success-subtle text-success-emphasis">{{ $atualizacao->funcionario->usuario->nome ?? 'Equipe' }}</span>
                        </div>
                    </div>
                    <p class="mb-0">{{ $atualizacao->comentario }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection
