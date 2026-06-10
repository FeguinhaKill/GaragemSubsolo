@extends('main')
@section('titulo', 'Adicionar atualização de serviço')
@section('conteudo')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h2 class="h3 mb-2">Adicionar atualização para a ordem de serviço</h2>
                        <p class="text-muted mb-0">Informe a ordem e escreva a atualização que o cliente visualizará.</p>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('atualizacao_servico.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="ordem_servico_id" class="form-label fw-semibold">Ordem de serviço</label>
                            <select name="ordem_servico_id" id="ordem_servico_id" class="form-select" required>
                                <option value="">Selecione a ordem</option>
                                @foreach($ordensServico as $ordem)
                                    <option value="{{ $ordem->id }}" {{ old('ordem_servico_id', $ordemServicoId) == $ordem->id ? 'selected' : '' }}>
                                        #{{ $ordem->id }} — {{ Str::limit($ordem->descricao ?? 'Sem descrição', 60) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="comentario" class="form-label fw-semibold">Comentário da atualização</label>
                            <textarea
                                name="comentario"
                                id="comentario"
                                rows="6"
                                class="form-control"
                                placeholder="Ex.: O equipamento já foi revisado, aguardando testes finais."
                                required
                            >{{ old('comentario') }}</textarea>
                            <div class="form-text">Essa mensagem será visível para o cliente junto da ordem.</div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('inicio') }}" class="btn btn-outline-secondary">Voltar</a>
                            <button type="submit" class="btn btn-success">Salvar atualização</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
