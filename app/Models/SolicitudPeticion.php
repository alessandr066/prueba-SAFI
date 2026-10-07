<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudPeticion extends Model
{
    protected $table = 'saf_solicitud_peticion';
    protected $primaryKey = 'id_solicitud';

    protected $fillable = [
        'numero',
        'fecha_peticion',
        'entidad',
        'tipo_peticion',
        'responsable',
        'descripcion',
        'estado',
        'archivo',
        'usuario_id',
        'observacion_inicial',
        'observacion_revision',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function historial()
    {
        return $this->hasMany(SolicitudHistorial::class, 'solicitud_id');
    }
}
