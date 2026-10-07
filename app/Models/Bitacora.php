<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'saf_bitacora';
    protected $primaryKey = 'id_bitacora';
    protected $dates = ['fecha'];
    public $timestamps = false;

    protected $fillable = [
        'usuario_id',
        'accion_id',
        'modulo',
        'registro_id',
        'datos_anteriores',
        'datos_nuevos',
        'ip'
    ];

    protected $casts = [
        'datos_anteriores' => 'array',
        'datos_nuevos' => 'array'
    ];

    // Relación con Usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id_usuario');
    }

    // Relación con Accion
    public function accion()
    {
        return $this->belongsTo(Accion::class, 'accion_id', 'id_accion');
    }
}
