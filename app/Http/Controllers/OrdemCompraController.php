<?php

namespace App\Http\Controllers;

use App\Models\OrdemCompra;
use Illuminate\Http\Request;
use App\Models\OrdemCompraitem;
use App\Models\Usuario;
use App\Models\Produto;
use App\Models\Estoque;

class OrdemCompraController extends Controller
{
    function index()
    {
        $dados = OrdemCompra::all(); //select * from ordem_compra

        return view('OrdemCompras.list', ['dados' => $dados]);
    }

    function create()
    {
        $usuarios = Usuario::all();
        $dado = new OrdemCompra();

        return view('OrdemCompras.form', [
            'dado' => $dado,
            'usuarios' => $usuarios,
        ]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'data_compra' => 'required|date',
            'status' => 'required|in:aberta,fechada',
            'valor_total' => 'nullable|numeric|min:0'
        ], [
            'usuario_id.required' => "O :attribute é obrigatório",
            'data_compra.required' => "O :attribute é obrigatório",
            'status.in' => "O :attribute deve ser um dos valores válidos",
            'valor_total.required' => "O :attribute é obrigatório",
            'valor_total.numeric' => "O :attribute deve ser um número válido",
            'valor_total.min' => "O :attribute deve ser um número positivo"
        ]);
    }

    function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        if (!isset($data['valor_total']) || $data['valor_total'] === '') {
            $data['valor_total'] = 0;
        }

        $ordem = OrdemCompra::create($data);

        $produtos = $request->input('produto_id', []);
        $quantidades = $request->input('quantidade', []);

        foreach ($produtos as $index => $produtoId) {
            if (empty($produtoId)) continue;

            $quantidade = isset($quantidades[$index]) ? (int)$quantidades[$index] : 0;
            if ($quantidade <= 0) continue;

            $produto = Produto::find($produtoId);
            $valorTotalItem = $produto ? round($produto->preco * $quantidade, 2) : 0;

            OrdemCompraitem::create([
                'ordem_compra_id' => $ordem->id,
                'produto_id' => $produtoId,
                'quantidade' => $quantidade,
                'valor_total' => $valorTotalItem,
            ]);

            $estoque = Estoque::where('produto_id', $produtoId)->first();

            if (! $estoque) {
                continue;
            }

            if ($estoque->quantidade < $quantidade) {
                return back()->withErrors([
                    'produto_id' => 'Estoque insuficiente para o produto selecionado.',
                ])->withInput();
            }

            $estoque->decrement('quantidade', $quantidade);
        }

        $ordem->calcularValorTotal();

        return redirect('ordem_compra')->with('success', 'Registro cadastrado com sucesso!');
    }

    function edit($id)
    {
        $dado = OrdemCompra::find($id);
        $usuarios = Usuario::all();


        return view('OrdemCompras.form', [
            'dado' => $dado,
            'usuarios' => $usuarios,
        ]);
    }

    function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        OrdemCompra::find($id)->update($data);

        return redirect('ordem_compra')->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        OrdemCompra::destroy($id);
        return redirect('ordem_compra')->with('success', 'Registro removido com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = OrdemCompra::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = OrdemCompra::all();
        }

        return view('OrdemCompras.list', ['dados' => $dados]);
    }
}
