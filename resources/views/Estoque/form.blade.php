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

            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="{{ route('estoque.index') }}" class="btn btn-secondary">Voltar</a>

        </form>

    </div>
</div>

@endsection
