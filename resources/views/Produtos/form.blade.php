@extends('main')
@section('titulo', 'Cadastro de Produto')
@section('conteudo')

@php
    $action = !empty($produto->id)
        ? route('produtos.update', $produto->id)
        : route('produtos.store');

    $nome_imagem = !empty($produto->imagem)
        ? asset('storage/' . $produto->imagem)
        : asset('images/sem_imagem.jpg');
@endphp

<div class="container mt-5" style="max-width: 720px;">
    <div class="card shadow p-4">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="#" onclick="history.back(); return false;" style="color: #6b7280; text-decoration: none; font-size: 20px;">←</a>
            <h3 style="margin: 0;">{{ !empty($produto->id) ? 'Editar Produto' : 'Novo Produto' }}</h3>
        </div>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if(!empty($produto->id))
                @method('PUT')
            @endif

            {{-- imagem --}}
            <div class="mb-4" style="display: flex; align-items: center; gap: 1.5rem;">
                <img src="{{ $nome_imagem }}"
                     id="imagemPreview"
                     class="rounded"
                     width="90" height="90"
                     style="object-fit: cover; border: 1px solid #e5e7eb;"
                     alt="Imagem">
                <div>
                    <p style="font-size: 13px; font-weight: 500; margin: 0 0 4px;">Imagem do produto</p>
                    <p style="font-size: 12px; color: #6b7280; margin: 0 0 8px;">JPG, PNG ou WEBP</p>
                    <input type="file" name="imagem" class="form-control form-control-sm" accept="image/*" id="imagemInput" style="max-width: 260px;">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label">Nome*</label>
                    <input type="text" name="nome"
                           class="form-control @error('nome') is-invalid @enderror"
                           value="{{ old('nome', $produto->nome ?? '') }}" required>
                    @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Marca*</label>
                    <input type="text" name="marca"
                           class="form-control @error('marca') is-invalid @enderror"
                           value="{{ old('marca', $produto->marca ?? '') }}" required>
                    @error('marca')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Preço*</label>
                    <div class="input-group">
                        <span class="input-group-text">R$</span>
                        <input type="number" name="preco"
                               class="form-control @error('preco') is-invalid @enderror"
                               value="{{ old('preco', $produto->preco ?? '') }}"
                               step="0.01" min="0" required>
                    </div>
                    @error('preco')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Tipo*</label>
                    <select name="tipo" class="form-select @error('tipo') is-invalid @enderror" required>
                        <option value="">Selecione o tipo</option>
                        @foreach(['Peça', 'Acessório', 'Equipamento de Proteção', 'Bicicleta', 'Ferramenta'] as $tipo)
                            <option value="{{ $tipo }}" {{ old('tipo', $produto->tipo ?? '') == $tipo ? 'selected' : '' }}>
                                {{ $tipo }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Descrição</label>
                <textarea name="descricao" rows="4"
                          class="form-control @error('descricao') is-invalid @enderror"
                          maxlength="1000">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
                @error('descricao')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">Voltar</a>
            </div>

        </form>
    </div>
</div>

<script>
    document.getElementById('imagemInput')?.addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('imagemPreview').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

@endsection
