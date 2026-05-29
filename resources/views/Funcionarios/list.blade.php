@extends('main')
@section('titulo', 'Listagem de Funcionários')
@section('conteudo')

<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Funcionários</h3>
            <a href="{{ route('funcionarios.create') }}" class="btn btn-primary">Novo Funcionário</a>
        </div>

        <div class="card shadow-sm mb-4">

    <div class="card-body">

        <form action="{{ route('funcionarios.search') }}" method="POST">

            @csrf
            <!-- Barra de Pesquisa -->
            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Tipo de Pesquisa</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="nome_cargo">Cargo</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pesquisar</label>
                    <input type="text" name="valor" class="form-control" placeholder="Digite...">
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit"class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-2 d-grid">
                    <a href="{{ route('funcionarios.index') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </div>
        </form>

        <!-- Tabela de Funcionários -->
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>Cargo</th>
                    <th>Salário</th>
                    <th width="180">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($funcionarios as $funcionario)
                    @php
                        $usuario = $funcionario->usuario;
                        $nome_imagem = $usuario->imagem ? 'storage/' . $usuario->imagem : 'images/default.png';
                    @endphp

                    <tr>
                        <td>{{ $funcionario->id }}</td>
                        <td>
                            <img 
                                src="{{ asset($nome_imagem) }}"
                                class="rounded-circle"
                                width="70"
                                height="70"
                                alt="Imagem"
                            >
                        </td>
                        <td>{{  $funcionario->usuario->nome }}</td>
                        <td>{{ $funcionario->nome_cargo }}</td>
                        <td>{{ $funcionario->salario }}</td>
                        
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('funcionarios.edit', $funcionario->id) }}"class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>

@endsection