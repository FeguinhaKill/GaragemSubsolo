@extends('main')
@section('titulo', 'Listagem de Pagamentos')
@section('conteudo')

@include('header')

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('pagamentos.pesquisar') }}" method="post">
                    @csrf
                    <div class="row gy-3 gx-3 align-items-end">
                        <div class="col-12 col-md-3">
                            <label class="form-label">Tipo</label>
                            <select name="tipo" class="form-select">
                                <option value="ordem_servico_id">Ordem de Serviço</option>
                                <option value="usuario_id">Usuário</option>
                                <option value="status">Status</option>
                                <option value="valor_total">Valor Total</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-5">
                            <label class="form-label">Valor</label>
                            <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                        </div>
                        <div class="col-12 col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ordem de Serviço</th>
                                <th>Usuário</th>
                                <th>Valor Bruto</th>
                                <th>Desconto</th>
                                <th>Valor Total</th>
                                <th>Forma de Pagamento</th>
                                <th>Status</th>
                                <th>Data de Vencimento</th>
                                <th>Data de Pagamento</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dados as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <a href="{{ route('ordemservicos.show', $item->ordem_servico_id) }}">
                                            OS #{{ $item->ordemServico->id }}
                                        </a>
                                    </td>
                                    <td>{{ $item->usuario->nome ?? $item->usuario->name }}</td>
                                    <td>R$ {{ number_format($item->valor_bruto, 2, ',', '.') }}</td>
                                    <td>
                                        @if($item->desconto > 0)
                                            R$ {{ number_format($item->desconto, 2, ',', '.') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td><strong>R$ {{ number_format($item->valor_total, 2, ',', '.') }}</strong></td>
                                    <td>{{ $item->formaPagamento->nome }}</td>
                                    <td>
                                        @if($item->status === 'pago')
                                            <span class="badge bg-success">Pago</span>
                                        @elseif($item->status === 'em_andamento')
                                            <span class="badge bg-warning text-dark">Em Andamento</span>
                                        @elseif($item->status === 'atrasado')
                                            <span class="badge bg-danger">Atrasado</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->data_vencimento)
                                            {{ \Carbon\Carbon::parse($item->data_vencimento)->format('d/m/Y') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->data_pago)
                                            {{ \Carbon\Carbon::parse($item->data_pago)->format('d/m/Y H:i') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2 flex-wrap">
                                            <a href="{{ route('pagamentos.editar', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                            <form action="{{ route('pagamentos.deletar', $item->id) }}" method="post" class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja remover o registro?')">Deletar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop