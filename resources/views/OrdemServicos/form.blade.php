@extends('main')
@section('titulo', 'Formulário Ordem de Serviço')
@section('conteudo')

    @php

        $action = !empty($dado->id) ? route('ordem_servico.update', $dado->id) : route('ordem_servico.store');

        $agora = now();

        $dataAbertura = old(
            'data_abertura',
            !empty($dado->data_abertura) ? $dado->data_abertura->format('Y-m-d') : $agora->format('Y-m-d'),
        );

    @endphp

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h3 class="mb-4">
                Formulário Ordem de Serviço
            </h3>

            <form action="{{ $action }}" method="POST">
                @csrf

                @if (!empty($dado->id))
                    @method('PUT')
                @endif

                <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Usuário
                        </label>

                        <select name="usuario_id" class="form-select">

                            @foreach ($usuarios as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('usuario_id', $dado->usuario_id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nome }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Funcionário
                        </label>

                        <select name="funcionario_id" class="form-select">

                            @foreach ($funcionarios as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('funcionario_id', $dado->funcionario_id ?? '') == $item->id ? 'selected' : '' }}>
                                    {{ $item->usuario->nome ?? '' }}
                                </option>
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
                        <input type="date" class="form-control" name="data_fechamento"
                            value="{{ old('data_fechamento', $dado->data_fechamento ? $dado->data_fechamento->format('Y-m-d') : '') }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="status">Status</label>
                        <select name="status" class="form-select" value="{{ $dado->status ?? '' }}">
                            <option value="aberta" {{ old('status', $dado->status ?? '') == 'aberta' ? 'selected' : '' }}>
                                Aberta</option>
                            <option value="fechada"
                                {{ old('status', $dado->status ?? '') == 'fechada' ? 'selected' : '' }}>Fechada</option>
                            <option value="atrasado"
                                {{ old('status', $dado->status ?? '') == 'atrasado' ? 'selected' : '' }}>Atrasado</option>
                        </select>
                    </div>

                
        </div>
        <div class="md-4 mb-3">
            <label class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" style="height: 200px;">{{ old('descricao', $dado->descricao ?? '') }}</textarea>
        </div>

        <hr>

        <h5>Produtos (adicione um ou mais)</h5>

        <div class="table-responsive">
            <table class="table" id="produtos-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="produto_id[]" class="form-select">
                                <option value="">-- selecione --</option>
                                @foreach (\App\Models\Produto::all() as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->nome }} - R$
                                        {{ number_format($produto->preco, 2, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="quantidade[]" class="form-control" min="1" value="1">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-row">Remover</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <button type="button" id="add-produto" class="btn btn-outline-primary btn-sm">Adicionar produto</button>
        </div>

        <div class="mt-3">

            <button type="submit" class="btn btn-primary">
                Salvar
            </button>

            <a href="{{ route('ordem_servico.index') }}" class="btn btn-secondary">
                Voltar
            </a>
        </div>

        <script>
            document.addEventListener('click', function(e) {
                if (e.target && e.target.id === 'add-produto') {
                    const tbody = document.querySelector('#produtos-table tbody');
                    const row = document.createElement('tr');
                    row.innerHTML = `
                            <td>
                                <select name="produto_id[]" class="form-select">
                                    <option value="">-- selecione --</option>
                                    @foreach (\App\Models\Produto::all() as $produto)
                                        <option value="{{ $produto->id }}">{{ $produto->nome }} - R$ {{ number_format($produto->preco, 2, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantidade[]" class="form-control" min="1" value="1">
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger remove-row">Remover</button>
                            </td>
                        `;
                    tbody.appendChild(row);
                }

                if (e.target && e.target.classList && e.target.classList.contains('remove-row')) {
                    const tr = e.target.closest('tr');
                    if (tr) tr.remove();
                }
            });
        </script>
    </div>
    </div>


    </form>

    </div>

    </div>

@endsection
