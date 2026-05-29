<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    function index()
    {
        $estoques = Estoque::all();

        return view('Estoque.list', ['estoques' => $estoques]);
    }

    function create()
    {
        $produtos = Produto::all();
        $estoque = new Estoque();

        return view('Estoque.form', [
            'estoque' => $estoque,
            'produtos' => $produtos
        ]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:0'
        ], [
            'produto_id.required' => "O :attribute é obrigatório",
            'produto_id.exists' => "O :attribute selecionado é inválido",
            'quantidade.required' => "O :attribute é obrigatório",
            'quantidade.integer' => "O :attribute deve ser um número inteiro",
            'quantidade.min' => "O :attribute deve ser maior ou igual a 0"
        ]);
    }

    function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Estoque::create($data);

        return redirect('estoque')->with('success', 'Registro cadastrado com sucesso!');
    }

    function edit($id)
    {
        $estoque = Estoque::find($id);
        $produtos = Produto::all();

        return view('Estoque.form', [
            'estoque' => $estoque,
            'produtos' => $produtos
        ]);
    }

    function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        Estoque::find($id)->update($data);

        return redirect('estoque')->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        Estoque::destroy($id);
        return redirect('estoque')->with('success', 'Registro removido com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            if ($request->tipo === 'produto') {
                $estoques = Estoque::whereHas('produto', function ($query) use ($request) {
                    $query->where('nome', 'like', '%' . $request->valor . '%');
                })->get();
            } else {
                $estoques = Estoque::where(
                    $request->tipo,
                    'like',
                    '%' . $request->valor . '%'
                )->get();
            }
        } else {
            $estoques = Estoque::all();
        }

        return view('Estoque.list', ['estoques' => $estoques]);
    }
}