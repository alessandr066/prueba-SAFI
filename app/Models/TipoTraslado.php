<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoTraslado extends Model
{
    protected $table = 'saf_tipo_traslado';
    protected $primaryKey = 'id_tipo_traslado';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function traslados()
    {
        return $this->hasMany(Traslado::class, 'tipo_traslado_id', 'id_tipo_traslado');
    }
}
