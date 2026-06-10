@extends('main')
@section('titulo', 'Produtos')
@section('conteudo')

<div style="background: #f3f4f6; min-height: 100vh;">


    <div style="background: white; border-bottom: 1px solid #e5e7eb; padding: 0.75rem 1.5rem; display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
        @php
            $filtroAtual = request('valor', '');
        @endphp
        <form action="{{ route('produtos.searchclientes') }}" method="POST" style="display: flex; gap: 8px; align-items: center; flex-wrap: wrap;">
            @csrf
            <input type="hidden" name="tipo" value="tipo">

            <button type="submit" name="valor" value="" class="filter-chip {{ $filtroAtual === '' ? 'active' : '' }}">Todos</button>
            <button type="submit" name="valor" value="Bicicleta" class="filter-chip {{ $filtroAtual === 'Bicicleta' ? 'active' : '' }}">Bicicleta</button>
            <button type="submit" name="valor" value="Acessório" class="filter-chip {{ $filtroAtual === 'Acessório' ? 'active' : '' }}">Acessório</button>
            <button type="submit" name="valor" value="Ferramenta" class="filter-chip {{ $filtroAtual === 'Ferramenta' ? 'active' : '' }}">Ferramenta</button>
            <button type="submit" name="valor" value="Peça" class="filter-chip {{ $filtroAtual === 'Peça' ? 'active' : '' }}">Peça</button>
            <button type="submit" name="valor" value="Equipamento de Proteção" class="filter-chip {{ $filtroAtual === 'Equipamento de Proteção' ? 'active' : '' }}">Equipamento de Proteção</button>
        </form>

        <form autocomplete="off" action="{{ route('produtos.searchclientes') }}" method="POST" style="margin-left: auto; display: flex; gap: 8px; align-items: center;">
            @csrf
            <input type="hidden" name="tipo" value="nome">
            <input type="text" name="valor" placeholder="Buscar produtos..."
                   style="font-size: 13px; background: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; width: 220px; outline: none;">
            <button type="submit" class="mp-btn" style="padding: 6px 12px; border-radius: 8px;">Buscar</button>
        </form>
    </div>


    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; padding: 1.5rem;">
        @forelse($produtos as $produto)
            @php
                $disponivel = $produto->estoque && $produto->estoque->quantidade > 0;
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
                        if (empty($caminho)) {
                            continue;
                        }

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
            @endphp

            <div class="mp-card">
                <a href="{{ route('produtos.showcliente', $produto->id) }}" style="text-decoration: none; color: inherit;">
                <div class="mp-card-img">
                    <img src="{{ $nome_imagem }}"
                         alt="{{ $produto->nome }}"
                         style="width: 100%; height: 100%; object-fit: contain; padding:  0px;">
                    <span class="mp-badge {{ $disponivel ? 'badge-disp' : 'badge-ind' }}">
                        {{ $disponivel ? 'Disponível' : 'Indisponível' }}
                    </span>
                </div>
                <div class="mp-card-body">
                    <p class="mp-card-tipo">{{ $produto->tipo }}</p>
                    <p class="mp-card-nome">{{ $produto->nome }}</p>
                    <p class="mp-card-marca">{{ $produto->marca }}</p>
                    <p class="mp-card-desc">{{ Str::limit($produto->descricao, 70) }}</p>
                    <div class="mp-card-footer">
                        <p class="mp-preco">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        @if($disponivel)
                            <form action="{{ route('produtos.comprar', $produto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="mp-btn">Comprar</button>
                            </form>
                        @else
                            <button class="mp-btn" disabled style="background:#9ca3af; cursor: not-allowed;">Indisponível</button>
                        @endif
                    </div>
                </div>
                            </a>
            </div>
        @empty
            <div style="grid-column: span 4; text-align: center; padding: 3rem; color: #6b7280;">
                Nenhum produto encontrado.
            </div>
        @endforelse
    </div>
</div>



@endsection
