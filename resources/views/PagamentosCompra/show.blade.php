@extends('main')
@section('titulo', 'Visualizar Pagamento da Compra')
@section('conteudo')

<div class="container mt-5">
    <div class="card shadow p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Detalhes do Pagamento #{{ $PagamentoCompra->id }}</h3>
            <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">
                Voltar
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Informações Gerais</h5>
                        <table class="table table-sm">
                            <tr>
                                <th style="width: 50%">ID Pagamento:</th>
                                <td><strong>#{{ $PagamentoCompra->id }}</strong></td>
                            </tr>
                            <tr>
                                <th>Ordem de Serviço:</th>
                                <td>
                                    <form action="{{ route('ordem_servico.search') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="tipo" value="id">
                                        <input type="hidden" name="valor" value="{{ $PagamentoCompra->ordemCompra->id }}">
                                        <button type="submit" class="btn btn-link p-0">
                                            OS #{{ $PagamentoCompra->ordemCompra->id ?? '-' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($PagamentoCompra->status === 'pago')
                                        <span class="badge bg-success">Pago</span>
                                    @elseif($PagamentoCompra->status === 'em_andamento')
                                        <span class="badge bg-warning text-dark">Em Andamento</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($PagamentoCompra->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Informações do Cliente</h5>
                        <table class="table table-sm">
                            <tr>
                                <th style="width: 50%">Cliente:</th>
                                <td><strong>{{ $PagamentoCompra->usuario->nome ?? $PagamentoCompra->usuario->name ?? '-' }}</strong></td>
                            </tr>
                            <tr>
                                <th>Tipo de Usuário:</th>
                                <td>{{ class_basename($PagamentoCompra->usuario::class) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Valores</h5>
                        <table class="table table-sm">
                            <tr>
                                <th style="width: 50%">Valor Bruto:</th>
                                <td><strong>R$ {{ number_format($PagamentoCompra->valor_bruto, 2, ',', '.') }}</strong></td>
                            </tr>
                            <tr>
                                <th>Desconto:</th>
                                <td>
                                    <strong>
                                        -% {{ number_format($PagamentoCompra->desconto, 2, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                            <tr style="border-top: 2px solid #333;">
                                <th>Valor Total:</th>
                                <td>
                                    <strong style="font-size: 1.2em; color: #28a745;">
                                        R$ {{ number_format($PagamentoCompra->valor_total, 2, ',', '.') }}
                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">Datas</h5>
                        <table class="table table-sm">
                            <tr>
                                <th>Data de Pagamento:</th>
                                <td>
                                    @if($PagamentoCompra->data_pago)
                                        <strong>{{ \Carbon\Carbon::parse($PagamentoCompra->data_pago)->format('d/m/Y H:i') }}</strong>
                                    @else
                                        <span class="text-muted">Ainda não pago</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Forma de Pagamento:</th>
                                <td>
                                    @if($PagamentoCompra->formaPagamento)
                                        {{ $PagamentoCompra->formaPagamento->nome }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="d-flex gap-2 justify-content-end">

                    @if($PagamentoCompra->status !== 'pago')
                        <form action="{{ route('pagamentoCompra.pagar', $PagamentoCompra->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja registrar o pagamentosCompra de R$ {{ number_format($PagamentoCompra->valor_total, 2, ',', '.') }}?');">
                            @csrf
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-check-circle"></i> Registrar Pagamento
                            </button>
                        </form>
                    @else
                        <div class="alert alert-success" role="alert">
                            <strong>Este pagamentosCompra já foi registrado!</strong>
                        </div>
                    @endif

                    <a href="javascript:history.back()" class="btn btn-secondary btn-lg">
                        Voltar
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
