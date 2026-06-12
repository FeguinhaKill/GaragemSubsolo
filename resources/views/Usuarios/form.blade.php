@extends('main')
@section('titulo', 'Cadastro de Usuário')
@section('conteudo')

@php
    use Illuminate\Support\Facades\Session;
    $action = !empty($usuario->id)
        ? route('usuarios.update', $usuario->id)
        : route('usuarios.store');

    $caminho_imagem = !empty($usuario->imagem ?? null)
        ? asset('storage/' . $usuario->imagem)
        : asset('imagem_usuario/sem_imagem.jpg');

    $usuarioLogado = \App\Models\Usuario::find(Session::get('usuario_id'));
@endphp

<div class="container mt-5" style="max-width: 720px;">
    <div class="card shadow p-4">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="#" onclick="history.back(); return false;" style="color: #6b7280; text-decoration: none; font-size: 20px;">←</a>
            <h3 style="margin: 0;">{{ !empty($usuario->id) ? 'Editar Usuário' : 'Novo Usuário' }}</h3>
        </div>

        <form action="{{ $action }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @if(!empty($usuario->id))
                @method('PUT')
            @endif

            {{-- imagem --}}
            <div class="mb-4" style="display: flex; align-items: center; gap: 1.5rem;">
                <img src="{{ $caminho_imagem }}"
                     id="imagemPreview"
                     class="rounded-circle"
                     width="80" height="80"
                     style="object-fit: cover; border: 1px solid #e5e7eb;"
                     alt="Foto">
                <div>
                    <p style="font-size: 13px; font-weight: 500; margin: 0 0 4px;">Foto do usuário</p>
                    <p style="font-size: 12px; color: #6b7280; margin: 0 0 8px;">JPG, PNG ou WEBP</p>
                    <input type="file" name="imagem" id="imagemInput"
                           class="form-control form-control-sm"
                           accept="image/*" style="max-width: 260px;">
                </div>
            </div>

            {{-- nome + cpf --}}
            <div class="row g-3 mb-3">
                <div class="col-md-7">
                    <label class="form-label">Nome*</label>
                    <input type="text" name="nome" class="form-control"
                           value="{{ old('nome', $usuario->nome ?? '') }}" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">CPF/CNPJ*</label>
                    <input type="text" name="cpf_cnpj" class="form-control"
                           value="{{ old('cpf_cnpj', $usuario->cpf_cnpj ?? '') }}" required>
                </div>
            </div>

            {{-- email + telefone --}}
            <div class="row g-3 mb-3">
                <div class="col-md-7">
                    <label class="form-label">E-mail*</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $usuario->email ?? '') }}" required>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Telefone*</label>
                    <input type="text" name="telefone" class="form-control"
                           value="{{ old('telefone', $usuario->telefone ?? '') }}" required>
                </div>
            </div>

            {{-- endereço --}}
            <div class="mb-3">
                <label class="form-label">Endereço*</label>
                <input type="text" name="endereco" class="form-control"
                       value="{{ old('endereco', $usuario->endereco ?? '') }}" required>
            </div>

            {{-- categoria + senha --}}
            <div class="row g-3 mb-4">
                @if(!empty($usuarioLogado) && $usuarioLogado->categoria_usuario === 'funcionario')
                    <div class="col-md-6">
                        <label class="form-label">Categoria*</label>
                        <select name="categoria_usuario" class="form-select">
                            <option value="">Selecione</option>
                            @foreach(['cliente' => 'Cliente', 'empresa' => 'Empresa', 'funcionario' => 'Funcionário'] as $val => $label)
                                <option value="{{ $val }}" {{ old('categoria_usuario', $usuario->categoria_usuario ?? '') == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <input type="hidden" name="categoria_usuario" value="cliente">
                @endif

                <div class="col-md-6">
                    <label class="form-label">Senha (4-20 dígitos)*</label>
                    <input type="password" name="senha" class="form-control"
                           value="{{ old('senha', $usuario->senha ?? '') }}" required>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="#" onclick="history.back(); return false;" class="btn btn-secondary">Voltar</a>
            </div>

        </form>
    </div>
</div>

<script>
    document.getElementById('imagemInput')?.addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('imagemPreview').src = event.target.result;
        };
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

@endsection
