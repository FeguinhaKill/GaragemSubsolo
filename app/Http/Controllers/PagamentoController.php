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

        return view('Pagamentos.pagamentosForm', compact('dados'));
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

        return view('Pagamentos.pagamentosForm', ['dados' => $dados]);
}
}
