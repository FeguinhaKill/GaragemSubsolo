<?php

namespace App\Observers;

use App\Models\Usuario;
use App\Models\Funcionario;

class UsuarioObserver
{
    /**
     * Chamado quando um Usuario é criado
     * 
     * Se o usuário tiver categoria "funcionário", cria automaticamente
     * um registro de Funcionário associado a este usuário
     *
     * @param Usuario $usuario
     * @return void
     */
    public function created(Usuario $usuario)
    {
        // Verifica se o usuário criado tem categoria "funcionário"
        if ($usuario->categoria_usuario === 'funcionario') {
            // Cria um novo funcionário associado a este usuário
            Funcionario::create([
                'usuario_id' => $usuario->id,
                // Define valores padrão para o funcionário
                'nome_cargo' => 'sem cargo definido',
                'salario' => 0.00,
            ]);
        }
    }

    /**
     * Chamado quando um Usuario é atualizado
     * 
     * Se o usuário foi atualizado para categoria "funcionário"
     * e ainda não tem um Funcionário associado, cria um novo registro
     *
     * @param Usuario $usuario
     * @return void
     */
    public function updated(Usuario $usuario)
    {
        // Verifica se a categoria foi atualizada para "funcionário"
        if ($usuario->categoria_usuario === 'funcionario' && !$usuario->funcionario) {
            // Se não tem funcionário associado, cria um novo
            Funcionario::create([
                'usuario_id' => $usuario->id,
                'nome_cargo' => 'sem cargo definido',
                'salario' => 0.00,
            ]);
        }
    }

    /**
     * Chamado quando um Usuario é deletado
     * 
     * Quando um usuário é deletado, o Funcionário associado
     * é automaticamente deletado pela constraint onDelete('cascade')
     * Este método é apenas para logging ou lógica adicional se necessário
     *
     * @param Usuario $usuario
     * @return void
     */
    public function deleted(Usuario $usuario)
    {
        // A cascade constraint da chave estrangeira cuidará do delete automático
        // Este método pode ser usado para logging se necessário
        // logger('Usuário ' . $usuario->id . ' foi deletado com seu funcionário');
    }

    /**
     * Chamado quando um Usuario é restaurado (soft delete)
     *
     * @param Usuario $usuario
     * @return void
     */
    public function restored(Usuario $usuario)
    {
        // Lógica para quando um usuário soft-deleted é restaurado
    }

    /**
     * Chamado quando um Usuario é permanentemente deletado (force delete)
     *
     * @param Usuario $usuario
     * @return void
     */
    public function forceDeleted(Usuario $usuario)
    {
        // Lógica para quando um usuário é permanentemente deletado
    }
}
