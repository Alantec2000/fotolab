<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static whereNome(string $ucfirst)
 */
class TipoPerfil extends Model
{
    use HasFactory;

    const TABLE_NAME = 'fl_tipo_perfil';
    const FOTOGRAFO = 'Fotografo';
    const CLIENTE = 'Cliente';

    protected $table = self::TABLE_NAME;
    public $timestamps = false;
}
