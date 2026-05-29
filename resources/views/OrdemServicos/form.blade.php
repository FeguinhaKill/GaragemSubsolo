@extends('main')
@section('titulo', 'Formulário Ordem de Serviço')
@section('conteudo')

    <h4>Formulário Ordem de Serviço</h4>

    @php
        if (!empty($dado->id)) {
            $action = route('ordem_servico.update', $dado->id);
        } else {
            $action = route('ordem_servico.store');
        }

        $agora = now();
        $dataAbertura = old('data_abertura', ($dado->data_abertura ? $dado->data_abertura->format('Y-m-d') : $agora->format('Y-m-d')));

        if (!empty($dado->data_fechamento) && $dado->data_fechamento > $agora) {
            $abertooufechado = 'Aberta';
        } else {
            $abertooufechado = 'Fechada';
        }
    @endphp

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if (!empty($dado->id))
            @method('PUT')
        @endif
        <div class="row">
            <div class="col">
                <label class="form-label" for="categoria_id">Usuário</label>
                <select name="usuario_id" class="form-select">
                    @foreach ($usuarios as $item)
                        <option value="{{ $item->id }}"
                            {{ old('usuario_id', $dado->usuario_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="funcionario_id">Funcionário</label>
                <select name="funcionario_id" class="form-select">
                    @foreach ($funcionarios as $item)
                        <option value="{{ $item->id }}"
                            {{ old('funcionario_id', $dado->funcionario_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->usuario->nome ?? '' }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

            <div class="col">
                <label for="data_abertura" class="form-label">Data de Abertura</label>
                <input type="date" class="form-control" name="data_abertura" value="{{ $dataAbertura }}">
            </div>
            <div class="col">
                <label for="data_fechamento" class="form-label">Data de Fechamento</label>
                <input type="date" class="form-control" name="data_fechamento" value="{{ old('data_fechamento', $dado->data_fechamento ? $dado->data_fechamento->format('Y-m-d') : '') }}">
            </div>
            <div class="col">
                <label class="form-label" for="status">Status</label>
                <select name="status" class="form-select" value="{{ $abertooufechado }}">
                    <option value="aberta" {{ old('status', $dado->status ?? '') == 'aberta' ? 'selected' : '' }}>Aberta</option>
                    <option value="fechada" {{ old('status', $dado->status ?? '') == 'fechada' ? 'selected' : '' }}>Fechada</option>
                    <option value="atrasado" {{ old('status', $dado->status ?? '') == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
                </select>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="{{ url('ordem_servico') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>

@stop
