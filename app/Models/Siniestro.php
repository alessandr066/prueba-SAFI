<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    protected $table = 'saf_siniestro';
    protected $primaryKey = 'id_siniestro';

    protected $fillable = [
        'recurso_id',
        'usuario_id',
        'tipo',
        'fecha_siniestro',
        'descripcion',
        'estado',
        'archivo',
        'observacion_revision',
    ];

    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function historial()
    {
        return $this->hasMany(SiniestroHistorial::class, 'siniestro_id');
    }
}
