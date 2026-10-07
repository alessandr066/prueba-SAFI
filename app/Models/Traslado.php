<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traslado extends Model
{
    protected $table = 'saf_traslado';
    protected $primaryKey = 'id_traslado';

    protected $fillable = [
        'recurso_id',
        'tipo_traslado_id',
        'fecha',
        'ubicacion_origen_id',
        'ubicacion_destino_id',
        'descripcion'
    ];

    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id', 'id_recurso');
    }

    public function ubicacionOrigen()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_origen_id', 'id_ubicacion');
    }

    public function ubicacionDestino()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_destino_id', 'id_ubicacion');
    }

    public function tipoTraslado()
    {
        return $this->belongsTo(TipoTraslado::class, 'tipo_traslado_id', 'id_tipo_traslado');
    }
}
