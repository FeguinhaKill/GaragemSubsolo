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
            @foreach ($produtos as $produto)
                <div class="bike-card">
                    <a href="{{ route('produtos.showcliente', $produto->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="bike-img-wrap">
                        <img src="/storage/{{ $produto->imagem }}" alt="{{ $produto->nome }}">
                    </div>
                    <div class="bike-body">
                        <span class="bike-badge fontef">Disponível</span>
                        <p class="bike-name fontef">{{ $produto->nome }}</p>
                        <p class="bike-marca fontef">{{ $produto->marca }}</p>
                        <p class="bike-descricao fontef">{{ Str::limit($produto->descricao, 214) }}</p>
                        <p class="bike-preco fontef">
                            R$ {{ number_format($produto->preco, 2, ',', '.') }}
                        </p>
                    </div>
                    </a>
                </div>
            @endforeach
        </div>

        <hr class="container custom-line2">

        <section style="margin: 2rem 60px; fontef">
            <div class="row align-items-center g-4">

                <div class="col-5 d-flex align-items-center">
                    <h3 class="fontef"
                        style="font-size: 28px; font-weight: 500; line-height: 1.3; margin: 0; padding-left: 350px;">
                        Por que alugar com a<br>
                        <span style="color: #1D9E75;">Garage Subsolo?</span>
                    </h3>
                </div>

                <div class="col-7 d-flex flex-column gap-3">

                    <div class="motivo-card" style="background: rgb(0, 75, 61); border: 1px solid rgb(0, 2, 1);">

                        <div>
                            <h5 class="fontef" style="font-weight: 400; color: #ffffff;">Bikes sempre revisadas</h5>
                            <p class="fontef" style="color: #c4c4c4;">Todas as bicicletas passam por manutenção antes de
                                cada aluguel. Você pedala com segurança e sem surpresas.</p>
                        </div>
                    </div>

                    <div class="motivo-card" style="background: rgb(255, 255, 128); border: 1px solid rgb(155, 155, 77);">

                        <div>
                            <h5 class="fontef" style="font-weight: 400; color: #000000;">Amor por Baratas</h5>
                            <p class="fontef" style="color: #000000;">Nosso distinto amor por baratas é o que nos destaca
                                perante a concorrencia que apenas as consideram insetos repugnantes e os odeiam por motivos
                                totalmente racistas e insetofobicos.</p>
                        </div>
                    </div>

                    <div class="motivo-card" style="background: rgb(172, 255, 180); border: 1px solid rgb(27, 37, 28);">
                        <div>
                            <h5 class="fontef" style="font-weight: 400; color: #000000;">Culto ao Baal</h5>
                            <p class="fontef" style="color: #000000;">Sendo um bom seguidor do senho Deus Lucifer Baal Sete
                                Peles o Uníco, não posso negar a importância desse culto em nossa operação. Com nossa
                                politica sendo redigida pelos antigos escritos daqueles que um dia mataram o segundo papa.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <section class="" style="background-color: #000000; padding: 30rem 60px; width: 100vw; margin-left: calc(-50vw + 50%); color:rgb(255, 70, 17)">
            <div class="row align-items-center g-4">
                <div class="col-5 d-flex align-items-center">
                    <h3 class="fontef"
                        style="font-size: 28px; font-weight: 500; line-height: 1.3; margin: 0; padding-left: 350px;">
                        Perguntas<br>Frequentes </h3>
                </div>
                <div class="col-7 d-flex flex-column gap-3">
                    <div class="accordion accordion-flush" id="perguntasacc">
                        <div class="accordion-item ">
                            <h2 class="accordion-header" id="headum">
                                <button class=" fontef accordion-button " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" style="font-weight: 500">
                                    Como é feito a revisão das bicicletas?
                                </button>
                            </h2>
                            <div id="collapseOne" class=" accordion-collapse collapse" aria-labelledby="headum"
                                data-bs-parent="#perguntasacc">
                                <div class="fontef accordion-body">
                                    As reuniões de revisão sao realizadas por aqueles que se dizem do alto clero do culto ao Baal, tal reuniao torna-se em muitas formas, incluindo a realização de rituais considerados, por muitos, não ortodoxos, tais quis são dicutidos no dia e não haverão qualquer registro sobre.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headdois">
                                <button class="fontef accordion-button collapsed " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-weight: 500">
                                    Porque esse site mistura bicicleta com baratas e cultos sAtãNicOs?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse " aria-labelledby="headdois"
                                data-bs-parent="#perguntasacc">
                                <div class="fontef accordion-body ">
                                    O motivo é simples, a bicicleta é o meio de transporte mais eficiente e sustentável, a barata é o inseto mais resistente e adaptável, e o culto a Baal é a religião mais antiga e poderosa. Juntos, eles formam uma combinação imbatível que representa a essência do nosso negócio: oferecer bicicletas de qualidade, com um toque de resistência e um pouco de misticismo para nossos clientes.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header " id="headtres">
                                <button class="fontef accordion-button collapsed " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="font-weight: 500">
                                    Qual é o local do dedicado ao culto a Baal?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse " aria-labelledby="headtres"
                                data-bs-parent="#perguntasacc">
                                <div class="fontef accordion-body">
                                    <p>O local é alterado frequentemente, portanto não é possível determinar com precisão. Porém, a barata será sempre A guia, e a bicicleta será sempre O caminho.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc4s9bIOgUxi8T/jl52Oi6of51oIs5rUU9sZc6UstBo" crossorigin="anonymous"></script>


<script>
function criarBarata() {
    const barata = document.createElement('div');
    barata.innerHTML = '🪳';
    barata.style.cssText = `
        position: fixed;
        font-size: ${20 + Math.random() * 20}px;
        left: ${Math.random() * 100}vw;
        bottom: -50px;
        z-index: 9999;
        pointer-events: none;
        animation: subirBarata ${3 + Math.random() * 3}s linear forwards;
    `;
    document.body.appendChild(barata);
    setTimeout(() => barata.remove(), 6000);
}

function invasaoDeBaratas() {
    const quantidade = 5 + Math.floor(Math.random() * 6);
    for (let i = 0; i < quantidade; i++) {
        setTimeout(criarBarata, i * 300);
    }
}

setInterval(invasaoDeBaratas, 50000);
</script>

<style>
@keyframes subirBarata {
    0%   { bottom: -50px; opacity: 1; }
    90%  { opacity: 1; }
    100% { bottom: 110vh; opacity: 0; }
}
</style>

@endsection
