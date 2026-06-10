<?php

namespace App\Http\Controllers;

use App\Models\AtualizacaoServico;
use App\Models\Funcionario;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AtualizacaoServicoController extends Controller
{
    public function listarCliente()
    {
        $usuarioId = Session::get('usuario_id');

        if (! $usuarioId) {
            return redirect()->route('login')->with('error', 'Faça login para acompanhar as atualizações.');
        }

        $ordensServico = OrdemServico::where('usuario_id', $usuarioId)
            ->orderByDesc('id')
            ->get();

        $atualizacoes = AtualizacaoServico::whereIn('ordem_servico_id', $ordensServico->pluck('id'))
            ->with('funcionario.usuario')
            ->orderByDesc('created_at')
            ->get();

        return view('AtualizacoesServico.listclientes', compact('ordensServico', 'atualizacoes'));
    }

    public function create($ordemServicoId = null)
    {
        $ordensServico = OrdemServico::orderByDesc('id')->get();

        return view('AtualizacoesServico.form', compact('ordensServico', 'ordemServicoId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ordem_servico_id' => 'required|exists:ordem_servico,id',
            'comentario' => 'required|string|min:5|max:1000',
        ], [
            'ordem_servico_id.required' => 'Selecione a ordem de serviço.',
            'ordem_servico_id.exists' => 'A ordem de serviço selecionada é inválida.',
            'comentario.required' => 'Descreva a atualização para o cliente.',
            'comentario.min' => 'A atualização deve ter pelo menos 5 caracteres.',
            'comentario.max' => 'A atualização não pode ter mais de 1000 caracteres.',
        ]);

        $usuarioId = Session::get('usuario_id');
        $funcionario = Funcionario::where('usuario_id', $usuarioId)->first();

        if (! $funcionario) {
            $funcionario = Funcionario::create([
                'usuario_id' => $usuarioId,
                'nome_cargo' => 'Funcionário',
                'salario' => 0,
            ]);
        }

        AtualizacaoServico::create([
            'ordem_servico_id' => $request->ordem_servico_id,
            'usuario_id' => $usuarioId,
            'funcionario_id' => $funcionario->id,
            'data_atualizacao' => now(),
            'comentario' => $request->comentario,
        ]);

        return redirect()->route('atualizacao_servico.create', $request->ordem_servico_id)
            ->with('success', 'Atualização registrada com sucesso!');
    }
}
