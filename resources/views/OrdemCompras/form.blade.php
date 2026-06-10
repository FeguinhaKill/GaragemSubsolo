@extends('main')
@section('titulo', 'Formulário Ordem de Compra')
@section('conteudo')

    @php

        $action = !empty($dado->id) ? route('ordem_compra.update', $dado->id) : route('ordem_compra.store');

        $agora = now();

        $dataCompra = old(
            'data_compra',
            !empty($dado->data_compra) ? $dado->data_compra->format('Y-m-d') : $agora->format('Y-m-d'),
        );


    @endphp

    <div class="container mt-5">

        <div class="card shadow p-4">

            <h3 class="mb-4">
                Formulário Ordem de Compra
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

                </div>

                <div class="row">
                    <input type="hidden" name="id" value="{{ $dado->id ?? '' }}">

                    <div class="col">
                        <label for="data_compra" class="form-label">Data de Compra</label>
                        <input type="date" class="form-control" name="data_compra" value="{{ $dataCompra }}">
                    </div>
                    <div class="col">
                        <label class="form-label" for="status">Status</label>
                        <select name="status" class="form-select" value="{{ $dado->status ?? '' }}">
                            <option value="aberta" {{ old('status', $dado->status ?? '') == 'aberta' ? 'selected' : '' }}>
                                Aberta</option>
                            <option value="fechada" {{ old('status', $dado->status ?? '') == 'fechada' ? 'selected' : '' }}>
                                Fechada</option>
                        </select>
                    </div>


        </div>

        <hr>

        <h5>Produtos (Adicione apenas UM)</h5>

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

            <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">
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
