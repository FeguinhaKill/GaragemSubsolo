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

<body class="@yield('body_class')">

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

            <div class="container mt-2">
    <div style="padding: 1.5rem 0;">

        {{-- boas vindas --}}
        <div style="background: #f3f4f6; border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
            <div>
                <h2 style="font-size: 20px; font-weight: 500; margin: 0 0 4px;">Painel Administrativo</h2>
                <p style="font-size: 13px; color: #6b7280; margin: 0;">Gerencie todos os módulos do sistema</p>
            </div>
            <span style="background: #E1F5EE; color: #0F6E56; font-size: 13px; font-weight: 500; padding: 6px 14px; border-radius: 20px;">
                {{ Session::get('usuario_nome') }}
            </span>
        </div>

        {{-- grid de cards --}}
        <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px;">

            <a href="{{ route('produtos.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #E1F5EE; color: #0F6E56;">🚲</div>
                <p class="dash-title">Produtos</p>
                <p class="dash-desc">Gerenciar catálogo de produtos</p>

            </a>

            <a href="{{ route('estoque.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #EEEDFE; color: #534AB7;">📦</div>
                <p class="dash-title">Estoque</p>
                <p class="dash-desc">Controlar estoque disponível</p>

            </a>

            <a href="{{ route('usuarios.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #E6F1FB; color: #185FA5;">👤</div>
                <p class="dash-title">Usuários</p>
                <p class="dash-desc">Gerenciar usuários do sistema</p>

            </a>

            <a href="{{ route('ordem_servico.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #FAEEDA; color: #854F0B;">🔧</div>
                <p class="dash-title">Ordens de serviço</p>
                <p class="dash-desc">Gerenciar ordens de serviço</p>

            </a>

            <a href="{{ route('ordem_compra.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #EAF3DE; color: #3B6D11;">🛍️</div>
                <p class="dash-title">Ordens de compra</p>
                <p class="dash-desc">Gerenciar ordens de compra</p>

            </a>

            <a href="{{ route('pagamento.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #FBEAF0; color: #993556;">💳</div>
                <p class="dash-title">Pagamentos de serviços</p>
                <p class="dash-desc">Gerenciar pagamentos de serviços</p>

            </a>

            <a href="{{ route('pagamentoCompra.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #FCEBEB; color: #A32D2D;">🧾</div>
                <p class="dash-title">Pagamentos de compras</p>
                <p class="dash-desc">Gerenciar pagamentos de compras</p>

            </a>

            <a href="{{ route('ordem_servico_item.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #F1EFE8; color: #5F5E5A;">📋</div>
                <p class="dash-title">Itens da OS</p>
                <p class="dash-desc">Gerenciar itens das ordens de serviço</p>

            </a>

            <a href="{{ route('ordem_compra_item.index') }}" class="dash-card">
                <div class="dash-icon" style="background: #F1EFE8; color: #5F5E5A;">📝</div>
                <p class="dash-title">Itens da OC</p>
                <p class="dash-desc">Gerenciar itens das ordens de compra</p>

            </a>

            <a href="{{ route('atualizacao_servico.create') }}" class="dash-card">
                <div class="dash-icon" style="background: #E6F1FB; color: #185FA5;">📅</div>
                <p class="dash-title">Atualizar serviços</p>
                <p class="dash-desc">Enviar atualizações de serviços</p>

            </a>

        </div>
    </div>
</div>

<style>

</style>
        @endif
    </main>


    <footer style="background: white; border-top: 1px solid #e5e7eb; padding: 2.5rem 1.5rem 1.25rem; margin-top: 3rem;">
    <div style="max-width: 1200px; margin: 0 auto;">

        <div style="display: grid; grid-template-columns: 1.5fr 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">

            {{-- marca --}}
            <div>
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <img src="/storage/images/mainImagems/logo.png" style="width: 44px; height: 44px; object-fit: contain;">
                    <span style="font-size: 16px; font-weight: 500; color: #111;">Garage-<span style="color: #1D9E75;">Subsolo</span></span>
                </div>
                <p style="font-size: 13px; color: #6b7280; line-height: 1.7; max-width: 260px;">
                    Aluguel e manutenção de bicicletas em Chapecó. Pedale com liberdade e segurança.
                </p>
            </div>

            {{-- navegação --}}
            <div>
                <h4 style="font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em; color: #9ca3af; margin: 0 0 12px;">
                    Navegação
                </h4>
                <div style="display: flex; flex-direction: column; gap: 6px;">
                    <a href="{{ route('produtos.indexclientes') }}" style="font-size: 13px; color: #374151; text-decoration: none;">Produtos</a>
                    <a href="{{ route('ordem_servico.formclientes') }}" style="font-size: 13px; color: #374151; text-decoration: none;">Solicitar serviço</a>
                    <a href="{{ route('atualizacao_servico.listclientes') }}" style="font-size: 13px; color: #374151; text-decoration: none;">Acompanhar serviço</a>
                    <a href="{{ route('pagamento.index') }}" style="font-size: 13px; color: #374151; text-decoration: none;">Pagamentos de serviços</a>
                    <a href="{{ route('pagamentoCompra.index') }}" style="font-size: 13px; color: #374151; text-decoration: none;">Pagamentos de compras</a>
                </div>
            </div>

            {{-- contato --}}
            <div>
                <h4 style="font-size: 11px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.06em; color: #9ca3af; margin: 0 0 12px;">
                    Contato
                </h4>
                <div style="display: flex; flex-direction: column; gap: 8px;">
                    <a href="mailto:contato@garagesubsolo.com" style="font-size: 13px; color: #374151; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 28px; height: 28px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 14px;">📧</span>
                        contato@garagesubsolo.com
                    </a>
                    <a href="tel:+5549999990000" style="font-size: 13px; color: #374151; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 28px; height: 28px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 14px;">📞</span>
                        (49) 99999-0000
                    </a>
                    <div style="font-size: 13px; color: #374151; display: flex; align-items: center; gap: 8px;">
                        <span style="width: 28px; height: 28px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 14px;">📍</span>
                        Chapecó, SC
                    </div>
                </div>
            </div>

        </div>

        <div style="border-top: 1px solid #e5e7eb; padding-top: 1.25rem; display: flex; align-items: center; justify-content: space-between;">
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
