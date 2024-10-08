<?php

namespace App\Support\Factory;

use App\Models\Cliente;
use App\Models\Fotografo;
use App\Models\Usuario;
use App\Support\Factory\Interfaces\ModelFactoryInterface;
use Illuminate\Database\Eloquent\Model;

class UserFactory implements ModelFactoryInterface
{
    const USER_TYPES = [
        'Cliente' => Cliente::class,
        'Fotografo' => Fotografo::class
    ];

    /**
     * Cria um tipo de usuário de acordo com o tipo de perfil informado.
     * Os possíveis tipos retornados estão listados na constante USER_TYPES.
     *
     * @version 1.0.0
     *
     * @author Alan
     *
     * @param array $params
     *
     * @return mixed
     */
    public static function make(array $params = []) : Model
    {
        $tipo = $params['tipo'];
        
        $classeTipo = self::USER_TYPES[ucwords($tipo)];

        if (!empty($classeTipo)) {
            return new $classeTipo();
        }
        
        return new Usuario();
    }
}
