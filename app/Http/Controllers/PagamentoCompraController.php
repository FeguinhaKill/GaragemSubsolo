<?php

namespace App\Http\Controllers;

use App\Models\PagamentoCompra;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

class PagamentoCompraController extends Controller
{
    public function index()
    {
        $usuarioLogado = Usuario::find(Session::get('usuario_id'));

        // Se é cliente, mostra apenas seus PagamentosCompra
        if ($usuarioLogado && $usuarioLogado->categoria_usuario === 'cliente') {
            $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])
                ->where('usuario_id', $usuarioLogado->id)
                ->get();
        } else {
            $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])->get();
        }

        return view('PagamentosCompra.list', compact('dados', 'usuarioLogado'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {

            if ($request->tipo == 'usuario_id') {
                $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])->whereHas('usuario', function ($q) use ($request) {
                    $q->where('nome', 'like', '%' . $request->valor . '%')
                      ->orWhere('name', 'like', '%' . $request->valor . '%');
                })->get();
            } else if($request->tipo == 'ordem_compra_id') {
                $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])->whereHas('OrdemCompra', function ($q) use ($request) {
                    $q->where('id', 'like', '%' . $request->valor . '%');
                })->get();
            } else {
                $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])->where(
                    $request->tipo,
                    'like',
                    '%' . $request->valor . '%'
                )->get();
            }
        }

        else {
            $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])->get();
        }

        return view('pagamentosCompra.list', ['dados' => $dados]);
    }

    public function searchByOrdemCompra($id)
    {
        $dados = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])
            ->where('ordem_compra_id', $id)
            ->get();

        return view('PagamentosCompra.list', ['dados' => $dados]);
    }

    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        $formasPagamento = \App\Models\FormaPagamento::all();
        $ordensCompra = \App\Models\OrdemCompra::all();

        return view('PagamentosCompra.form', compact('usuarios', 'formasPagamento', 'ordensCompra'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuarios_id' => 'required|exists:usuarios,id',
            'ordem_compra_id' => 'required|exists:ordem_servico,id',
            'forma_PagamentoCompra_id' => 'nullable|exists:forma_PagamentosCompra,id',
            'valor_bruto' => 'required|numeric',
            'desconto' => 'numeric|min:0',
            'status' => 'required|in:pendente,em_andamento,pago,cancelado,atrasado',
        ]);

        PagamentoCompra::create($request->all());

        return redirect('PagamentoCompra')->with('success', 'Pagamento da Compra criado com sucesso!');
    }

    public function view($id)
    {
        $PagamentoCompra = PagamentoCompra::find($id);
        $usuarios = \App\Models\Usuario::all();
        $formasPagamento = \App\Models\FormaPagamento::all();
        $ordensCompra = \App\Models\OrdemCompra::all();

        return view('PagamentosCompra.form', compact('PagamentoCompra', 'usuarios', 'formasPagamento', 'ordensCompra'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuarios_id' => 'required|exists:usuarios,id',
            'ordem_compra_id' => 'required|exists:ordem_servico,id',
            'forma_PagamentoCompra_id' => 'nullable|exists:forma_PagamentosCompra,id',
            'valor_bruto' => 'required|numeric',
            'desconto' => 'numeric|min:0',
            'status' => 'required|in:pendente,em_andamento,pago,cancelado,atrasado',
            'data_pago' => 'nullable|date',
        ]);

        PagamentoCompra::find($id)->update($request->all());

        return redirect('PagamentoCompra')->with('success', 'PagamentoCompra atualizado com sucesso!');
    }

    public function show($id)
    {
        $PagamentoCompra = PagamentoCompra::with(['usuario', 'OrdemCompra', 'FormaPagamento'])->findOrFail($id);

        // Verifica se usuário é cliente e se é seu próprio PagamentoCompra
        $usuarioLogado = Usuario::find(Session::get('usuario_id'));
        if ($usuarioLogado && $usuarioLogado->categoria_usuario === 'cliente' && $PagamentoCompra->usuario_id !== $usuarioLogado->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar este PagamentoCompra.');
        }

        return view('PagamentosCompra.show', compact('PagamentoCompra'));
    }

    public function edit($id)
    {
        $PagamentoCompra = PagamentoCompra::findOrFail($id);
        $usuarios = \App\Models\Usuario::all();
        $formasPagamento = \App\Models\FormaPagamento::all();
        $ordensCompra = \App\Models\OrdemCompra::all();

        return view('PagamentosCompra.form', compact('PagamentoCompra', 'usuarios', 'formasPagamento', 'ordensCompra'));
    }

    public function pagar($id)
    {
        $PagamentoCompra = PagamentoCompra::findOrFail($id);

        // Verifica se usuário é cliente e se é seu próprio PagamentoCompra
        $usuarioLogado = Usuario::find(Session::get('usuario_id'));
        if ($usuarioLogado && $usuarioLogado->categoria_usuario === 'cliente' && $PagamentoCompra->usuario_id !== $usuarioLogado->id) {
            return redirect()->back()->with('error', 'Você não tem permissão para pagar este PagamentoCompra.');
        }

        if ($PagamentoCompra->status === 'pago') {
            return redirect()->back()->with('error', 'Este PagamentoCompra já foi registrado como pago!');
        }

        $PagamentoCompra->update([
            'status' => 'pago',
            'data_pago' => now(),
        ]);

        return redirect()->route('pagamentoCompra.show', $id)->with('success', 'PagamentoCompra registrado com sucesso!');
    }

    public function destroy($id)
    {
        PagamentoCompra::destroy($id);

        return redirect('PagamentoCompra')->with('success', 'PagamentoCompra removido com sucesso!');
    }

    function reportpagamentocompra(){
        $pagamento = PagamentoCompra::with(['usuario', 'ordemCompra', 'formaPagamento'])->get();

        $data = [
            'titulo' => 'Relatório Pagamento de Ordens de Compra',
            'pagamento' => $pagamento,
        ];

        $pdf = Pdf::loadView('pagamentoscompra.reportpagamentocompra', $data);

        return $pdf->download('report_pagamentoCompra.pdf');

    }
}
