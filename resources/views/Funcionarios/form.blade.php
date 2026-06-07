@extends('main')
@section('titulo', 'Cadastro de Funcionário')
@section('conteudo')

@php
    $action = !empty($funcionario->id)
        ? route('funcionarios.update', $funcionario->id)
        : route('funcionarios.store');
@endphp

<div class="container mt-5">
    <div class="card shadow p-4">
        
        <h3 class="mb-4">Cadastro de Funcionário</h3>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(!empty($funcionario->id))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Cargo</label>
                <select name="nome_cargo" class="form-select">
                    <option value="">Selecione</option>
                    <option 
                        value="cliente"
                        {{ old('nome_cargo', $funcionario->nome_cargo ?? '') == 'cliente' ? 'selected' : '' }}
                    >Cliente</option>
                    <option 
                        value="empresa"
                        {{ old('nome_cargo', $funcionario->nome_cargo ?? '') == 'empresa' ? 'selected' : '' }}
                    >Empresa</option>
                    <option 
                        value="funcionario"
                        {{ old('nome_cargo', $funcionario->nome_cargo ?? '') == 'funcionario' ? 'selected' : '' }}
                    >Funcionário
                    </option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Salário</label>

                <input
                    type="number"
                    name="salario"
                    class="form-control"
                    step="0.01"
                    value="{{ old('salario', $funcionario->salario ?? '') }}"
                >


            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">Voltar</a>

        </form>

    </div>
</div>

@endsection