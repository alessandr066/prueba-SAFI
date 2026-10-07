<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiniestroHistorial extends Model
{
    protected $table = 'saf_siniestro_historial';

    protected $fillable = [
        'siniestro_id',
        'usuario_id',
        'estado_anterior',
        'estado_nuevo',
        'observacion',
    ];

    public function siniestro()
    {
        return $this->belongsTo(Siniestro::class, 'siniestro_id', 'id_siniestro');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
