<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'saf_area';
    protected $primaryKey = 'id_area';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'tipo_area_id', 'ubicacion_id'];

    public function trasladosOrigen()
    {
        return $this->hasMany(Traslado::class, 'area_origen_id', 'id_area');
    }

    public function trasladosDestino()
    {
        return $this->hasMany(Traslado::class, 'area_destino_id', 'id_area');
    }
}
