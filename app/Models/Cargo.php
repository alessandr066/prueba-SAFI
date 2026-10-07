<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'saf_cargo';
    protected $primaryKey = 'id_cargo';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    // Relación: un cargo puede tener muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'cargo_id', 'id_cargo');
    }
}
