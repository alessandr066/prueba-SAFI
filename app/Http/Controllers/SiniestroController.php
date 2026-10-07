<?php

namespace App\Http\Controllers;

use App\Models\Siniestro;
use App\Models\Recurso;
use App\Models\SiniestroHistorial;
use Illuminate\Http\Request;
use App\Services\LogActionService;

class SiniestroController extends Controller
{
    // ===============================
    // LISTADO – JEFE
    // ===============================
    public function revisar()
    {
        $siniestros = Siniestro::with('recurso')
            ->where('estado', 'Pendiente')
            ->get();

        return view('siniestros.revisar', compact('siniestros'));
    }

    // ===============================
    // LISTADO – DECANO
    // ===============================
    public function aprobar()
    {
        $siniestros = Siniestro::with('recurso')
            ->where('estado', 'En revisión decano')
            ->get();

        return view('siniestros.aprobar', compact('siniestros'));
    }

    // ===============================
    // FORM CREAR
    // ===============================
    public function create($recursoId)
    {
        $recurso = Recurso::with('ubicacion')->findOrFail($recursoId);

        return view('siniestros.create', compact('recurso'));
    }

    // ===============================
    // GUARDAR
    // ===============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recurso_id'      => 'required|exists:saf_recurso,id_recurso',
            'fecha_siniestro' => 'required|date',
            'tipo'            => 'required|in:Daño,Robo,Pérdida,Destrucción',
            'descripcion'     => 'required|string|min:10',
            'archivo'         => 'nullable|file|max:5120',
        ]);

        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')
                ->store('siniestros', 'public');
        }

        $validated['estado'] = 'Pendiente';
        $validated['usuario_id'] = auth()->user()->id_usuario;

        $siniestro = Siniestro::create($validated);

        // HISTORIAL
        SiniestroHistorial::create([
            'siniestro_id'    => $siniestro->id_siniestro,
            'usuario_id'      => auth()->user()->id_usuario,
            'estado_anterior' => null,
            'estado_nuevo'    => 'Pendiente',
            'observacion'     => 'Registro inicial del siniestro',
        ]);

        // BITÁCORA
        LogActionService::log(
            'Crear Siniestro',
            'siniestros',
            $siniestro->id_siniestro,
            null,
            $siniestro->toArray()
        );

        return redirect()->route('recursos.show', $validated['recurso_id'])
            ->with('success', 'Siniestro reportado correctamente.');
    }

    public function procesar(Request $request, $id)
    {
        $siniestro = Siniestro::with('recurso')->findOrFail($id);
        $rol = auth()->user()->rol->nombre ?? null;

        $request->validate([
            'estado' => 'required|string',
            'observacion_revision' => 'nullable|string|min:10|max:1000',
        ]);

        // ===============================
        // VALIDACIONES POR ROL
        // ===============================
        if (in_array($rol, ['Jefe UF-Facultad', 'Encargado UAF-Facultad'])) {

            if (!in_array($request->estado, ['Devuelto', 'En revisión decano'])) {
                return back()->withErrors(['error' => 'Estado no permitido.']);
            }

            if ($siniestro->estado !== 'Pendiente') {
                return back()->withErrors(['error' => 'El siniestro ya fue revisado.']);
            }
        }

        if ($rol === 'Decano Facultad') {

            if (!in_array($request->estado, ['Aprobado', 'Rechazado'])) {
                return back()->withErrors(['error' => 'Estado no permitido.']);
            }

            if ($siniestro->estado !== 'En revisión decano') {
                return back()->withErrors(['error' => 'El siniestro no está listo para aprobación.']);
            }

            if ($request->estado === 'Rechazado' && !$request->observacion_revision) {
                return back()->withErrors([
                    'observacion_revision' => 'Debe justificar el rechazo del siniestro.'
                ]);
            }
        }

        // ===============================
        // HISTORIAL
        // ===============================
        SiniestroHistorial::create([
            'siniestro_id'    => $siniestro->id_siniestro,
            'usuario_id'      => auth()->user()->id_usuario,
            'estado_anterior' => $siniestro->estado,
            'estado_nuevo'    => $request->estado,
            'observacion'     => $request->observacion_revision,
        ]);

        $before = $siniestro->toArray();

        $siniestro->update([
            'estado'               => $request->estado,
            'observacion_revision' => $request->observacion_revision,
        ]);

        // ===============================
        // IMPACTO AL RECURSO
        // ===============================
        if ($rol === 'Decano Facultad' && $request->estado === 'Aprobado') {

            $nuevoEstadoRecurso = match ($siniestro->tipo) {
                'Daño'        => 4, // En reparación
                'Robo'        => 5, // Dado de baja
                'Pérdida'     => 5,
                'Destrucción' => 5,
                default       => $siniestro->recurso->estado_id,
            };

            $siniestro->recurso->update([
                'estado_id' => $nuevoEstadoRecurso,
            ]);
        };


        // ===============================
        // BITÁCORA
        // ===============================
        LogActionService::log(
            $this->accionPorEstado($request->estado),
            'siniestros',
            $siniestro->id_siniestro,
            $before,
            $siniestro->toArray()
        );

        // ===============================
        // REDIRECCIÓN
        // ===============================
        if ($rol === 'Decano Facultad') {
            return redirect()
                ->route('siniestros.aprobar')
                ->with('success', 'Decisión del decano registrada correctamente.');
        }

        return redirect()
            ->route('siniestros.revisar')
            ->with('success', 'Siniestro revisado correctamente.');
    }


    // ===============================
    // MAPEO DE ACCIONES
    // ===============================
    private function accionPorEstado($estado)
    {
        return match ($estado) {
            'Devuelto'             => 'Devolver Siniestro',
            'En revisión decano'   => 'Enviar Siniestro al Decano',
            'Aprobado'             => 'Aprobar Siniestro',
            'Rechazado'            => 'Rechazar Siniestro',
            default                => 'Actualizar Siniestro',
        };
    }

    public function revisarShow($id)
    {
        $siniestro = Siniestro::with([
            'recurso.producto',
            'recurso.ubicacion',
            'historial.usuario'
        ])->findOrFail($id);

        // Solo se revisan pendientes
        if ($siniestro->estado !== 'Pendiente') {
            return redirect()
                ->route('siniestros.revisar')
                ->with('error', 'Este siniestro ya fue revisado.');
        }

        return view('siniestros.revisar.show', compact('siniestro'));
    }
}
