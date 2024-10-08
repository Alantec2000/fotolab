<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastrarUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'bail|required|email',
            'senha' => 'bail|required|string|between:8,15',
            'nome' => 'bail|required|string|regex:/([A-ú. ªº]+)/i|max:20',
            'sobrenome' => 'bail|required|string|max:100',
            'data_nascimento' => 'bail|required|date_format:Y-m-d',
            'foto_perfil' => 'sometimes|nullable|file|max:4000|mimes:png,jpg,jpeg',
            'foto_capa' => 'sometimes|nullable|file|max:4000|mimes:png,jpg,jpeg',
            'tipo' => 'required|string|exists:App\Models\TipoPerfil,nome'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return trans('CadastroUsuario');
    }
}
