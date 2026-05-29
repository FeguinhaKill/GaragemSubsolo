@extends('main')
@section('titulo', isset($pagamento) ? 'Editar Pagamento' : 'Cadastro de Pagamento')
@section('conteudo')

@php

    $action = !empty($pagamento->id)
        ? route('pagamento.update', $pagamento->id)
        : route('pagamento.store');

@endphp

<div class="container mt-5">

    <div class="card shadow p-4">

        <h3 class="mb-4">
            {{ !empty($pagamento->id) ? 'Editar Pagamento' : 'Cadastro de Pagamento' }}
        </h3>

        @if ($errors->any())

            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>
                    Erro ao validar!
                </strong>

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                ></button>

            </div>

        @endif

        <form action="{{ $action }}" method="POST">

            @csrf

            @if(!empty($pagamento->id))
                @method('PUT')
            @endif

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Usuário
                    </label>

                    <select
                        name="usuario_id"
                        class="form-select @error('usuario_id') is-invalid @enderror"
                    >

                        <option value="">
                            Selecione
                        </option>

                        @foreach ($usuarios as $usuario)

                            <option
                                value="{{ $usuario->id }}"
                                {{ old('usuario_id', $pagamento->usuario_id ?? '') == $usuario->id ? 'selected' : '' }}
                            >
                                {{ $usuario->nome ?? $usuario->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('usuario_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Ordem de Serviço
                    </label>

                    <select
                        name="ordem_servico_id"
                        class="form-select @error('ordem_servico_id') is-invalid @enderror"
                    >

                        <option value="">
                            Selecione
                        </option>

                        @foreach ($ordensServico as $os)

                            <option
                                value="{{ $os->id }}"
                                {{ old('ordem_servico_id', $pagamento->ordem_servico_id ?? '') == $os->id ? 'selected' : '' }}
                            >
                                OS #{{ $os->id }}
                            </option>

                        @endforeach

                    </select>

                    @error('ordem_servico_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Valor Bruto
                    </label>

                    <input
                        type="number"
                        name="valor_bruto"
                        step="0.01"
                        class="form-control @error('valor_bruto') is-invalid @enderror"
                        value="{{ old('valor_bruto', $pagamento->valor_bruto ?? '') }}"
                    >

                    @error('valor_bruto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Desconto
                    </label>

                    <input
                        type="number"
                        name="desconto"
                        step="0.01"
                        class="form-control @error('desconto') is-invalid @enderror"
                        value="{{ old('desconto', $pagamento->desconto ?? 0) }}"
                    >

                    @error('desconto')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Forma de Pagamento
                    </label>

                    <select
                        name="forma_pagamento_id"
                        class="form-select @error('forma_pagamento_id') is-invalid @enderror"
                    >

                        <option value="">
                            Selecione
                        </option>

                        @foreach ($formasPagamento as $forma)

                            <option
                                value="{{ $forma->id }}"
                                {{ old('forma_pagamento_id', $pagamento->forma_pagamento_id ?? '') == $forma->id ? 'selected' : '' }}
                            >
                                {{ $forma->nome }}
                            </option>

                        @endforeach

                    </select>

                    @error('forma_pagamento_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select
                        name="status"
                        class="form-select @error('status') is-invalid @enderror"
                    >

                        <option
                            value="pendente"
                            {{ old('status', $pagamento->status ?? '') == 'pendente' ? 'selected' : '' }}
                        >
                            Pendente
                        </option>

                        <option
                            value="em andamento"
                            {{ old('status', $pagamento->status ?? '') == 'em andamento' ? 'selected' : '' }}
                        >
                            Em Andamento
                        </option>

                        <option
                            value="pago"
                            {{ old('status', $pagamento->status ?? '') == 'pago' ? 'selected' : '' }}
                        >
                            Pago
                        </option>

                        <option
                            value="cancelado"
                            {{ old('status', $pagamento->status ?? '') == 'cancelado' ? 'selected' : '' }}
                        >
                            Cancelado
                        </option>

                        <option
                            value="atrasado"
                            {{ old('status', $pagamento->status ?? '') == 'atrasado' ? 'selected' : '' }}
                        >
                            Atrasado
                        </option>

                    </select>

                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Data de Vencimento
                    </label>

                    <input
                        type="date"
                        name="data_vencimento"
                        class="form-control @error('data_vencimento') is-invalid @enderror"
                        value="{{ old('data_vencimento', $pagamento->data_vencimento ?? '') }}"
                    >

                    @error('data_vencimento')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                @if(!empty($pagamento->id))

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Data de Pagamento
                        </label>

                        <input
                            type="datetime-local"
                            name="data_pago"
                            class="form-control @error('data_pago') is-invalid @enderror"
                            value="{{ old('data_pago', $pagamento->data_pago ?? '') }}"
                        >

                        @error('data_pago')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                @endif

            </div>

            <div class="mt-3">

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    {{ !empty($pagamento->id) ? 'Atualizar' : 'Salvar' }}
                </button>

                <a
                    href="{{ route('pagamento.index') }}"
                    class="btn btn-secondary"
                >
                    Voltar
                </a>

            </div>

        </form>

    </div>

</div>

@endsection