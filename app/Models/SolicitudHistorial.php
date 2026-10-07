<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudHistorial extends Model
{
    protected $table = 'saf_solicitud_historial';

    protected $fillable = [
        'solicitud_id',
        'usuario_id',
        'estado_anterior',
        'estado_nuevo',
        'observacion',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
