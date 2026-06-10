<?php

namespace App\Http\Controllers;

use App\Models\OrdemCompraItem;
use App\Models\OrdemCompra;
use App\Models\Produto;
use Illuminate\Http\Request;

class OrdemCompraItemController extends Controller
{
    function index()
    {
        $dados = OrdemCompraItem::all();
        $produtos = Produto::all();
        $occ = OrdemCompra::all();

        return view('OSItems.list', ['dados' => $dados, 'produtos' => $produtos, 'occ' => $occ]);
    }

    function create()
    {
        $produtos = Produto::all();
        $occ = OrdemCompra::all();
        $dado = new OrdemCompraItem();

        return view('OSItems.form', [
            'dado' => $dado,
            'occ' => $occ,
            'produtos' => $produtos
        ]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([

            'ordem_compra_id' => 'required|exists:ordem_compras,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|numeric|min:0',
            'valor_total' => 'nullable|numeric|min:0'
        ], [
            'ordem_compra_id.required' => "O :attribute é obrigatório",
            'produto_id.required' => "O :attribute é obrigatório",
            'quantidade.required' => "O :attribute é obrigatório",
            'valor_total.required' => "O :attribute é obrigatório",
            'valor_total.numeric' => "O :attribute deve ser um número válido",
            'valor_total.min' => "O :attribute deve ser um número positivo"
        ]);
    }

    function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();

        $produto = Produto::find($data['produto_id']);
        $data['valor_total'] = $produto
            ? round($produto->preco * $data['quantidade'], 2)
            : 0;

        OrdemCompraItem::create($data);

        return redirect('ordem_compra_item')->with('success', 'Registro cadastrado com sucesso!');
    }

    function edit($id)
    {
        $dado = OrdemCompraItem::find($id);
        $occ = OrdemCompra::all();
        $produtos = Produto::all();


        return view('OSItems.form', [
            'dado' => $dado,
            'occ' => $occ,
            'produtos' => $produtos
        ]);
    }

    function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        $produto = Produto::find($data['produto_id']);
        $data['valor_total'] = $produto
            ? round($produto->preco * $data['quantidade'], 2)
            : 0;

        OrdemCompraItem::find($id)->update($data);

        return redirect('ordem_compra_item')->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        OrdemCompraItem::destroy($id);
        return redirect('ordem_compra_item')->with('success', 'Registro removido com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = OrdemCompraItem::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
            $produtos = Produto::all();
            $occ = OrdemCompra::all();
        } else {
            $dados = OrdemCompraItem::all();
            $produtos = Produto::all();
            $occ = OrdemCompra::all();
        }

        return view('OCItems.list', ['dados' => $dados, 'produtos' => $produtos, 'occ' => $occ]);
    }
}
