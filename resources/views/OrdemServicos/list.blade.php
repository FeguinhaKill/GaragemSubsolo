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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>
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

                            <input
                                type="text"
                                class="form-control"
                                name="valor"
                                placeholder="Digite..."
                            >
                        </div>

                        <div class="col-md-2 d-grid">
                            <button
                                type="submit"
                                class="btn btn-primary"
                            >
                                Buscar
                            </button>
                        </div>

                        <div class="col-md-2 d-grid">
                            <a
                                href="{{ route('ordem_servico.index') }}"
                                class="btn btn-secondary"
                            >
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
                                <th>Usuário</th>
                                <th>Funcionário</th>
                                <th>Data Abertura</th>
                                <th>Data Fechamento</th>
                                <th>Status</th>
                                <th>Valor Total</th>
                                <th width="180">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($dados as $item)

                                <tr>

                                    <td>{{ $item->id }}</td>

                                    <td>
                                        {{ $item->usuario->nome ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->funcionario->usuario->nome ?? '-' }}
                                    </td>

                                    <td>
                                        @if($item->data_abertura)
                                            {{ $item->data_abertura->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>
                                        @if($item->data_fechamento)
                                            {{ $item->data_fechamento->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>

                                    <td>

                                        @if($item->status == 'aberta')
                                            <span class="badge bg-primary">
                                                Aberta
                                            </span>

                                        @elseif($item->status == 'em andamento')
                                            <span class="badge bg-warning text-dark">
                                                Em Andamento
                                            </span>

                                        @elseif($item->status == 'fechada')
                                            <span class="badge bg-success">
                                                Fechada
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

                                        <div class="d-flex gap-2">

                                            <a
                                                href="{{ route('ordem_servico.edit', $item->id) }}"
                                                class="btn btn-warning btn-sm"
                                            >
                                                Editar
                                            </a>

                                            <form
                                                action="{{ route('ordem_servico.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Deseja remover o registro?')"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    Excluir
                                                </button>

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