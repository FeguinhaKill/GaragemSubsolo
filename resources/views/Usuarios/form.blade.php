@extends('main')
@section('titulo', 'Cadastro de Usuário')
@section('conteudo')

@php
    $action = !empty($usuario->id)
        ? route('usuarios.update', $usuario->id)
        : route('usuarios.store');
@endphp

<div class="container mt-5">
    <div class="card shadow p-4">
        
        <h3 class="mb-4">Cadastro de Usuário</h3>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(!empty($usuario->id))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem</label>
                    @php
                        $nome_imagem = !empty($usuario->imagem)
                            ? asset('storage/' . $usuario->imagem)
                            : asset('images/sem_imagem.jpg');
                    @endphp
                    <img src="{{ asset('storage/' . $nome_imagem) }}" class="rounded-circle" width="150px" height="150px" alt="imagem">
                    <input type="file" name="imagem" class="form-control" value="{{ old('imagem', $usuario->imagem ?? '')}}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nome*</label>
                <input
                    type="text"
                    name="nome"
                    class="form-control"
                    value="{{ old('nome', $usuario->nome ?? '') }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">CPF/CNPJ*</label>
                <input
                    type="text"
                    name="cpf_cnpj"
                    class="form-control"
                    value="{{ old('cpf_cnpj', $usuario->cpf_cnpj ?? '') }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">E-mail*</label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $usuario->email ?? '') }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone*</label>
                <input
                    type="text"
                    name="telefone"
                    class="form-control"
                    value="{{ old('telefone', $usuario->telefone ?? '') }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Endereço*</label>
                <input
                    type="text"
                    name="endereco"
                    class="form-control"
                    value="{{ old('endereco', $usuario->endereco ?? '') }}"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Categoria do Usuário*</label>
                <select name="categoria_usuario" class="form-select">
                    <option value="">Selecione</option>
                    <option value="cliente">Cliente</option>
                    <option value="empresa">Empresa</option>
                </select>

            </div>
            <div class="mb-4">
                <label class="form-label">Plano Fidelidade</label>
                <input
                    type="text"
                    name="plano_fid"
                    class="form-control"
                    value="{{ old('plano_fid', $usuario->plano_fid ?? '') }}"
                >
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>

            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Voltar</a>

        </form>

    </div>
</div>

@endsection