@extends('main')
@section('titulo', $produto->nome)
@section('conteudo')

<div style="background: #f3f4f6; min-height: 100vh; padding: 2rem 1.5rem;">


    <div style="font-size: 13px; color: #6b7280; margin-bottom: 1.5rem;">
        <a href="{{ route('produtos.indexclientes') }}" style="color: #6b7280; text-decoration: none;">Produtos</a>
        <span style="margin: 0 6px;">›</span>
        <span style="color: #111;">{{ $produto->nome }}</span>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; max-width: 1100px; margin: 0 auto;">


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

        <div style="background: white; border: 1px solid #e5e7eb; border-radius: 16px; overflow: hidden; display: flex; align-items: center; justify-content: center; min-height: 420px; padding: 2rem;">
            <img src="{{ $nome_imagem }}"
                 alt="{{ $produto->nome }}"
                 style="max-width: 100%; max-height: 380px; object-fit: contain;">
        </div>


        <div style="display: flex; flex-direction: column; gap: 1rem;">

            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 16px; padding: 1.75rem;">
                <span style="font-size: 11px; color: #9ca3af; text-transform: uppercase; letter-spacing: 0.05em;">{{ $produto->tipo }}</span>
                <h1 style="font-size: 24px; font-weight: 600; margin: 6px 0 4px;">{{ $produto->nome }}</h1>
                <p style="font-size: 14px; color: #6b7280; margin: 0 0 1rem;">{{ $produto->marca }}</p>

                <hr style="border-color: #e5e7eb; margin: 1rem 0;">

                <p style="font-size: 13px; color: #374151; line-height: 1.7; margin: 0;">
                    {{ $produto->descricao ?? 'Sem descrição disponível.' }}
                </p>
            </div>


            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 16px; padding: 1.75rem;">
                @php $disponivel = $produto->estoque && $produto->estoque->quantidade > 0; @endphp

                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                    <div>
                        <p style="font-size: 13px; color: #6b7280; margin: 0 0 4px;">Valor do aluguel</p>
                        <p style="font-size: 28px; font-weight: 700; color: #0F6E56; margin: 0;">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </p>
                    </div>
                    <span style="font-size: 12px; font-weight: 500; padding: 5px 12px; border-radius: 6px;
                        background: {{ $disponivel ? '#E1F5EE' : '#FEE2E2' }};
                        color: {{ $disponivel ? '#0F6E56' : '#991B1B' }};">
                        {{ $disponivel ? 'Disponível' : 'Indisponível' }}
                    </span>
                </div>

                @if($disponivel)
                    <form action="{{ route('produtos.comprar', $produto->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            style="display: block; width: 100%; background: #1D9E75; color: white; text-align: center; padding: 14px; border-radius: 10px; font-size: 15px; font-weight: 500; border: none; cursor: pointer; transition: background 0.15s;">
                            Comprar agora
                        </button>
                    </form>
                @else
                    <button disabled
                        style="display: block; width: 100%; background: #e5e7eb; color: #9ca3af; border: none; padding: 14px; border-radius: 10px; font-size: 15px; cursor: not-allowed;">
                        Indisponível no momento
                    </button>
                @endif
            </div>

            @if($produto->estoque)
            <div style="background: white; border: 1px solid #e5e7eb; border-radius: 16px; padding: 1.25rem 1.75rem; display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 20px;">📦</span>
                <div>
                    <p style="font-size: 12px; color: #6b7280; margin: 0;">Unidades disponíveis</p>
                    <p style="font-size: 14px; font-weight: 500; margin: 0;">{{ $produto->estoque->quantidade }} unidade(s)</p>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
