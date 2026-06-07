<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&family=Kaushan+Script&family=Limelight&family=Stack+Sans+Headline:wght@200..700&display=swap" rel="stylesheet">
</head>

<body>

    <header class="siteheader">
        <a href="{{ route('inicio') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <div
                style="width: 36px; height: 36px; background: #1D9E75; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px;">
                🚲
            </div>
            <span style="font-size: 17px; font-weight: 500; color: #111;">Bici<span
                    style="color: #1D9E75;">cleta</span></span>
        </a>

        <nav style="display: flex; align-items: center; gap: 4px;">
            <a href="{{ route('inicio') }}" class="nav-link"><strong>Início</strong></a>
            <a href="{{ route('produtos.index') }}" class="nav-link">Produtos</a>
            <a href="{{ route('estoque.index') }}" class="nav-link">Estoque</a>
            <a href="{{ route('usuarios.index') }}" class="nav-link">Usuários</a>
            <a href="{{ route('ordem_servico.index') }}" class="nav-link">Ordens de Serviço</a>
            <a href="{{ route('ordem_servico_item.index') }}" class="nav-link">Itens</a>
            <a href="{{ route('pagamento.index') }}" class="nav-link">Pagamentos</a>
            <span style="color: #d1d5db;">|</span>
            <span style="font-size: 12px; color: #6b7280; padding: 6px 12px;">{{ Session::get('usuario_nome') }}</span>
            <a href="{{ route('auth.logout') }}" class="nav-link" style="color: #ef4444;">Sair</a>
        </nav>
    </header>

    <main>
    <div class="container ">
        <div class="row">
            {{-- alertas de session --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <b>Por favor, verifique os erros abaixo</b>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    @hasSection('conteudo')
        @yield('conteudo')
    @else
        <!-- Dashboard Padrão -->
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-12">
                    <div style="text-align: center; padding: 3rem 2rem;">
                        <div style="font-size: 72px; margin-bottom: 20px;">🚲</div>
                        <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 15px; color: #111;">Bem-vindo ao Sistema Bicicleta</h1>
                        <p style="font-size: 18px; color: #6b7280; margin-bottom: 30px;">Gerenciador de ordens de serviço e estoque</p>
                        
                        <div style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block;">
                            <p style="font-size: 16px; color: #374151; margin-bottom: 0;">
                                Usuário logado: <strong style="color: #1D9E75;">{{ Session::get('usuario_nome') }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 mb-4">
                    <a href="{{ route('produtos.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                        <div class="card-body text-center" style="padding: 2rem;">
                            <div style="font-size: 48px; margin-bottom: 1rem;">📦</div>
                            <h5 class="card-title">Produtos</h5>
                            <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar produtos</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4">
                    <a href="{{ route('estoque.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                        <div class="card-body text-center" style="padding: 2rem;">
                            <div style="font-size: 48px; margin-bottom: 1rem;">📊</div>
                            <h5 class="card-title">Estoque</h5>
                            <p class="card-text" style="color: #6b7280; font-size: 14px;">Controlar estoque</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4">
                    <a href="{{ route('usuarios.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                        <div class="card-body text-center" style="padding: 2rem;">
                            <div style="font-size: 48px; margin-bottom: 1rem;">👥</div>
                            <h5 class="card-title">Usuários</h5>
                            <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar usuários</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4">
                    <a href="{{ route('ordem_servico.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                        <div class="card-body text-center" style="padding: 2rem;">
                            <div style="font-size: 48px; margin-bottom: 1rem;">🔧</div>
                            <h5 class="card-title">Ordens de Serviço</h5>
                            <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar ordens</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4">
                    <a href="{{ route('pagamento.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                        <div class="card-body text-center" style="padding: 2rem;">
                            <div style="font-size: 48px; margin-bottom: 1rem;">💳</div>
                            <h5 class="card-title">Pagamentos</h5>
                            <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar pagamentos</p>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 mb-4">
                    <a href="{{ route('ordem_servico_item.index') }}" class="card shadow-sm" style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                        <div class="card-body text-center" style="padding: 2rem;">
                            <div style="font-size: 48px; margin-bottom: 1rem;">📝</div>
                            <h5 class="card-title">Itens</h5>
                            <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar itens</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <style>
            .card {
                border: none;
                overflow: hidden;
            }

            .card:hover {
                transform: translateY(-4px);
                box-shadow: 0 8px 16px rgba(29, 158, 117, 0.15) !important;
            }

            .card-body {
                background: white;
            }

            .card-title {
                color: #111;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }
        </style>
    @endif
</main>


    <footer style="background: white; border-top: 1px solid #e5e7eb; padding: 2rem 1.5rem 1.25rem; margin-top: 3rem;">
        <div style="margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <div
                            style="width: 32px; height: 32px; background: #1D9E75; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                            🚲</div>
                        <span style="font-size: 16px; font-weight: 500;">Bici<span
                                style="color: #1D9E75;">cleta</span></span>
                    </div>
                    <p style="font-size: 13px; color: #6b7280; line-height: 1.6;">Aluguel de bicicletas rápido e
                        simples. Pedale com liberdade!</p>
                </div>
                <div>
                    <h4
                        style="font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: #374151; margin-bottom: 10px;">
                        Navegação</h4>
                    <a href="{{ route('produtos.index') }}" class="nav-link">Produtos</a>
                    <a href="{{ route('estoque.index') }}" class="nav-link">Estoque</a>
                    <a href="{{ route('usuarios.index') }}" class="nav-link">Usuários</a>
                    <a href="{{ route('ordem_servico.index') }}" class="nav-link">Ordens de Serviço</a>
                    <a href="{{ route('pagamento.index') }}" class="nav-link">Pagamentos</a>
                </div>
                <div>
                    <h4
                        style="font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: #374151; margin-bottom: 10px;">
                        Contato</h4>
                    <p style="font-size: 13px; color: #6b7280; padding: 3px 0;">📧 contato@bicicleta.com</p>
                    <p style="font-size: 13px; color: #6b7280; padding: 3px 0;">📞 (49) 99999-0000</p>
                    <p style="font-size: 13px; color: #6b7280; padding: 3px 0;">📍 Chapecó, SC</p>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    </footer>

</body>

</html>


<style>
    .siteheader {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 0.75rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0px 5px 12px rgba(0, 0, 0, 0);
    }

    body {
        background-color: #e6e6e6;
        color: #111;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

    }

    .nav-link {
        font-size: 14px;
        color: #6b7280;
        text-decoration: none;
        padding: 6px 12px;
        border-radius: 8px;
        transition: background 0.15s, color 0.15s;
    }

    .nav-link:hover {
        background: #f3f4f6;
        color: #111;
    }

    .topcoisa .img-fluid {
        height: 400px;
        object-fit: cover;
    }

    .hero {
        height: calc(100vh - 60px);

    }

    .hero-img {
        width: 1900px;
        height: 540px;
        object-position: center bottom;
        border-radius: 0 0 40px 40px;
    }

    .movatxt {
        font-family: "Stack Sans Headline", sans-serif;
        font-optical-sizing: auto;
        font-weight: <weight>;
         font-style: normal;
    }

    .custom-line {
        justify-content: center;
        border: none;
        height: 2px;
        background-color: #333333;
        width: 1000px;
        margin-left: 500px;
        margin-right: 500px;
    }


</style>
