<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login do Funcionário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <a href="{{ route('home') }}" style="justify-self:center">
                <img src="/storage/images/mainImagems/logo.png" style="width: 100px;">
            </a>
        </div>

        <h1>Área do Funcionário</h1>
        <p class="subtitle">Acesso exclusivo para gestão de estoque, produtos e ordens de serviço.</p>

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
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('funcionario.auth.login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>

            <button type="submit" class="btn-login">Entrar na área do funcionário</button>
        </form>

        <div class="divider">ou</div>

        <a href="{{ route('login') }}" class="btn-login" style="display: inline-block; text-align: center; text-decoration: none; background: #6366f1; margin-bottom: 1rem;">
            Voltar para login de clientes
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

<style>
    body {
        background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 420px;
    }

    .logo-section {
        display: flex;
        justify-content: center;
        margin-bottom: 1rem;
    }

    h1 {
        font-size: 28px;
        font-weight: 600;
        margin-bottom: 0.25rem;
        color: #111;
        text-align: center;
    }

    .subtitle {
        color: #4b5563;
        font-size: 14px;
        text-align: center;
        margin-bottom: 1rem;
    }

    .form-label {
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 1px solid #d1d5db;
        padding: 0.75rem;
        border-radius: 8px;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.1);
    }

    .btn-login {
        background: #0f766e;
        border: none;
        color: white;
        padding: 0.75rem;
        font-weight: 600;
        border-radius: 8px;
        width: 100%;
        font-size: 16px;
        transition: background 0.3s;
    }

    .btn-login:hover {
        background: #0d9488;
        color: white;
    }

    .alert {
        border-radius: 8px;
        margin-bottom: 1rem;
        font-size: 14px;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .divider {
        text-align: center;
        color: #9ca3af;
        font-size: 14px;
        margin: 1rem 0;
    }
</style>
