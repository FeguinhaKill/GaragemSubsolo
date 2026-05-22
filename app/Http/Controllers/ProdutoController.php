<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    function index() {

        $produtos = Produto::with('estoque')->get();
        return view('produtos.listar_produto', compact('produtos'));
    }

    public function create() {
        return view('produtos.criar_produto');
    }

    public function validateRequest(Request $request){
        $request->validate([
            'nome' => 'required',
            'marca' => 'required',
            'preco' => 'required',
            'imagem'=> 'nullable|file|image|mimes:jpeg,png,jpg',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'marca.required' => 'O campo marca é obrigatório.',
            'preco.required' => 'O campo preço é obrigatório.',
            'imagem.image' => 'O arquivo deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser do tipo jpeg, png ou jpg.',
        ]);
    }

    public function store(Request $request) {
        $this->validateRequest($request);

        $data = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdiHs').".".$imagem->getClientOriginalExtension();
            $diretorio = "images/imagem_produtos/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Produto::create($data);

        return redirect()->route('produtos.index')
            ->with('success', 'Produto criado com sucesso!');
    }

    public function show($id) {
        $produto = Produto::findOrFail($id);
        return view('produtos.exibir_produto', compact('produto'));
    }


    public function consultarEstoque(Request $request) {
        $query = Produto::with('estoque');

        if ($request->filled('valor')) {
            $query->where('nome', 'like', '%' . $request->valor . '%')
                  ->orWhere('marca', 'like', '%' . $request->valor . '%');
        }

        $produtos = $query->get();
        return view('produtos.consultar_estoque', compact('produtos'));
    }

    public function edit($id) {
        $produto = Produto::findOrFail($id);
        return view('produtos.editar_produto', compact('produto'));
    }

    public function update(Request $request, $id){
        $this->validateRequest($request);
        $produto = Produto::findOrFail($id);
        $data = $request->except('imagem');

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nome_imagem = date('YmdiHs').".".$imagem->getClientOriginalExtension();
            $diretorio = "images/imagem_produtos/";
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $produto->update($data);
        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id) {
        Produto::findOrFail($id)->delete();
        return redirect()->route('produtos.index')->with('success', 'Produto deletado com sucesso!');
    }

    public function search(Request $request)
    {
        $query = Produto::query();

        if ($request->filled('tipo') && $request->filled('valor')) {
            if ($request->tipo == 'nome') {
                $query->where('nome', 'like', '%' . $request->valor . '%');
            }
            if ($request->tipo == 'marca') {
                $query->where('marca', 'like', '%' . $request->valor . '%');
            }
            if ($request->tipo == 'preco') {
                $query->where('preco', 'like', '%' . $request->valor . '%');
            }
        }

        $produtos = $query->get();
        return view('produtos.listar_produto', compact('produtos'));
    }
}
