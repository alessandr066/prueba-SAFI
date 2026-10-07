<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descargo extends Model
{
    protected $table = 'saf_descargo';
    protected $primaryKey = 'id_descargo';

    protected $fillable = [
        'recurso_id',
        'tipo_descargo_id',
        'fecha',
        'motivo',
        'observaciones'
    ];

    public function recurso()
    {
        return $this->belongsTo(Recurso::class, 'recurso_id', 'id_recurso');
    }

    public function tipoDescargo()
    {
        return $this->belongsTo(TipoDescargo::class, 'tipo_descargo_id', 'id_tipo_descargo');
    }
}
