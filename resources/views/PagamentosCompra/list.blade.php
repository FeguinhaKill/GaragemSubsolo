@extends('main')
@section('titulo', 'Listagem de Pagamentos das Compras')
@section('conteudo')

@php
    use Illuminate\Support\Facades\Session;
    $usuarioLogado = \App\Models\Usuario::find(Session::get('usuario_id'));
@endphp

<div class="container mt-5">
    <div class="card shadow p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Pagamentos Compra</h3>
            <a href="{{ route('pagamentoscompra.reportpagamentocompra') }}" class="btn btn-success" target="_blank">Gerar Relatório</a>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($usuarioLogado && $usuarioLogado->categoria_usuario === 'cliente')
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                Exibindo pagamentos de <strong>{{ $usuarioLogado->nome }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @else
            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <form action="{{ route('pagamentoCompra.search') }}" method="POST">
                        @csrf

                        <div class="row align-items-end">
                            <div class="col-md-3">
                                <label class="form-label">Tipo de Pesquisa</label>

                                <select name="tipo" class="form-select">
                                    <option value="ordem_servico_id">Ordem de Compra</option>
                                    <option value="usuario_id">Usuário</option>
                                    <option value="status">Status</option>
                                    <option value="valor_total">Valor Total</option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Pesquisar</label>

                                <input
                                    type="text"
                                    name="valor"
                                    class="form-control"
                                    placeholder="Digite..."
                                >
                            </div>

                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Buscar
                                </button>
                            </div>

                            <div class="col-md-2 d-grid">
                                <a href="{{ route('pagamento.index') }}" class="btn btn-secondary">
                                    Limpar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <div class="table-responsive mt-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Ordem Compra</th>
                                <th>Usuário</th>
                                <th>Valor Bruto</th>
                                <th>Valor Total</th>
                                <th>Forma Pagamento</th>
                                <th>Status</th>
                                <th>Pagamento</th>
                                <th width="180">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($dados as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>

                                    <td>
                                        OC #{{ $item->ordemCompra->id ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->usuario->nome ?? '-' }}
                                    </td>

                                    <td>
                                        R$ {{ number_format($item->valor_bruto, 2, ',', '.') }}
                                    </td>

                                    <td>
                                        <strong>
                                            R$ {{ number_format($item->valor_total, 2, ',', '.') }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $item->formaPagamento->nome ?? '-' }}
                                    </td>

                                    <td>
                                        @if($item->status === 'pago')
                                            <span class="badge bg-success">
                                                Pago
                                            </span>

                                        @elseif($item->status === 'em_andamento')
                                            <span class="badge bg-warning text-dark">
                                                Em Andamento
                                            </span>

                                        @elseif($item->status === 'atrasado')
                                            <span class="badge bg-danger">
                                                Atrasado
                                            </span>

                                        @else
                                            <span class="badge bg-secondary">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->data_pago)
                                            {{ \Carbon\Carbon::parse($item->data_pago)->format('d/m/Y H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2">

                                            <a
                                                href="{{ route('pagamentoCompra.show', $item->id) }}"
                                                class="btn btn-info btn-sm"
                                            >
                                                Visualizar Pagamento
                                            </a>
                                                @csrf
                                                @method('DELETE')

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

@endsection
