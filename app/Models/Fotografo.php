<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static find()
 * @method static findOrFail(int $fotografo)
 */
class Fotografo extends Usuario
{
    use HasFactory;

    const TABLE_NAME = 'fl_usuarios';

    protected $table = self::TABLE_NAME;

    public function fotoCapa()
    {
        return $this->belongsTo(Imagem::class, 'id_foto_capa', 'id');
    }
}
