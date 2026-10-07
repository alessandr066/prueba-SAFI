<?php

namespace App\Services;

use App\Models\Bitacora;
use App\Models\Accion;
use Illuminate\Support\Facades\Auth;

class LogActionService
{
    public static function log($accionNombre, $modulo, $registroId = null, $before = null, $after = null)
    {
        // Buscar la acción por su nombre y obtener su ID
        $accion = Accion::where('nombre', $accionNombre)->first();

        // Si no existe, evitar crash y registrar como desconocida
        $accionId = $accion->id_accion ?? null;

        Bitacora::create([
            'usuario_id'       => Auth::user()->id_usuario,
            'accion_id'        => $accionId,
            'modulo'           => $modulo,
            'registro_id'      => $registroId,
            'datos_anteriores' => $before ? json_encode($before) : null,
            'datos_nuevos'     => $after ? json_encode($after) : null,
            'ip'               => request()->ip(),
        ]);
    }
}
