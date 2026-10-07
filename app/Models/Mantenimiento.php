<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    protected $table = 'saf_mantenimiento';
    protected $primaryKey = 'id_mantenimiento';
    protected $fillable = [
        'recurso_id',
        'tipo_mantenimiento_id',
        'tecnico_id',
        'descripcion',
        'fecha',
        'estado',
        'fecha_fin'
    ];

    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id', 'id_recurso');
    }

    public function tipoMantenimiento()
    {
        return $this->belongsTo(TipoMantenimiento::class, 'tipo_mantenimiento_id', 'id_tipo_mantenimiento');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'tecnico_id', 'id_tecnico');
    }
}
