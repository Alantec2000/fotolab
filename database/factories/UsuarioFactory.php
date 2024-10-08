<?php

namespace Database\Factories;

use App\Models\Imagem;
use App\Models\TipoPerfil;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UsuarioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Usuario::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->firstName(),
            'sobrenome' => $this->faker->lastName(),
            'tipo_perfil_id' => TipoPerfil::factory(),
            'email' => $this->faker->email(),
            'senha' => $this->faker->password(8, 15),
            'data_nascimento' => $this->faker->date('Y-m-d'),
            'url_foto_perfil' => null,
            'url_foto_capa' => null,
            'descricao' => $this->faker->sentence()
        ];
    }

    public function fotografo()
    {
        return $this->state(function (array $attributes) {
            return [
                'tipo_perfil_id' => TipoPerfil::factory()->fotografo(),
            ];
        });
    }

    public function cliente()
    {
        return $this->state(function (array $attributes) {
            return [
                'tipo_perfil_id' => TipoPerfil::factory()->cliente(),
            ];
        });
    }
}
