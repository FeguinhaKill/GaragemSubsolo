<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Bicicleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Commissioner:wght@100..900&family=Kaushan+Script&family=Limelight&family=Stack+Sans+Headline:wght@200..700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo"><img src="/storage/images/mainImagems/logo.png"></div>
            <a class="logo-text" href="{{ route('home') }}">Bici<span class="highlight">cleta</span></a>
        </div>

        <h1>Login</h1>

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

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                >
            </div>

            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input
                    type="password"
                    class="form-control"
                    id="senha"
                    name="senha"
                    required
                >
            </div>

            <button type="submit" class="btn-login">Entrar</button>
        </form>

        <div class="divider">
            ou
        </div>

        <a href="{{ route('auth.register') }}" class="btn-login" style="display: inline-block; text-align: center; text-decoration: none; background: #6366f1; margin-bottom: 1rem;">
            Criar Novo Cadastro
        </a>

        <div class="divider">
            Demonstração com dados do seeder
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>


<style>
        body {
            background: linear-gradient(135deg, #1D9E75 0%, #15a368 100%);
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
            max-width: 400px;
        }

        .logo-section {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 2rem;
        }

        .logo {
            width: 48px;
            height: 48px;
            background: #1D9E75;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 500;
            color: #111;
        }

        .logo-text .highlight {
            color: #1D9E75;
        }

        h1 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #111;
            text-align: center;
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
            border-color: #1D9E75;
            box-shadow: 0 0 0 3px rgba(29, 158, 117, 0.1);
        }

        .btn-login {
            background: #1D9E75;
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
            background: #15a368;
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
