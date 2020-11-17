<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends User
{
    use HasFactory;

    const TABLE_NAME = 'fl_usuarios';

    protected $table = self::TABLE_NAME;

    protected $fillable = ['nome', 'sobrenome', 'email', 'senha'];

    protected $guarded = ['id', 'senha'];

    public function fotografo()
    {
        return $this->hasOne(Fotografo::class, 'id_usuario');
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class, 'id_usuario');
    }

    public function contato()
    {
        return $this->hasMany(Usuario::class, 'id_usuario');
    }

    public function fotoPerfil()
    {
        return $this->belongsTo(Imagem::class, 'id_foto_perfil');
    }

    public function setAtributos(array $atributos)
    {
        foreach($this->fillable as $fillableAtributte) {
            if (isset($atributo[$fillableAtributte])) {
                $this->$fillableAtributte = $atributo[$fillableAtributte];
            }
        }
    }

    public function temEmailUnico()
    {
     return $this->senha;
    }
}
