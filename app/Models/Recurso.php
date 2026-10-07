<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurso extends Model
{
    protected $table = 'saf_recurso';
    protected $primaryKey = 'id_recurso';
    public $timestamps = false;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'fecha_ingreso',
        'producto_id',
        'estado_id',
        'ubicacion_id',
        'empleado_asignado',
        'fecha_adquisicion',
        'valor_recurso'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function estado()
    {
        return $this->belongsTo(Estado::class, 'estado_id', 'id_estado');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_asignado');
    }

    public function traslados()
    {
        return $this->hasMany(Traslado::class, 'recurso_id', 'id_recurso');
    }

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'recurso_id', 'id_recurso');
    }

    public function siniestros()
    {
        return $this->hasMany(Siniestro::class, 'recurso_id');
    }
}
