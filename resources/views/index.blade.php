@extends('main')
@section('titulo', 'Início')
@section('conteudo')

<section class="">
    <img src="/storage/images/mainImagems/uniao.jpg" class="hero-img">
    <hr class="custom-line">
    <h2 class="text-center movatxt mt-4">Mova-se Conosco</h2>
</section>

<section style="margin: 2rem 60px;">

    <div style="display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 12px;">
        @foreach($produtos as $produto)
            <div class="bike-card">
                <div class="bike-img-wrap">
                    <img src="/storage/{{ $produto->imagem }}"
                         alt="{{ $produto->nome }}">
                </div>
                <div class="bike-body">
                    <span class="bike-badge">Disponível</span>
                    <p class="bike-name">{{ $produto->nome }}</p>
                    <p class="bike-marca">{{ $produto->marca }}</p>
                    <p class="bike-descricao">{{ Str::limit($produto->descricao, 214) }}</p>
                    <p class="bike-preco">
                        R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        <span class="bike-preco-label">/dia</span>
                    </p>
                </div>
            </div>
        @endforeach
    </div>

 <hr class="container custom-line2">

<section style="margin: 2rem 60px;">
    <div class="row align-items-center g-4">

        <div class="col-5 d-flex align-items-center">
            <h3 style="font-size: 28px; font-weight: 500; line-height: 1.3; margin: 0;">
                Por que alugar com a<br>
                <span style="color: #1D9E75;">Garage Subsolo?</span>
            </h3>
        </div>

        <div class="col-7 d-flex flex-column gap-3">

            <div class="motivo-card" style="background: #E1F5EE; border: 1px solid #9FE1CB;">
                <div class="motivo-icon" style="background: #9FE1CB;">🚲</div>
                <div>
                    <h5 style="color: #085041;">Bikes sempre revisadas</h5>
                    <p style="color: #0F6E56;">Todas as bicicletas passam por manutenção antes de cada aluguel. Você pedala com segurança e sem surpresas.</p>
                </div>
            </div>

            <div class="motivo-card" style="background: #EEEDFE; border: 1px solid #AFA9EC;">
                <div class="motivo-icon" style="background: #AFA9EC;">⚡</div>
                <div>
                    <h5 style="color: #26215C;">Retirada rápida</h5>
                    <p style="color: #3C3489;">Processo simples e sem burocracia. Em poucos minutos você já está pedalando pela cidade.</p>
                </div>
            </div>

            <div class="motivo-card" style="background: #FAEEDA; border: 1px solid #FAC775;">
                <div class="motivo-icon" style="background: #FAC775;">📍</div>
                <div>
                    <h5 style="color: #412402;">Localização central</h5>
                    <p style="color: #633806;">Estamos no coração de Chapecó, fácil de chegar e com estacionamento disponível.</p>
                </div>
            </div>

        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc4s9bIOgUxi8T/jl52Oi6of51oIs5rUU9sZc6UstBo"
    crossorigin="anonymous">
</script>

@endsection
