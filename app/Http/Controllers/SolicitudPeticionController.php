<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudPeticion;
use App\Services\LogActionService;
use App\Models\SolicitudHistorial;

class SolicitudPeticionController extends Controller
{
    /** LISTA DEL REPRESENTANTE */
    public function index()
    {
        $solicitudes = SolicitudPeticion::where('usuario_id', auth()->user()->id_usuario)
            ->orderByDesc('id_solicitud')
            ->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    /** CREAR */
    public function create()
    {
        if (auth()->user()->rol->nombre !== 'Representante Unidad/Escuela') {
            abort(403, 'No tienes permiso para crear solicitudes.');
        }

        $ultimo = SolicitudPeticion::orderByDesc('id_solicitud')->first();
        $siguienteNumero = $ultimo ? $ultimo->id_solicitud + 1 : 1;

        return view('solicitudes.create', compact('siguienteNumero'));
    }

    public function show($id)
    {
        $solicitud = SolicitudPeticion::findOrFail($id);
        return view('solicitudes.show', compact('solicitud'));
    }

    /** GUARDAR */
    public function store(Request $request)
    {
        $request->validate([
            'fecha_peticion'       => 'required|date',
            'entidad'              => 'required|string|max:255',
            'tipo_peticion'        => 'required|string|max:255',
            'responsable'          => 'required|string|max:255',
            'descripcion'          => 'required|string',
            'archivo'              => 'nullable|file|max:5120',
            'observacion_inicial'  => 'nullable|string|max:1000',
        ]);

        $ultimo = SolicitudPeticion::orderByDesc('id_solicitud')->first();
        $numero = $ultimo
            ? 'SOL-' . str_pad($ultimo->id_solicitud + 1, 4, '0', STR_PAD_LEFT)
            : 'SOL-0001';

        $data = $request->only([
            'fecha_peticion',
            'entidad',
            'tipo_peticion',
            'responsable',
            'descripcion',
            'observacion_inicial',
        ]);

        $data['numero']     = $numero;
        $data['usuario_id'] = auth()->user()->id_usuario;
        $data['estado']     = 'Pendiente';

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('solicitudes', 'public');
        }

        $solicitud = SolicitudPeticion::create($data);

        LogActionService::log(
            'Crear Solicitud',
            'solicitudes',
            $solicitud->id_solicitud,
            null,
            $solicitud->toArray()
        );

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud registrada correctamente.');
    }

    /** REVISAR */
    public function revisar()
    {
        $solicitudes = SolicitudPeticion::where('estado', 'Pendiente')
            ->orderByDesc('id_solicitud')
            ->get();

        return view('solicitudes.revisar', compact('solicitudes'));
    }


    /** APROBAR */
    public function aprobar()
    {
        $solicitudes = SolicitudPeticion::where('estado', 'En revisión decano')
            ->orderByDesc('id_solicitud')
            ->get();

        return view('solicitudes.aprobar', compact('solicitudes'));
    }

    /** CAMBIO DE ESTADO — DECANO */
    public function procesarAprobacion(Request $request, $id)
    {
        $usuario   = auth()->user();
        $rol       = $usuario->rol->nombre ?? null;
        $solicitud = SolicitudPeticion::findOrFail($id);

        // SOLO DECANO
        if ($rol !== 'Decano Facultad') {
            abort(403);
        }

        // VALIDACIÓN
        $request->validate([
            'estado' => 'required|in:Aprobada,Rechazada',
            'observacion_revision' => 'nullable|string|max:1000',
        ]);

        // Si rechaza → observación obligatoria
        if ($request->estado === 'Rechazada' && !$request->observacion_revision) {
            return back()->withErrors([
                'observacion_revision' => 'Debe ingresar una observación al rechazar.'
            ])->withInput();
        }

        // Solo puede decidir si viene de revisión decano
        if ($solicitud->estado !== 'En revisión decano') {
            return back()->withErrors([
                'error' => 'La solicitud aún no está lista para decisión final.'
            ]);
        }

        $before = $solicitud->toArray();

        // HISTORIAL
        SolicitudHistorial::create([
            'solicitud_id'     => $solicitud->id_solicitud,
            'usuario_id'       => $usuario->id_usuario,
            'estado_anterior'  => $solicitud->estado,
            'estado_nuevo'     => $request->estado,
            'observacion'      => $request->observacion_revision,
        ]);

        // ACTUALIZAR
        $solicitud->update([
            'estado' => $request->estado,
            'observacion_revision' => $request->observacion_revision,
        ]);

        LogActionService::log(
            'Decisión Decano',
            'solicitudes',
            $solicitud->id_solicitud,
            $before,
            $solicitud->toArray()
        );

        return redirect()
            ->route('solicitudes.aprobar')
            ->with('success', 'Decisión registrada correctamente.');
    }

