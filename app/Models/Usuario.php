<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'saf_usuario';

    protected $primaryKey = 'id_usuario';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'empleado_id',
        'rol_id',
        'username',
        'password',
        'cargo_id',
    ];

    protected $hidden = ['password'];

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id_rol');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id_empleado');
    }

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class, 'usuario_id', 'id_usuario');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id', 'id_cargo');
    }
}
