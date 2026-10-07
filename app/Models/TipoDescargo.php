<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDescargo extends Model
{
    use HasFactory;

    protected $table = 'saf_tipo_descargo';
    protected $primaryKey = 'id_tipo_descargo';
    protected $fillable = ['nombre', 'descripcion'];
}
