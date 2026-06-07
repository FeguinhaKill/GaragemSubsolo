<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    function index()
    {
        $produtos = Produto::all();

        return view('Produtos.list', ['produtos' => $produtos]);
    }

    function create()
    {
        $produto = new Produto();

        return view('Produtos.form', [
            'produto' => $produto
        ]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'marca' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'descricao' => 'nullable|string|max:1000',
            'tipo' => 'required|string|max:255',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'nome.required' => "O campo :attribute é obrigatório",
            'marca.required' => "O campo :attribute é obrigatório",
            'preco.required' => "O campo :attribute é obrigatório",
            'preco.numeric' => "O campo :attribute deve ser um número válido",
            'tipo.required' => "O campo :attribute é obrigatório",
            'descricao.max' => "O campo :attribute não pode ter mais de 1000 caracteres",
            'imagem.image' => "O arquivo deve ser uma imagem válida",
            'imagem.mimes' => "A imagem deve ser do tipo jpeg, png, jpg ou gif"
        ]);
    }

    function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "produtos/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Produto::create($data);

        return redirect('produtos')->with('success', 'Produto cadastrado com sucesso!');
    }

    function edit($id)
    {
        $produto = Produto::find($id);

        return view('Produtos.form', [
            'produto' => $produto
        ]);
    }

    function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $data = $request->except('imagem');

        $produto = Produto::find($id);

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdHis') . "." . $imagem->getClientOriginalExtension();
            $diretorio = "produtos/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $produto->update($data);

        return redirect('produtos')->with('success', 'Produto atualizado com sucesso!');
    }

    function destroy($id)
    {
        Produto::destroy($id);
        return redirect('produtos')->with('success', 'Produto removido com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $produtos = Produto::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $produtos = Produto::all();
        }

        return view('Produtos.list', ['produtos' => $produtos]);
    }
}
