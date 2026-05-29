<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dados = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])->get();

        return view('Pagamentos.list', compact('dados'));
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {

            if ($request->tipo == 'usuario_id') {
                $dados = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])->whereHas('usuario', function ($q) use ($request) {
                    $q->where('nome', 'like', '%' . $request->valor . '%')
                      ->orWhere('name', 'like', '%' . $request->valor . '%');
                })->get();
            } else if($request->tipo == 'ordem_servico_id') {
                $dados = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])->whereHas('ordemServico', function ($q) use ($request) {
                    $q->where('id', 'like', '%' . $request->valor . '%');
                })->get();
            } else {
                $dados = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])->where(
                    $request->tipo,
                    'like',
                    '%' . $request->valor . '%'
                )->get();
            }
        }

        else {
            $dados = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])->get();
        }

        return view('Pagamentos.list', ['dados' => $dados]);
    }

    public function searchByOrdemServico($id)
    {
        $dados = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])
            ->where('ordem_servico_id', $id)
            ->get();

        return view('Pagamentos.list', ['dados' => $dados]);
    }

    public function create()
    {
        $usuarios = \App\Models\Usuario::all();
        $formasPagamento = \App\Models\FormaPagamento::all();
        $ordensServico = \App\Models\OrdemServico::all();

        return view('Pagamentos.form', compact('usuarios', 'formasPagamento', 'ordensServico'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuarios_id' => 'required|exists:usuarios,id',
            'ordem_servico_id' => 'required|exists:ordem_servico,id',
            'forma_pagamento_id' => 'nullable|exists:forma_pagamentos,id',
            'valor_bruto' => 'required|numeric',
            'desconto' => 'numeric|min:0',
            'status' => 'required|in:pendente,em_andamento,pago,cancelado,atrasado',
            'data_vencimento' => 'nullable|date',
        ]);

        Pagamento::create($request->all());

        return redirect('pagamento')->with('success', 'Pagamento criado com sucesso!');
    }

    public function view($id)
    {
        $pagamento = Pagamento::find($id);
        $usuarios = \App\Models\Usuario::all();
        $formasPagamento = \App\Models\FormaPagamento::all();
        $ordensServico = \App\Models\OrdemServico::all();

        return view('Pagamentos.form', compact('pagamento', 'usuarios', 'formasPagamento', 'ordensServico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'usuarios_id' => 'required|exists:usuarios,id',
            'ordem_servico_id' => 'required|exists:ordem_servico,id',
            'forma_pagamento_id' => 'nullable|exists:forma_pagamentos,id',
            'valor_bruto' => 'required|numeric',
            'desconto' => 'numeric|min:0',
            'status' => 'required|in:pendente,em_andamento,pago,cancelado,atrasado',
            'data_vencimento' => 'nullable|date',
            'data_pago' => 'nullable|date',
        ]);

        Pagamento::find($id)->update($request->all());

        return redirect('pagamento')->with('success', 'Pagamento atualizado com sucesso!');
    }

    public function show($id)
    {
        $pagamento = Pagamento::with(['usuario', 'ordemServico', 'formaPagamento'])->findOrFail($id);

        return view('Pagamentos.show', compact('pagamento'));
    }

    public function edit($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $usuarios = \App\Models\Usuario::all();
        $formasPagamento = \App\Models\FormaPagamento::all();
        $ordensServico = \App\Models\OrdemServico::all();

        return view('Pagamentos.form', compact('pagamento', 'usuarios', 'formasPagamento', 'ordensServico'));
    }

    public function pagar($id)
    {
        $pagamento = Pagamento::findOrFail($id);

        if ($pagamento->status === 'pago') {
            return redirect()->back()->with('error', 'Este pagamento já foi registrado como pago!');
        }

        $pagamento->update([
            'status' => 'pago',
            'data_pago' => now(),
        ]);

        return redirect()->route('pagamento.show', $id)->with('success', 'Pagamento registrado com sucesso!');
    }

    public function destroy($id)
    {
        Pagamento::destroy($id);

        return redirect('pagamento')->with('success', 'Pagamento removido com sucesso!');
    }
}
