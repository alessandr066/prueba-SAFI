<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'saf_estado';
    protected $primaryKey = 'id_estado';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'estado_id', 'id_estado');
    }
}
