<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Usuario;

class RestrictClientAccess
{
    public function handle(Request $request, Closure $next)
    {
        $usuarioId = Session::get('usuario_id');
        
        if (!$usuarioId) {
            return redirect()->route('login');
        }

        $usuario = Usuario::find($usuarioId);

        if ($usuario && $usuario->categoria_usuario === 'cliente') {
            $rotaAtual = $request->route()->getName();
            
            $rotasPermitidas = [
                'inicio',
                'ordem_servico.create',
                'ordem_servico.store',
                'pagamento.index',
                'pagamento.show',
                'pagamento.pagar',
                'auth.logout',
            ];

            if (!in_array($rotaAtual, $rotasPermitidas)) {
                return redirect()->back()->with('error', 'Acesso negado para clientes.');
            }
        }

        return $next($request);
    }
}
