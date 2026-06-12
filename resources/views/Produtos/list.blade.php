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
                    <div class="row align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Tipo de Pesquisa</label>
                            <select name="tipo" class="form-select">
                                <option value="nome">Nome</option>
                                <option value="marca">Marca</option>
                                <option value="preco">Preço</option>
                                <option value="tipo">Tipo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pesquisar</label>
                            <input type="text" name="valor" class="form-control" placeholder="Digite...">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                        <div class="col-md-2 d-grid mt-2">
                            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Limpar</a>
                        </div>
                    </div>
                </form>

                <table class="table table-hover align-middle mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Tipo</th>
                            <th>Preço</th>
                            <th width="120">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($produtos as $produto)
                            @php
                                $nome_imagem = asset('storage/images/sem_imagem.jpg');

                                if (!empty($produto->imagem)) {
                                    $caminhos = [];
                                    $valorImagem = $produto->imagem;

                                    if (filter_var($valorImagem, FILTER_VALIDATE_URL)) {
                                        $caminhos[] = $valorImagem;
                                    }

                                    $caminhos[] = $valorImagem;
                                    $caminhos[] = ltrim($valorImagem, '/');
                                    $caminhos[] = 'storage/' . ltrim($valorImagem, '/');
                                    $caminhos[] = 'public/' . ltrim($valorImagem, '/');
                                    $caminhos[] = str_replace('storage/', '', $valorImagem);
                                    $caminhos[] = 'produtos/' . basename($valorImagem);
                                    $caminhos[] = basename($valorImagem);

                                    foreach ($caminhos as $caminho) {
                                        if (empty($caminho)) continue;

                                        if (filter_var($caminho, FILTER_VALIDATE_URL)) {
                                            $nome_imagem = $caminho;
                                            break;
                                        }

                                        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($caminho)) {
                                            $nome_imagem = \Illuminate\Support\Facades\Storage::url($caminho);
                                            break;
                                        }

                                        if (file_exists(public_path($caminho))) {
                                            $nome_imagem = asset($caminho);
                                            break;
                                        }

                                        if (file_exists(public_path('storage/' . ltrim($caminho, '/')))) {
                                            $nome_imagem = asset('storage/' . ltrim($caminho, '/'));
                                            break;
                                        }
                                    }
                                }

                                $tipoCores = [
                                    'Bicicleta'  => 'bg-success',
                                    'Capacete'   => 'bg-primary',
                                    'Acessório'  => 'bg-warning text-dark',
                                    'Peça'       => 'bg-info text-dark',
                                ];
                                $corTipo = $tipoCores[$produto->tipo] ?? 'bg-secondary';
                            @endphp
                            <tr>
                                <td style="color: #9ca3af; font-size: 13px;">{{ $produto->id }}</td>

                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ $nome_imagem }}"
                                             class="rounded"
                                             width="48" height="48"
                                             style="object-fit: cover;"
                                             alt="Imagem">
                                        <div>
                                            <p style="margin: 0; font-size: 14px; font-weight: 500;">{{ $produto->nome }}</p>
                                            <p style="margin: 0; font-size: 12px; color: #6b7280;">{{ $produto->marca }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td style="font-size: 13px; color: #374151; max-width: 200px;">
                                    @if($produto->descricao)
                                        <span title="{{ $produto->descricao }}">
                                            {{ Str::limit($produto->descricao, 50) }}
                                        </span>
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge {{ $corTipo }}">{{ $produto->tipo }}</span>
                                </td>

                                <td style="font-size: 14px; font-weight: 500; color: #0F6E56;">
                                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
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