    private function accionPorEstado($estado)
    {
        return match ($estado) {
            'En revisión'        => 'Marcar en Revisión',
            'Devuelta'           => 'Solicitud Devuelta',
            'En revisión decano' => 'Envío a Decano',
            'Aprobada'           => 'Aprobar Solicitud',
            'Rechazada'          => 'Rechazar Solicitud',
        };
    }

    public function edit($id)
    {
        $solicitud = SolicitudPeticion::findOrFail($id);

        if (
            $solicitud->usuario_id !== auth()->user()->id_usuario ||
            !in_array($solicitud->estado, ['Pendiente', 'Devuelta'])
        ) {
            abort(403, 'No puedes editar esta solicitud.');
        }

        return view('solicitudes.edit', compact('solicitud'));
    }

    public function revisionJefe(Request $request, $id)
    {
        $request->validate([
            'accion' => 'required|in:devolver,enviar_decano',
            'observacion_revision' => 'required|string|min:10|max:1000',
        ]);

        $solicitud = SolicitudPeticion::findOrFail($id);
        $before = $solicitud->toArray();

        $solicitud->update([
            'estado' => $request->accion === 'devolver'
                ? 'Devuelta'
                : 'En revisión decano',
            'observacion_revision' => $request->observacion_revision,
        ]);

        LogActionService::log(
            'Revisión Jefe',
            'solicitudes',
            $id,
            $before,
            $solicitud->toArray()
        );

        return redirect()
            ->route('solicitudes.revisar')
            ->with('success', 'Solicitud enviada correctamente al decano.');
    }

    public function update(Request $request, $id)
    {
        $solicitud = SolicitudPeticion::findOrFail($id);

        if (
            $solicitud->usuario_id !== auth()->user()->id_usuario ||
            !in_array($solicitud->estado, ['Pendiente', 'Devuelta'])
        ) {
            abort(403);
        }

        $request->validate([
            'entidad'       => 'required|string|max:255',
            'tipo_peticion' => 'required|string|max:255',
            'responsable'   => 'required|string|max:255',
            'descripcion'   => 'required|string',
            'archivo'       => 'nullable|file|max:5120',
        ]);

        $before = $solicitud->toArray();

        $data = $request->only([
            'entidad',
            'tipo_peticion',
            'responsable',
            'descripcion',
        ]);

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('solicitudes', 'public');
        }

        // Si estaba devuelta, vuelve al flujo
        if ($solicitud->estado === 'Devuelta') {
            $data['estado'] = 'Pendiente';
        }

        $solicitud->update($data);

        LogActionService::log(
            'Editar Solicitud',
            'solicitudes',
            $id,
            $before,
            $solicitud->toArray()
        );

        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitud actualizada y reenviada.');
    }

    public function mostrarRevisionJefe($id)
    {
        $solicitud = SolicitudPeticion::findOrFail($id);

        // Seguridad: solo pendientes
        if ($solicitud->estado !== 'Pendiente') {
            return back()->with('error', 'Esta solicitud ya fue revisada.');
        }

        return view('solicitudes.revisar.show', compact('solicitud'));
    }

    public function aprobarShow($id)
    {
        $solicitud = SolicitudPeticion::with(['historial.usuario'])
            ->where('estado', 'En revisión decano')
            ->findOrFail($id);

        return view('solicitudes.aprobar.show', compact('solicitud'));
    }
}
