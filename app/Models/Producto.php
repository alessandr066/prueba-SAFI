<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'saf_producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion'];

    public function recursos()
    {
        return $this->hasMany(Recurso::class, 'producto_id', 'id_producto');
    }
}
