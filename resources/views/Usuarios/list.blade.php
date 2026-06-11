@extends('main')
@section('titulo', 'Listagem de Usuários')
@section('conteudo')

<div class="container mt-5">
    <div class="card shadow p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Usuários</h3>
            <a href="{{ route('usuarios.create') }}" class="btn btn-primary">Novo Usuário</a>
        </div>

        <div class="card shadow-sm mb-4">

    <div class="card-body">

        <form action="{{ route('usuarios.search') }}" method="POST">

            @csrf

            <div class="row align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Tipo de Pesquisa</label>
                    <select name="tipo" class="form-select">
                        <option value="nome">Nome</option>
                        <option value="cpf_cnpj">CPF/CNPJ</option>
                        <option value="email">Email</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Pesquisar</label>
                    <input
                        type="text"
                        name="valor"
                        class="form-control"
                        placeholder="Digite..."
                    >
                </div>
                <div class="col-md-2 d-grid">
                    <button type="submit"class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-2 d-grid">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Limpar</a>
                </div>
            </div>
        </form>


        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Imagem</th>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Endereço</th>
                    <th>Categoria</th>
                    <th>Senha</th>
                    <th width="180">Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($usuarios as $usuario)
                    @php
                        $caminho_imagem = !empty($usuario->imagem)
                            ? 'storage/' . $usuario->imagem
                            : 'storage/imagem_usuario/sem_imagem.jpg';
                    @endphp
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>
                            <img
                                src="{{ asset($caminho_imagem) }}"
                                class="rounded-circle"
                                width="70"
                                height="70"
                                alt="Imagem"
                            >
                        </td>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->cpf_cnpj }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->telefone }}</td>
                        <td>{{ $usuario->endereco }}</td>
                        <td>{{ $usuario->categoria_usuario }}</td>
                        <td>{{ $usuario->senha }}</td>

                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}"class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
