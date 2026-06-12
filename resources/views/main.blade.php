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
    <link
        href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&family=Kaushan+Script&family=Limelight&family=Stack+Sans+Headline:wght@200..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&family=Kaushan+Script&family=Limelight&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Stack+Sans+Headline:wght@200..700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="/css/tudocss.css">
</head>

<body>

    <header class="siteheader">
        <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
            <img src="/storage/images/mainImagems/logo.png" style="width: 80px">
            <span style="font-size: 17px; font-weight: 500; color: #111;">Garage-<span
                    style="color: #1D9E75;">Subsolo</span></span>
        </a>

        <nav style="display: flex; align-items: center; gap: 4px;">
            <a href="{{route('produtos.indexclientes') }}" class="nav-link">Produtos</a>

            <div class="dropdown show">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Serviços
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                    <a class="dropdown-item nav-link" href="{{ route('ordem_servico.formclientes') }}">Solicitar Serviço</a>
                    <a class="dropdown-item nav-link" href="{{ route('atualizacao_servico.listclientes') }}">Acompanhar Serviço</a>
                </div>
            </div>

            <div class="dropdown show">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pagamentos
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item nav-link" href="{{ route('pagamento.index') }}">Pagamento Serviços</a>
                    <a class="dropdown-item nav-link" href="{{ route('pagamentoCompra.index') }}">Pagamento Compras</a>
                </div>
            </div>

            <span style="color: #d1d5db;">|</span>
            @if (!empty(Session::get('usuario_nome')))
                <a href="{{ route('inicio') }}" class="btn nav-link"
                    style="font-size: 16px; color: #465061; padding: 6px 12px;">{{ Session::get('usuario_nome') }}</span>
                    <a href="{{ route('auth.logout') }}" class="nav-link" style="color: #ef4444;">Sair</a>
            @endif
            @if (empty(Session::get('usuario_nome')))
                <a href="{{ route('login') }}" class="nav-link" style="color: #1D9E75;">Entrar</a>
            @endif
        </nav>
    </header>

    <main>
        <div class="container ">
            <div class="row">
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

            <div class="container mt-2">
                <div class="row mb-3">
                    <div class="col-12">
                        <div style="text-align: center; padding: 3rem 2rem;">
                            <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 25px; color: #111;"> Sistema Garage-Subsolo</h1>
                            <div
                                style="background: white; border-radius: 12px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block;">
                                <p style="font-size: 16px; color: #374151; margin-bottom: 0;">
                                    Usuário logado: <strong
                                        style="color: #1D9E75;">{{ Session::get('usuario_nome') }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('produtos.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Produtos</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar produtos</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('estoque.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Estoque</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Controlar estoque</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('usuarios.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Usuários</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar usuários</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('ordem_servico.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Ordens de Serviço</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar ordens de
                                    Serviço</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('ordem_compra.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Ordens de Compra</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar ordens de
                                    Compra</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('pagamento.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Pagamentos de Serviços</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar Pagamentos de Serviços</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('pagamentoCompra.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Pagamentos de Compras</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar Pagamentos de Compras</p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('ordem_servico_item.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Itens da OS</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar itens da OS
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('ordem_compra_item.index') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Itens da OC</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Gerenciar itens da OC
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 mb-4">
                        <a href="{{ route('atualizacao_servico.create') }}" class="card shadow-sm"
                            style="text-decoration: none; color: inherit; transition: transform 0.2s, box-shadow 0.2s;">
                            <div class="card-body text-center" style="padding: 2rem;">
                                <div style="font-size: 48px; margin-bottom: 1rem;"></div>
                                <h5 class="card-title">Atualizar Serviços</h5>
                                <p class="card-text" style="color: #6b7280; font-size: 14px;">Enviar atualizações de serviços</p>
                            </div>
                        </a>
                    </div>

                </div>
        @endif
    </main>


    <footer style="background: white; border-top: 1px solid #e5e7eb; padding: 2rem 1.5rem 1.25rem; margin-top: 3rem;">
        <div style="margin: 0 auto;">
            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
                        <div style="width: 32px; height: 32px; background: #1D9E75;
                        border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                        <img src="/storage/images/mainImagems/logo.png" style="width: 80px">
                            </div>
                        <span style="margin-left: 20px; font-size: 16px; font-weight: 500;">Garage-<span
                                style="color: #1D9E75;">-subsolo</span></span>
                    </div>

                </div>
                <div>
                    <h4
                        style="font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; color: #374151; margin-bottom: 10px;">
                        Navegação</h4>
                    <a href="{{route('produtos.indexclientes') }}" class="nav-link">Produtos</a>
                    <a class="dropdown-item nav-link" href="{{ route('ordem_servico.formclientes') }}">Solicitar Serviço</a>
                    <a class="dropdown-item nav-link" href="{{ route('atualizacao_servico.listclientes') }}">Acompanhar Serviço</a>
                    <a class="dropdown-item nav-link" href="{{ route('pagamento.index') }}">Pagamento de Serviços</a>
                    <a class="dropdown-item nav-link" href="{{ route('pagamentoCompra.index') }}">Pagamento de Compras</a>
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
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>
