@extends('main')
@section('titulo', isset($pagamento) ? 'Editar Pagamento' : 'Criar Pagamento')
@section('conteudo')

<div class="row mb-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                <div>
                    <h2 class="card-title mb-1">{{ isset($pagamento) ? 'Editar Pagamento' : 'Novo Pagamento' }}</h2>
                    <p class="text-muted mb-0">{{ isset($pagamento) ? 'Atualize os dados do pagamento.' : 'Crie um novo registro de pagamento.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Erro ao validar!</strong>
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-12 col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ isset($pagamento) ? route('pagamento.update', $pagamento->id) : route('pagamento.store') }}" method="POST">
                    @csrf
                    @if(isset($pagamento))
                        @method('PUT')
                    @endif

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="usuario_id" class="form-label">Usuário</label>
                            <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                                <option value="">Selecione um usuário</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}" @selected(old('usuario_id', $pagamento->usuario_id ?? null) == $usuario->id)>
                                        {{ $usuario->nome ?? $usuario->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('usuario_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="ordem_servico_id" class="form-label">Ordem de Serviço</label>
                            <select name="ordem_servico_id" id="ordem_servico_id" class="form-select @error('ordem_servico_id') is-invalid @enderror" required>
                                <option value="">Selecione uma OS</option>
                                @foreach ($ordensServico as $os)
                                    <option value="{{ $os->id }}" @selected(old('ordem_servico_id', $pagamento->ordem_servico_id ?? null) == $os->id)>
                                        OS #{{ $os->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ordem_servico_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="valor_bruto" class="form-label">Valor Bruto</label>
                            <input type="number" name="valor_bruto" id="valor_bruto" class="form-control @error('valor_bruto') is-invalid @enderror" step="0.01" required value="{{ old('valor_bruto', $pagamento->valor_bruto ?? '') }}">
                            @error('valor_bruto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="desconto" class="form-label">Desconto</label>
                            <input type="number" name="desconto" id="desconto" class="form-control @error('desconto') is-invalid @enderror" step="0.01" value="{{ old('desconto', $pagamento->desconto ?? 0) }}">
                            @error('desconto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="forma_pagamento_id" class="form-label">Forma de Pagamento</label>
                            <select name="forma_pagamento_id" id="forma_pagamento_id" class="form-select @error('forma_pagamento_id') is-invalid @enderror">
                                <option value="">Selecione uma forma de pagamento</option>
                                @foreach ($formasPagamento as $forma)
                                    <option value="{{ $forma->id }}" @selected(old('forma_pagamento_id', $pagamento->forma_pagamento_id ?? null) == $forma->id)>
                                        {{ $forma->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('forma_pagamento_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="pendente" @selected(old('status', $pagamento->status ?? null) == 'pendente')>Pendente</option>
                                <option value="em_andamento" @selected(old('status', $pagamento->status ?? null) == 'em_andamento')>Em Andamento</option>
                                <option value="pago" @selected(old('status', $pagamento->status ?? null) == 'pago')>Pago</option>
                                <option value="cancelado" @selected(old('status', $pagamento->status ?? null) == 'cancelado')>Cancelado</option>
                                <option value="atrasado" @selected(old('status', $pagamento->status ?? null) == 'atrasado')>Atrasado</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="data_vencimento" class="form-label">Data de Vencimento</label>
                            <input type="date" name="data_vencimento" id="data_vencimento" class="form-control @error('data_vencimento') is-invalid @enderror" value="{{ old('data_vencimento', $pagamento->data_vencimento ?? '') }}">
                            @error('data_vencimento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        @if(isset($pagamento))
                        <div class="col-12 col-md-6">
                            <label for="data_pago" class="form-label">Data de Pagamento</label>
                            <input type="datetime-local" name="data_pago" id="data_pago" class="form-control @error('data_pago') is-invalid @enderror" value="{{ old('data_pago', $pagamento->data_pago ?? '') }}">
                            @error('data_pago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">{{ isset($pagamento) ? 'Atualizar' : 'Salvar' }}</button>
                        <a href="{{ route('pagamento.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
