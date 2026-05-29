<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use App\Models\Usuario;
use App\Models\Funcionario;
use Illuminate\Http\Request;

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

        OrdemServico::create($data);

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
}
