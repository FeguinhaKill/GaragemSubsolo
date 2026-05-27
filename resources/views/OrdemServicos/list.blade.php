@extends('main')
@section('titulo', 'Listagem de ordens de serviço')
@section('conteudo')

    <h4>Listagem de Ordens de Serviço</h4>

    <div class="row">
        <div class="col">
            <form action="{{ route('ordem_servico.search') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="usuario">Usuario</option>
                            <option value="funcionario">Funcionario</option>
                            <option value="data_abertura">Data de Abertura</option>
                            <option value="data_fechamento">Data de Fechamento</option>
                            <option value="status">Status</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary"> Buscar</button>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ url('ordem_servico/create') }}" class="btn btn-success"> Novo</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Usuário</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">data_abertura</th>
                        <th scope="col">data_fechamento</th>
                        <th scope="col">status</th>
                        <th scope="col">valor_total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dados as $item)
                        <tr>
                            <th scope="row">{{ $item->id }}</th>
                            <td>{{ $item->usuario->nome ?? '' }}</td>
                            <td>{{ $item->funcionario->usuario->nome ?? '' }}</td>
                            <td>{{ $item->data_abertura ? $item->data_abertura->format('d/m/Y') : '' }}</td>
                            <td>{{ $item->data_fechamento ? $item->data_fechamento->format('d/m/Y') : '' }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->valor_total }}</td>
                            <td><a href="{{ route('ordem_servico.edit', $item->id) }}" class="btn btn-warning">Editar</a></td>
                            <td>
                                <form action="{{ route('ordem_servico.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Deseja remover o registro?')">
                                        Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@stop
