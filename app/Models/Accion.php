<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'saf_accion';
    protected $primaryKey = 'id_accion';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'accion_id', 'id_accion');
    }
}
