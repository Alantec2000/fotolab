<?php

namespace Database\Factories;

use App\Models\TipoPerfil;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class TipoPerfilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TipoPerfil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => Arr::random(['Cliente', 'Fotografo'])
        ];
    }

    /**
     * Define o estado como fotografo.
     *
     * @param string $nome
     *
     * @return Factory
     */
    public function cliente()
    {
        return $this->state(function (array $attributes) {
            return [
                'nome' => 'Cliente',
            ];
        });
    }

     /**
     * Define o estado como fotografo.
     *
     * @param string $nome
     *
     * @return Factory
     */
    public function fotografo()
    {
        return $this->state(function (array $attributes) {
            return [
                'nome' => 'Fotografo',
            ];
        });
    }
}
