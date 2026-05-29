@extends('main')
@section('titulo', 'Listagem de Produtos')
@section('conteudo')

<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Produtos</h3>
            <a href="{{ route('produtos.create') }}" class="btn btn-primary">Novo Produto</a>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">

                <form action="{{ route('produtos.search') }}" method="POST">
                    @csrf
                    <!-- Barra de Pesquisa -->
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Pesquisa</label>
                            <select name="tipo" class="form-select">
                                <option value="nome">Nome</option>
                                <option value="marca">Marca</option>
                                <option value="preco">Preço</option>
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
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Limpar</a>
                        </div>
                    </div>
                </form>

                <!-- Tabela de Produtos -->
                <table class="table table-hover align-middle mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Imagem</th>
                            <th>Nome</th>
                            <th>Marca</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th width="180">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($produtos as $produto)
                            @php
                                $nome_imagem = !empty($produto->imagem)
                                    ? asset('storage/' . $produto->imagem)
                                    : asset('images/sem_imagem.jpg');
                            @endphp
                            <tr>
                                <td>{{ $produto->id }}</td>
                                <td>
                                    <img 
                                        src="{{ $nome_imagem }}"
                                        class="rounded"
                                        width="70"
                                        height="70"
                                        alt="Imagem"
                                    >
                                </td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->marca }}</td>
                                <td>
                                    @if($produto->descricao)
                                        <span title="{{ $produto->descricao }}">
                                            {{ Str::limit($produto->descricao, 50) }}
                                        </span>
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </td>
                                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>

                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
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
