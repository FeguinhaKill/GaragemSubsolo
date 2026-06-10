<?php

namespace App\Http\Controllers;

use App\Charts\EstoqueStatus;
use App\Models\Estoque;
use App\Models\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    private array $unidadesMedida = ['Litro', 'Quilo', 'Unidade'];

    private function localizacoesDisponiveis(): array
    {
        $localizacoes = [];

        for ($rack = 1; $rack <= 4; $rack++) {
            for ($bloco = 1; $bloco <= 10; $bloco++) {
                for ($andar = 1; $andar <= 3; $andar++) {
                    $localizacoes[] = sprintf('R%02d.B%02d.A%d', $rack, $bloco, $andar);
                }
            }
        }

        return $localizacoes;
    }

    function index()
    {
        $estoques = Estoque::with('produto')->get();

        return view('Estoque.list', ['estoques' => $estoques]);
    }

    function create()
    {
        $produtos = Produto::all();
        $estoque = new Estoque();

        return view('Estoque.form', [
            'estoque' => $estoque,
            'produtos' => $produtos,
            'unidadesMedida' => $this->unidadesMedida,
            'localizacoes' => $this->localizacoesDisponiveis(),
        ]);
    }

    function validateRequest(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:0',
            'unidade_medida' => 'required|in:' . implode(',', $this->unidadesMedida),
            'localizacao' => 'required|in:' . implode(',', $this->localizacoesDisponiveis())
        ], [
            'produto_id.required' => "O :attribute é obrigatório",
            'produto_id.exists' => "O :attribute selecionado é inválido",
            'quantidade.required' => "O :attribute é obrigatório",
            'quantidade.integer' => "O :attribute deve ser um número inteiro",
            'quantidade.min' => "O :attribute deve ser maior ou igual a 0",
            'unidade_medida.required' => "A unidade de medida é obrigatória",
            'unidade_medida.in' => "A unidade de medida selecionada é inválida",
            'localizacao.required' => "A localização é obrigatória",
            'localizacao.in' => "A localização selecionada é inválida"
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
            'produtos' => $produtos,
            'unidadesMedida' => $this->unidadesMedida,
            'localizacoes' => $this->localizacoesDisponiveis(),
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

    function chartestoque(EstoqueStatus $chart)
    {
        return view('Estoque.chartstatus', ['chart' => $chart->build()]);
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            if ($request->tipo === 'produto') {
                $estoques = Estoque::with('produto')->whereHas('produto', function ($query) use ($request) {
                    $query->where('nome', 'like', '%' . $request->valor . '%');
                })->get();
            } else {
                $estoques = Estoque::with('produto')->where(
                    $request->tipo,
                    'like',
                    '%' . $request->valor . '%'
                )->get();
            }
        } else {
            $estoques = Estoque::with('produto')->get();
        }

        return view('Estoque.list', ['estoques' => $estoques]);
    }
}