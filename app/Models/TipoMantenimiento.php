<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoMantenimiento extends Model
{
    protected $table = 'saf_tipo_mantenimiento';
    protected $primaryKey = 'id_tipo_mantenimiento';
    protected $fillable = ['nombre','descripcion'];

    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'tipo_mantenimiento_id', 'id_tipo_mantenimiento');
    }
}