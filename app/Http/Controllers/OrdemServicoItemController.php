<?php

namespace App\Http\Controllers;

use App\Models\OrdemServicoItem;
use App\Models\OrdemServico;
use App\Models\Produto;
use Illuminate\Http\Request;

class OrdemServicoItemController extends Controller
{
    function index()
    {
        $dados = OrdemServicoItem::all();
        $produtos = Produto::all();
        $oss = OrdemServico::all();

        return view('OSItems.list', ['dados' => $dados, 'produtos' => $produtos, 'oss' => $oss]);
    }

    function create()
    {
        $produtos = Produto::all();
        $oss = OrdemServico::all();
        $dado = new OrdemServicoItem();

        return view('OrdemServicosItem.form', [
            'dado' => $dado,
            'oss' => $oss,
            'produtos' => $produtos
        ]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([

            'ordem_servico_id' => 'required|exists:ordem_servicos,id',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|numeric|min:0',
            'valor_total' => 'nullable|numeric|min:0'
        ], [
            'ordem_servico_id.required' => "O :attribute é obrigatório",
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

        OrdemServicoItem::create($data);

        return redirect('ordem_servico_item')->with('success', 'Registro cadastrado com sucesso!');
    }

    function edit($id)
    {
        $dado = OrdemServicoItem::find($id);
        $oss = OrdemServico::all();
        $produtos = Produto::all();


        return view('OrdemServicosItem.form', [
            'dado' => $dado,
            'oss' => $oss,
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

        OrdemServicoItem::find($id)->update($data);

        return redirect('ordem_servico_item')->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        OrdemServicoItem::destroy($id);
        return redirect('ordem_servico_item')->with('success', 'Registro removido com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = OrdemServicoItem::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
            $produtos = Produto::all();
            $oss = OrdemServico::all();
        } else {
            $dados = OrdemServicoItem::all();
            $produtos = Produto::all();
            $oss = OrdemServico::all();
        }

        return view('OSItems.list', ['dados' => $dados, 'produtos' => $produtos, 'oss' => $oss]);
    }
}
