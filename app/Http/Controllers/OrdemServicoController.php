<?php

namespace App\Http\Controllers;

use App\Charts\OrdensServicoStatus;

use App\Models\AtualizacaoServico;
use App\Models\OrdemServico;
use App\Models\OrdemServicoitem;
use App\Models\Usuario;
use App\Models\Funcionario;
use App\Models\Produto;
use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

class OrdemServicoController extends Controller
{
    function index()
    {
        $dados = OrdemServico::all(); //select * from ordem_servico

        return view('OrdemServicos.list', ['dados' => $dados]);
    }

    function create()
    {
        $usuarios = Usuario::all();
        $funcionarios = Funcionario::all();
        $dado = new OrdemServico();

        return view('OrdemServicos.form', [
            'dado' => $dado,
            'usuarios' => $usuarios,
            'funcionarios' => $funcionarios
        ]);
    }

    function formclientes()
    {
        return view('OrdemServicos.formclientes');
    }

    function show($id)
    {
        $usuarioId = Session::get('usuario_id');

        $ordem = OrdemServico::where('id', $id)
            ->where('usuario_id', $usuarioId)
            ->firstOrFail();

        $atualizacoes = AtualizacaoServico::where('ordem_servico_id', $ordem->id)
            ->with('funcionario.usuario')
            ->orderByDesc('created_at')
            ->get();

        return view('OrdemServicos.showcliente', compact('ordem', 'atualizacoes'));
    }

    function storeClienteRequest(Request $request)
    {
        $request->validate([
            'descricao' => 'required|string|min:10|max:1000',
        ], [
            'descricao.required' => 'Descreva o serviço que deseja solicitar.',
            'descricao.min' => 'A descrição deve ter pelo menos 10 caracteres.',
            'descricao.max' => 'A descrição não pode ter mais de 1000 caracteres.',
        ]);

        $usuarioId = Session::get('usuario_id');

        if (! $usuarioId) {
            return redirect()->route('login')->with('error', 'Faça login para solicitar um serviço.');
        }

        $funcionario = Funcionario::query()->first();

        $ordem = OrdemServico::create([
            'usuario_id' => $usuarioId,
            'funcionario_id' => $funcionario?->id ?? 1,
            'data_abertura' => now()->toDateString(),
            'data_fechamento' => null,
            'status' => 'aberta',
            'valor_total' => 0,
            'descricao' => $request->descricao,
        ]);

        return redirect()->route('ordem_servico.formclientes')
            ->with('success', 'Solicitação de serviço criada com sucesso!');
    }

    function validateRequest(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'funcionario_id' => 'required|exists:funcionarios,id',
            'data_abertura' => 'required|date',
            'data_fechamento' => 'nullable|date|after:data_abertura',
            'status' => 'required|in:aberta,fechada,cancelada,atrasado',
            'valor_total' => 'nullable|numeric|min:0'
        ], [
            'usuario_id.required' => "O :attribute é obrigatório",
            'funcionario_id.required' => "O :attribute é obrigatório",
            'data_abertura.required' => "O :attribute é obrigatório",
            'data_fechamento.after' => "O :attribute deve ser posterior à data de abertura",
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
        $ordem = OrdemServico::create($data);

        $produtos = $request->input('produto_id', []);
        $quantidades = $request->input('quantidade', []);

        foreach ($produtos as $index => $produtoId) {
            if (empty($produtoId)) continue;

            $quantidade = isset($quantidades[$index]) ? (int)$quantidades[$index] : 0;
            if ($quantidade <= 0) continue;

            $produto = Produto::find($produtoId);
            $valorTotalItem = $produto ? round($produto->preco * $quantidade, 2) : 0;

            OrdemServicoitem::create([
                'ordem_servico_id' => $ordem->id,
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

        return redirect('ordem_servico')->with('success', 'Registro cadastrado com sucesso!');
    }

    function edit($id)
    {
        $dado = OrdemServico::find($id);
        $usuarios = Usuario::all();
        $funcionarios = Funcionario::all();


        return view('OrdemServicos.form', [
            'dado' => $dado,
            'usuarios' => $usuarios,
            'funcionarios' => $funcionarios
        ]);
    }

    function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $data = $request->all();

        OrdemServico::find($id)->update($data);

        return redirect('ordem_servico')->with('success', 'Registro atualizado com sucesso!');
    }

    function destroy($id)
    {
        OrdemServico::destroy($id);
        return redirect('ordem_servico')->with('success', 'Registro removido com sucesso!');
    }

    function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = OrdemServico::where(
                $request->tipo,
                'like',
                '%' . $request->valor . '%'
            )->get();
        } else {
            $dados = OrdemServico::all();
        }

        return view('OrdemServicos.list', ['dados' => $dados]);
    }

    function reportordemservico()
    {
        $ordens = OrdemServico::with(['usuario'])->get();

        $data = [
            'titulo' => 'Relatório de Ordens de Servicos',
            'ordens' => $ordens,
        ];

        $pdf = Pdf::loadView('ordemservicos.reportservicos', $data);

        return $pdf->download('report_ordemServico.pdf');
    }

    function chartservicos(OrdensServicoStatus $chart)
    {
        return view('ordemservicos.chartservicostatus', ['chart' => $chart->build()]);
    }
}
