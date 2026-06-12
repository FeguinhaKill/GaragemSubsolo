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
                            <input type="text" name="valor" class="form-control" placeholder="Digite...">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                        <div class="col-md-2 d-grid mt-2">
                            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Limpar</a>
                        </div>
                    </div>
                </form>

                <table class="table table-hover align-middle mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th>Contato</th>
                            <th>Endereço</th>
                            <th>Categoria</th>
                            <th width="120">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            @php
                                $caminho_imagem = !empty($usuario->imagem)
                                    ? 'storage/' . $usuario->imagem
                                    : 'storage/imagem_usuario/sem_imagem.jpg';

                                $categoriaCores = [
                                    'cliente'     => 'bg-primary',
                                    'funcionario' => 'bg-success',
                                    'empresa'     => 'bg-warning text-dark',
                                ];
                                $cor = $categoriaCores[$usuario->categoria_usuario] ?? 'bg-secondary';
                            @endphp
                            <tr>
                                <td style="color: #9ca3af; font-size: 13px;">{{ $usuario->id }}</td>

                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <img src="{{ asset($caminho_imagem) }}"
                                             class="rounded-circle"
                                             width="40" height="40"
                                             style="object-fit: cover;"
                                             alt="Imagem">
                                        <div>
                                            <p style="margin: 0; font-size: 14px; font-weight: 500;">{{ $usuario->nome }}</p>
                                            <p style="margin: 0; font-size: 12px; color: #6b7280;">{{ $usuario->cpf_cnpj }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <p style="margin: 0; font-size: 13px;">{{ $usuario->email }}</p>
                                    <p style="margin: 0; font-size: 12px; color: #6b7280;">{{ $usuario->telefone }}</p>
                                </td>

                                <td style="font-size: 13px; color: #374151; max-width: 180px;">
                                    {{ Str::limit($usuario->endereco, 35) }}
                                </td>

                                <td>
                                    <span class="badge {{ $cor }}">
                                        {{ ucfirst($usuario->categoria_usuario) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">
                                            Editar
                                        </a>
                                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                              onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
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
    </div>
</div>

@endsection
