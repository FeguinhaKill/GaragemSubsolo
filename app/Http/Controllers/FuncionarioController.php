<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::with('usuario')->get();
        return view('funcionarios.list', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.form', compact('usuarios'));
    }

    public function validateRequest(Request $request){
        $request->validate([
            'usuario_id' => [
                'required',
                'exists:usuarios,id',
                function ($attribute, $value, $fail) {
                    $usuario = Usuario::find($value);
                    if ($usuario && $usuario->categoria_usuario !== 'funcionario') {
                        $fail('O usuário deve ter categoria "funcionário".');
                    }
                    if ($usuario && $usuario->funcionario) {
                        $fail('Este usuário já é um funcionário.');
                    }
                }
            ],
            'nome_cargo' => 'required|string|max:30',
            'salario' => 'required|numeric|min:0',
        ], [
            'usuario_id.required' => 'O campo usuário é obrigatório.',
            'usuario_id.exists' => 'O usuário selecionado não existe.',
            'nome_cargo.required' => 'O campo nome do cargo é obrigatório.',
            'salario.required' => 'O campo salário é obrigatório.',
        ]);
    }
    
    public function store(Request $request)
    {
        $this->validateRequest($request);
        $data = $request->all();
        Funcionario::create($data);
        return redirect()->route('funcionarios.index')->with('success', 'Funcionário criado com sucesso!');
    }

    public function show(Funcionario $funcionario)
    {
        return view('funcionarios.show', compact('funcionario'));
    }

    public function edit(Funcionario $funcionario)
    {
        return view('funcionarios.form', compact('funcionario'));
    }

    public function update(Request $request, Funcionario $funcionario)
    {
        $this->validateRequest($request);
        $data = $request->all();
        $funcionario->update($data);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy(Funcionario $funcionario)
    {
        $funcionario->delete();
        return redirect()->route('funcionarios.index')->with('success', 'Funcionário deletado com sucesso!');
    }

    function search(Request $request)
    {
        $query = Funcionario::with('usuario');
        
        if (!empty($request->valor)) {
            $tipo = $request->tipo ?? 'nome_cargo';
            
            if ($tipo === 'nome_usuario') {
                // Busca pelo nome do usuário através do relacionamento
                $query->whereHas('usuario', function ($q) use ($request) {
                    $q->where('nome', 'like', '%' . $request->valor . '%');
                });
            } else {
                // Busca pelos campos diretos de funcionario
                $query->where($tipo, 'like', '%' . $request->valor . '%');
            }
        }
        
        $funcionarios = $query->get();

        if ($funcionarios->isEmpty()) {
            return redirect()
                ->route('funcionarios.index')
                ->with('error', 'Nenhum funcionário encontrado.');
        }
        return view('funcionarios.list', ['funcionarios' => $funcionarios]);
    }
}
