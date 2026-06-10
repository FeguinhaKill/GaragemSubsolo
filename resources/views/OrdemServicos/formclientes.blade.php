@extends('main')
@section('titulo', 'Solicitar Serviço')
@section('conteudo')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="mb-4">
                        <h2 class="h3 mb-2">Solicitar serviço</h2>
                        <p class="text-muted mb-0">Descreva o que você deseja que seja feito. Seu pedido será aberto como uma ordem de serviço.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('ordem_servico.storeClienteRequest') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="descricao" class="form-label fw-semibold">Descrição do serviço</label>
                            <textarea
                                name="descricao"
                                id="descricao"
                                rows="6"
                                class="form-control"
                                placeholder="Ex.: Minha bicicleta está com freio travando e preciso revisão geral."
                                required
                            >{{ old('descricao') }}</textarea>
                            <div class="form-text">Descreva com detalhes o problema ou o serviço desejado.</div>
                        </div>

                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('inicio') }}" class="btn btn-outline-secondary">Voltar</a>
                            <button type="submit" class="btn btn-success">Enviar solicitação</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
