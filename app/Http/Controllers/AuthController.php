<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Session::has('usuario_id')) {
            return redirect()->route('inicio');
        }
        return view('auth.login');
    }

    public function showFuncionarioLogin()
    {
        if (Session::has('usuario_id')) {
            return redirect()->route('inicio');
        }

        return view('auth.funcionario-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:4',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo 4 dígitos.',
        ]);

        $usuario = Usuario::where('email', $request->email)
                          ->where('senha', $request->senha)
                          ->first();

        if ($usuario) {
            if (!in_array($usuario->categoria_usuario, ['cliente'], true)) {
                return redirect()->route('funcionario.login')
                    ->with('error', 'Funcionários e administradores devem usar o login exclusivo.');
            }

            Session::put('usuario_id', $usuario->id);
            Session::put('usuario_nome', $usuario->nome);
            Session::put('usuario_email', $usuario->email);

            return redirect()->route('home')->with('success', 'Bem-vindo ' . $usuario->nome . '!');
        }

        return back()->with('error', 'Email ou senha inválidos.');
    }

    public function loginFuncionario(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|min:4',
        ], [
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O email deve ser válido.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo 4 dígitos.',
        ]);

        $usuario = Usuario::where('email', $request->email)
            ->where('senha', $request->senha)
            ->first();

        if (!$usuario) {
            return back()->with('error', 'Email ou senha inválidos.')->withInput();
        }

        if (!in_array($usuario->categoria_usuario, ['funcionario', 'admin'], true)) {
            return back()->with('error', 'Acesso restrito para funcionários.')->withInput();
        }

        Funcionario::firstOrCreate(
            ['usuario_id' => $usuario->id],
            ['nome_cargo' => 'Funcionário', 'salario' => 0]
        );

        Session::put('usuario_id', $usuario->id);
        Session::put('usuario_nome', $usuario->nome);
        Session::put('usuario_email', $usuario->email);

        return redirect()->route('inicio')->with('success', 'Bem-vindo ' . $usuario->nome . '!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:100',
            'cpf_cnpj' => 'required|string|max:30',
            'email' => 'required|email|max:100|unique:usuarios',
            'telefone' => 'required|string|max:20',
            'endereco' => 'required|string|max:100',
            'senha' => 'required|digits_between:4,20',
            'imagem' => 'nullable|file|image|mimes:jpeg,png,jpg',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.unique' => 'Este email já está cadastrado.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.digits_between' => 'A senha deve ter entre 4 e 20 dígitos.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo jpeg, png ou jpg.',
        ]);

        $data = $request->except('imagem');
        $data['categoria_usuario'] = 'cliente'; // Novo registro sempre é cliente

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem_usuario/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $usuario = Usuario::create($data);

        Session::put('usuario_id', $usuario->id);
        Session::put('usuario_nome', $usuario->nome);
        Session::put('usuario_email', $usuario->email);

        return redirect()->route('inicio')->with('success', 'Cadastro realizado com sucesso! Bem-vindo ' . $usuario->nome . '!');
    }
}
