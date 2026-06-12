@extends('main')
@section('titulo', 'Cadastro de Estoque')
@section('conteudo')

@php
    $action = !empty($estoque->id)
        ? route('estoque.update', $estoque->id)
        : route('estoque.store');
@endphp

<div class="container mt-5">
    <div class="card shadow p-4">
        
        <h3 class="mb-4">Cadastro de Estoque</h3>

        <form action="{{ $action }}" method="POST">
            @csrf
            @if(!empty($estoque->id))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Produto*</label>
                <select 
                    name="produto_id" 
                    class="form-select @error('produto_id') is-invalid @enderror"
                    required
                >
                    <option value="">Selecione um produto</option>
                    @foreach($produtos as $produto)
                        <option 
                            value="{{ $produto->id }}"
                            {{ old('produto_id', $estoque->produto_id ?? '') == $produto->id ? 'selected' : '' }}
                        >
                            {{ $produto->nome }} - {{ $produto->marca }}
                        </option>
                    @endforeach
                </select>
                @error('produto_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Quantidade*</label>
                <input
                    type="number"
                    name="quantidade"
                    class="form-control @error('quantidade') is-invalid @enderror"
                    value="{{ old('quantidade', $estoque->quantidade ?? '') }}"
                    min="0"
                    required
                >
                @error('quantidade')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Unidade de medida*</label>
                <select name="unidade_medida" class="form-select @error('unidade_medida') is-invalid @enderror" required>
                    <option value="">Selecione uma unidade</option>
                    @foreach($unidadesMedida as $unidade)
                        <option value="{{ $unidade }}" {{ old('unidade_medida', $estoque->unidade_medida ?? '') == $unidade ? 'selected' : '' }}>
                            {{ $unidade }}
                        </option>
                    @endforeach
                </select>
                @error('unidade_medida')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Localização*</label>
                <select name="localizacao" class="form-select @error('localizacao') is-invalid @enderror" required>
                    <option value="">Selecione uma localização</option>
                    @foreach($localizacoes as $local)
                        <option value="{{ $local }}" {{ old('localizacao', $estoque->localizacao ?? '') == $local ? 'selected' : '' }}>
                            {{ $local }}
                        </option>
                    @endforeach
                </select>
                @error('localizacao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">Voltar</a>

        </form>

    </div>
</div>

@endsection
