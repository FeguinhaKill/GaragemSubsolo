@extends('main')

@section('titulo', 'Listagem de Usuários')

@section('conteudo')

<div class="container mt-5">

    <div class="card shadow p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3>
                Usuários
            </h3>

            <a 
                href="{{ route('usuarios.create') }}"
                class="btn btn-primary"
            >
                Novo Usuário
            </a>

        </div>

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
                    <th>Plano Fidelidade</th>
                    <th width="180">
                        Ações
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($usuarios as $usuario)

                    @php
                        $imagem = !empty($usuario->imagem)
                            ? asset('storage/' . $usuario->imagem)
                            : asset('images/sem_imagem.jpg');
                    @endphp

                    <tr>

                        <td>
                            {{ $usuario->id }}
                        </td>

                        <td>

                            <img 
                                src="{{ $imagem }}"
                                class="rounded-circle"
                                width="70"
                                height="70"
                                alt="Imagem"
                            >

                        </td>

                        <td>
                            {{ $usuario->nome }}
                        </td>

                        <td>
                            {{ $usuario->cpf_cnpj }}
                        </td>

                        <td>
                            {{ $usuario->email }}
                        </td>

                        <td>
                            {{ $usuario->telefone }}
                        </td>

                        <td>
                            {{ $usuario->endereco }}
                        </td>

                        <td>
                            {{ $usuario->categoria_usuario }}
                        </td>

                        <td>
                            {{ $usuario->plano_fid }}
                        </td>

                        <td>

                            <div class="d-flex gap-2">

                                <a 
                                    href="{{ route('usuarios.edit', $usuario->id) }}"
                                    class="btn btn-warning btn-sm"
                                >
                                    Editar
                                </a>

                                <form 
                                    action="{{ route('usuarios.destroy', $usuario->id) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button 
                                        type="submit"
                                        class="btn btn-danger btn-sm"
                                    >
                                        Excluir
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="10" class="text-center">

                            Nenhum usuário cadastrado.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection