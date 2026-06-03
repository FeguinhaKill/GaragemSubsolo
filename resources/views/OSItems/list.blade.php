@extends('main')
@section('titulo', 'Listagem dos items das Ordens de Serviço')
@section('conteudo')

    <div class="container mt-5">
        <div class="card shadow p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Items das Ordens de Serviço</h3>

                <a href="{{ route('ordem_servico_item.create') }}" class="btn btn-primary">
                    Novo Item
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

                    <form action="{{ route('ordem_servico_item.search') }}" method="POST">
                        @csrf

                        <div class="row align-items-end">

                            <div class="col-md-3">
                                <label class="form-label">
                                    Tipo de Pesquisa
                                </label>

                                <select name="tipo" class="form-select">
                                    <option value="ordem_servico">
                                        Ordem de Serviço
                                    </option>

                                    <option value="produto">
                                        Produto
                                    </option>

                                    <option value="quantidade">
                                        Quantidade
                                    </option>

                                    <option value="valor_total">
                                        Valor total
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
                                <a href="{{ route('ordem_servico_item.index') }}" class="btn btn-secondary">
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
                                    <th>Ordem de Serviço</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor Total</th>
                                    <th>Ações</th>

                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($dados as $item)
                                    <tr>

                                        <td class="py-3">{{ $item->id }}</td>

                                        <td>
                                            {{ $item->ordem_servico_id}}
                                        </td>

                                        <td>
                                            {{ $item->produto->nome ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item->quantidade ?? '-' }}
                                        </td>

                                        <td>
                                            <strong>
                                                R$ {{ number_format($item->valor_total, 2, ',', '.') }}
                                            </strong>
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('ordem_servico_item.edit', $item->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Editar
                                                </a>

                                                <form action="{{ route('ordem_servico_item.destroy', $item->id) }}"
                                                    method="POST" onsubmit="return confirm('Deseja remover o registro?')">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm">
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

<style>

</style>

@endsection

