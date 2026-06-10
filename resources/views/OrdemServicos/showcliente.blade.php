@extends('main')
@section('titulo', 'Detalhes da OS')
@section('conteudo')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Ordem de Serviço #{{ $ordem->id }}</h2>
            <p class="text-muted mb-0">Status: {{ ucfirst($ordem->status) }}</p>
        </div>
        <a href="{{ route('atualizacao_servico.listclientes') }}" class="btn btn-outline-secondary">Voltar para atualizações</a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <p class="mb-2"><strong>Data de abertura:</strong> {{ $ordem->data_abertura ? $ordem->data_abertura->format('d/m/Y') : '-' }}</p>
            <p class="mb-2"><strong>Data de fechamento:</strong> {{ $ordem->data_fechamento ? $ordem->data_fechamento->format('d/m/Y') : '-' }}</p>
            <p class="mb-2"><strong>Valor total:</strong> R$ {{ number_format($ordem->valor_total, 2, ',', '.') }}</p>
            <p class="mb-0"><strong>Descrição:</strong> {{ $ordem->descricao }}</p>
        </div>
    </div>

    <h4 class="mb-3">Histórico de atualizações</h4>

    @if($atualizacoes->isEmpty())
        <div class="alert alert-info mb-0">Ainda não há atualizações para esta OS.</div>
    @else
        @foreach($atualizacoes as $atualizacao)
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                        <div>
                            <h5 class="mb-1">Atualização #{{ $atualizacao->id }}</h5>
                            <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($atualizacao->data_atualizacao)->format('d/m/Y H:i') }}</p>
                        </div>
                        <span class="badge bg-success-subtle text-success-emphasis">{{ $atualizacao->funcionario->usuario->nome ?? 'Equipe' }}</span>
                    </div>
                    <p class="mb-0">{{ $atualizacao->comentario }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection
