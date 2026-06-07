@extends('main')
@section('titulo', 'Cadastro de Produto')
@section('conteudo')

@php
    $action = !empty($produto->id)
        ? route('produtos.update', $produto->id)
        : route('produtos.store');
@endphp

<div class="container mt-5">
    <div class="card shadow p-4">

        <h3 class="mb-4">Cadastro de Produto</h3>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(!empty($produto->id))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                @php
                    $nome_imagem = !empty($produto->imagem)
                        ? asset('storage/' . $produto->imagem)
                        : asset('images/sem_imagem.jpg');
                @endphp
                <div>
                    <img src="{{ $nome_imagem }}" class="rounded" width="150px" height="150px" alt="imagem" id="imagemPreview">
                </div>
                <input type="file" name="imagem" class="form-control mt-2" accept="image/*" id="imagemInput">
            </div>

            <div class="mb-3">
                <label class="form-label">Nome*</label>
                <input
                    type="text"
                    name="nome"
                    class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome', $produto->nome ?? '') }}"
                    required
                >
                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Marca*</label>
                <input
                    type="text"
                    name="marca"
                    class="form-control @error('marca') is-invalid @enderror"
                    value="{{ old('marca', $produto->marca ?? '') }}"
                    required
                >
                @error('marca')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Preço*</label>
                <input
                    type="number"
                    name="preco"
                    class="form-control @error('preco') is-invalid @enderror"
                    value="{{ old('preco', $produto->preco ?? '') }}"
                    step="0.01"
                    min="0"
                    required
                >
                @error('preco')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Descrição</label>
                <textarea
                    name="descricao"
                    class="form-control @error('descricao') is-invalid @enderror"
                    rows="4"
                    maxlength="1000"
                >{{ old('descricao', $produto->descricao ?? '') }}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Tipo*</label>
                <select
                    name="tipo"
                    class="form-control @error('tipo') is-invalid @enderror"
                    required
                >
                    <option value="">Selecione o tipo</option>
                    <option value="Peça" {{ old('tipo', $produto->tipo ?? '') == 'Peça' ? 'selected' : '' }}>
                        Peça
                    </option>
                    <option value="Acessório" {{ old('tipo', $produto->tipo ?? '') == 'Acessório' ? 'selected' : '' }}>
                        Acessório
                    </option>
                    <option value="Equipamento de Proteção" {{ old('tipo', $produto->tipo ?? '') == 'Equipamento de Proteção' ? 'selected' : '' }}>
                        Equipamento de Proteção
                    </option>
                    <option value="Bicicleta" {{ old('tipo', $produto->tipo ?? '') == 'Bicicleta' ? 'selected' : '' }}>
                        Bicicleta
                    </option>
                    <option value="Ferramenta" {{ old('tipo', $produto->tipo ?? '') == 'Ferramenta' ? 'selected' : '' }}>
                        Ferramenta
                    </option>
                </select>
                @error('tipo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>

                >{{ old('descricao', $produto->descricao ?? '') }}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="{{ route('produtos.index') }}" class="btn btn-secondary">Voltar</a>

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
