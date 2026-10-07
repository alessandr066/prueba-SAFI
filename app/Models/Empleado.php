<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'saf_empleado';
    protected $primaryKey = 'id_empleado';
    public $timestamps = false;

    protected $fillable = [
        'nombres',
        'apellidos',
        'cargo_id',
        'estado_id',
        'fecha_ingreso'
    ];

    public function recursosAsignados()
    {
        return $this->hasMany(Recurso::class, 'empleado_asignado', 'id_empleado');
    }
}
