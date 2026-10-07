<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = 'saf_ubicacion';
    protected $primaryKey = 'id_ubicacion';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'ubicacion_id', 'id_ubicacion');
    }
}
