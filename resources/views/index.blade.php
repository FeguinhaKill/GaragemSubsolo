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
</section>
    <hr class="container custom-line2">

<section class="display: grid;">
    <div class="row ">
        <div class="col-6 container row12">
            <h3>Porque comprar com a<br>Garage Subsolo?</h3>
        </div>
        <div class="col-3 container row22">
            card com cor pastel e motivo 1
        </div>
        <div class="col-3 container row22">
 card com outra cor pastel e motivo 2
        </div>
    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc4s9bIOgUxi8T/jl52Oi6of51oIs5rUU9sZc6UstBo"
    crossorigin="anonymous">
</script>

@endsection
