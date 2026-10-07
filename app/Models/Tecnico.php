<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    protected $table = 'saf_tecnico';
    protected $primaryKey = 'id_tecnico';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'tecnico_id', 'id_tecnico');
    }
}
