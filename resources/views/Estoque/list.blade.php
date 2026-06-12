@extends('main')
@section('titulo', 'Listagem de Estoque')
@section('conteudo')

<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Estoque</h3>
            <div class="d-flex gap-2">
                <a href="{{ route('estoque.chart') }}" class="btn btn-success">Ver gráfico</a>
                <a href="{{ route('estoque.create') }}" class="btn btn-primary">Novo Registro</a>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form action="{{ route('estoque.search') }}" method="POST">
                    @csrf
                    <!-- Barra de Pesquisa -->
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Pesquisa</label>
                            <select name="tipo" class="form-select">
                                <option value="produto">Produto</option>
                                <option value="quantidade">Quantidade</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Pesquisar</label>
                            <input 
                                type="text"
                                name="valor"
                                class="form-control"
                                placeholder="Digite..."
                            >
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                        <div class="col-md-2 d-grid">
                            <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Limpar</a>
                        </div>
                    </div>
                </form>

                <!-- Tabela de Estoque -->
                <table class="table table-hover align-middle mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Marca</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Unidade</th>
                            <th>Localização</th>
                            <th width="180">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($estoques as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->produto->nome ?? '-' }}</td>
                                <td>{{ $item->produto->marca ?? '-' }}</td>
                                <td>R$ {{ number_format($item->produto->preco ?? 0, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge @if($item->quantidade > 0) bg-success @else bg-danger @endif">
                                        {{ $item->quantidade }}
                                    </span>
                                </td>
                                <td>{{ $item->unidade_medida ?? '-' }}</td>
                                <td>{{ $item->localizacao ?? '-' }}</td>
                                
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('estoque.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="{{ route('estoque.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
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

@endsection
