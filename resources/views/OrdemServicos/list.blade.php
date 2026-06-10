@extends('main')
@section('titulo', 'Listagem de Ordens de Serviço')
@section('conteudo')

    <div class="container mt-5">
        <div class="card shadow p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Ordens de Serviço</h3>

                <a href="{{ route('ordem_servico.create') }}" class="btn btn-primary">
                    Nova Ordem
                </a>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow-sm mb-4">
                <div class="card-body">

                    <form action="{{ route('ordem_servico.search') }}" method="POST">
                        @csrf

                        <div class="row align-items-end">

                            <div class="col-md-3">
                                <label class="form-label">
                                    Tipo de Pesquisa
                                </label>

                                <select name="tipo" class="form-select">
                                    <option value="usuario">
                                        Usuário
                                    </option>

                                    <option value="funcionario">
                                        Funcionário
                                    </option>

                                    <option value="data_abertura">
                                        Data de Abertura
                                    </option>

                                    <option value="data_fechamento">
                                        Data de Fechamento
                                    </option>

                                    <option value="status">
                                        Status
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">
                                    Pesquisar
                                </label>

                                <input type="text" class="form-control" name="valor" placeholder="Digite...">
                            </div>

                            <div class="col-md-2 d-grid">
                                <button type="submit" class="btn btn-primary">
                                    Buscar
                                </button>
                            </div>

                            <div class="col-md-2 d-grid">
                                <a href="{{ route('ordem_servico.index') }}" class="btn btn-secondary">
                                    Limpar
                                </a>
                            </div>

                        </div>
                    </form>

                    <div class="table-responsive mt-4">
                        <table class="table table-hover align-middle">

                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th width="250">Usuário</th>
                                    <th width="150">Funcionário</th>
                                    <th>Data Abertura</th>
                                    <th>Data Fechamento</th>
                                    <th>Status</th>
                                    <th class="thzin">Valor Total</th>
                                    <th class="thzin">Pagamento</th>
                                    <th class="thzin">Ações</th>
                                    <th class="thzin">Descrição</th>
                                    <th class="thzin">Produtos</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($dados as $item)
                                    <tr>

                                        <td class="py-3">{{ $item->id }}</td>

                                        <td>
                                            {{ $item->usuario->nome ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item->funcionario->usuario->nome ?? '-' }}
                                        </td>

                                        <td>
                                            @if ($item->data_abertura)
                                                {{ $item->data_abertura->format('d/m/Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>
                                            @if ($item->data_fechamento)
                                                {{ $item->data_fechamento->format('d/m/Y') }}
                                            @else
                                                -
                                            @endif
                                        </td>

                                        <td>

                                            @if ($item->status == 'aberta')
                                                <span class="badge bg-success">
                                                    Aberta
                                                </span>
                                            @elseif($item->status == 'fechada')
                                                <span class="badge bg-warning">
                                                    Fechada
                                                </span>
                                            @elseif($item->status == 'atrasado')
                                                <span class="badge bg-danger">
                                                    Atrasado
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    {{ $item->status }}
                                                </span>
                                            @endif

                                        </td>

                                        <td>
                                            <strong>
                                                R$ {{ number_format($item->valor_total, 2, ',', '.') }}
                                            </strong>
                                        </td>

                                        <td>
                                            <a href="{{ route('pagamento.show', $item->id) }}"
                                                class="btn btn-dark btn-sm">
                                                Pagamento
                                            </a>
                                        </td>

                                        <td>

                                            <div class="d-flex gap-2">

                                                <a href="{{ route('ordem_servico.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Editar
                                                </a>

                                                <form action="{{ route('ordem_servico.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return confirm('Deseja remover o registro?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        Excluir
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                        <td>
                                            <a href="{{ route('pagamento.by_ordem_servico', $item->id) }}"
                                                class="btn btn-sm butao" data-bs-toggle="modal"
                                                data-bs-target="#DescricaoModal{{ $item->id }}">
                                                Descrição
                                            </a>
                                        </td>
                                        <div class="modal fade" id="DescricaoModal{{ $item->id }}" tabindex="{{ $item->id }}"
                                            aria-labelledby="DescricaoModal{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="DescricaoModal{{ $item->id }}">Descrição da OS id: {{ $item->id }}</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{ $item->descricao }}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fechar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <td>
                                            <form action="{{route('ordem_servico_item.search')}}" method="POST" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="tipo" value="ordem_servico_id">
                                                <input type="hidden" name="valor" value="{{$item->id}}">
                                                <button type="submit" class="btn btn-sm butao">
                                                    Produtos
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>

                        </table>
                    </div>
                    <a href="{{ route('ordem_servico.reportservico') }}" class="btn btn-success" target="_blank">
                        Gerar Relatório de OS
                    </a>
                    <a href="{{  route('ordem_servico.chartordem')  }}" class="btn btn-success">
                        Gerar Gráfico de OS
                    </a>
                </div>
            </div>

        </div>
    </div>

<style>
    .butao {
        background-color: #0dc0b7;
    }
    .butao:hover {
        background-color: #4690ff;
    }
    .thzin {
        width: 120px;
    }
</style>

@endsection

