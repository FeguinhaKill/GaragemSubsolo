<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;


class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.list', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.form');
    }

    public function validateRequest  (Request $request){
        $request->validate([
            'nome' => 'required',
            'cpf_cnpj' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'endereco' => 'required',
            'categoria_usuario' => 'required',
            'plano_fid' => 'required',
            'imagem' => 'nullable|file|image|mimes:jpeg,png,jpg',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'cpf_cnpj.required' => 'O campo CPF/CNPJ é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'endereco.required' => 'O campo endereço é obrigatório.',
            'categoria_usuario.required' => 'O campo categoria de usuário é obrigatório.',
            'plano_fid.required' => 'O campo é obrigatório.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo jpeg, png ou jpg.',
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "imagem_usuario/"; 
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Usuario::create($data);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.form', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $this->validateRequest($request);
        $data = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "images/imagem_clientes/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');

            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $usuario->update($data);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuário deletado com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $usuarios = Usuario::where($request->tipo, 'like', '%' . $request->valor . '%')->get();
        } else {
            $usuarios = Usuario::all();
        }

        if ($usuarios->isEmpty()) {

        return redirect()
            ->route('usuarios.index')
            ->with('error', 'Nenhum usuário encontrado.');
        }
        return view('usuarios.list', ['usuarios' => $usuarios]);
    }
}
