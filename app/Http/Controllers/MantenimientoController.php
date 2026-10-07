<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mantenimiento;
use App\Models\Recurso;
use App\Models\TipoMantenimiento;
use App\Models\Tecnico;
use App\Exports\MantenimientosExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\LogActionService;

class MantenimientoController extends Controller
{
    // Listado general
    public function index()
    {
        $mantenimientos = Mantenimiento::with(['recurso.producto', 'tipoMantenimiento', 'tecnico'])
            ->orderBy('fecha', 'desc')
            ->paginate(10);

        return view('mantenimientos.index', compact('mantenimientos'));
    }

    // Formulario crear
    public function create()
    {
        $recursos = Recurso::with('producto')
            ->where('estado_id', '!=', 5) //excluir descargos
            ->get();

        $tipos = TipoMantenimiento::all();
        $tecnicos = Tecnico::all();

        return view('mantenimientos.create', compact('recursos', 'tipos', 'tecnicos'));
    }

    // Guardar
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recurso_id'            => 'required|exists:saf_recurso,id_recurso',
            'tipo_mantenimiento_id' => 'required|exists:saf_tipo_mantenimiento,id_tipo_mantenimiento',
            'tecnico_id'            => 'required|exists:saf_tecnico,id_tecnico',
            'fecha'                 => 'required|date',
            'descripcion'           => 'nullable|string',
            'estado'                => 'nullable|string',
            'fecha_fin'             => 'nullable|date',
        ]);

        // BEFORE
        $before = null;
        $recurso = Recurso::findOrFail($validated['recurso_id']);

        if ($recurso->estado_id == 5) {
            return back()->withErrors([
                'recurso_id' => 'No se puede registrar mantenimiento a un recurso dado de baja.'
            ])->withInput();
        }

        // Crear mantenimiento
        $mantenimiento = Mantenimiento::create($validated);
        // ===============================
        // CAMBIO AUTOMÁTICO DE ESTADO DEL RECURSO
        // SOLO SI EL MANTENIMIENTO ES CORRECTIVO
        // ===============================

        $recurso = $mantenimiento->recurso;

        if ($recurso && $mantenimiento->tipo_mantenimiento_id == 2) {

            // Guardar valores antes del cambio
            $before = $recurso->toArray();

            // Cambiar estado a "En reparación" (ID = 4)
            $recurso->update([
                'estado_id' => 4
            ]);

            // Guardar valores después
            $after = $recurso->fresh()->toArray();
        }
        // BITÁCORA — CREAR
        LogActionService::log(
            'Crear Mantenimiento',
            'mantenimientos',
            $mantenimiento->id_mantenimiento,
            null,
            $mantenimiento->toArray()
        );

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento registrado con éxito.');
    }

    // Ver detalle
    public function show($id)
    {
        $mantenimiento = Mantenimiento::with([
            'recurso.producto',
            'tipoMantenimiento',
            'tecnico'
        ])->findOrFail($id);

        return view('mantenimientos.show', compact('mantenimiento'));
    }

    // Formulario editar
    public function edit($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);
        $recursos = Recurso::with('producto')->get();
        $tipos = TipoMantenimiento::all();
        $tecnicos = Tecnico::all();

        return view('mantenimientos.edit', compact('mantenimiento', 'recursos', 'tipos', 'tecnicos'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        $validated = $request->validate([
            'recurso_id'            => 'required|exists:saf_recurso,id_recurso',
            'tipo_mantenimiento_id' => 'required|exists:saf_tipo_mantenimiento,id_tipo_mantenimiento',
            'tecnico_id'            => 'required|exists:saf_tecnico,id_tecnico',
            'fecha'                 => 'required|date',
            'descripcion'           => 'nullable|string',
        ]);

        // BEFORE
        $before = $mantenimiento->toArray();

        // Actualizar
        $mantenimiento->update($validated);

        // AFTER
        $after = $mantenimiento->fresh()->toArray();

        // BITÁCORA — EDITAR
        LogActionService::log(
            'Editar Mantenimiento',
            'mantenimientos',
            $id,
            $before,
            $after
        );


        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento actualizado con éxito.');
    }

    // Eliminar mantenimiento
    public function destroy($id)
    {
        $mantenimiento = Mantenimiento::findOrFail($id);

        // BEFORE
        $before = $mantenimiento->toArray();

        $mantenimiento->delete();

        // BITÁCORA — ELIMINAR
        LogActionService::log(
            'Eliminar Mantenimiento',
            'mantenimientos',
            $id,
            $before,
            null
        );

        return redirect()->route('mantenimientos.index')
            ->with('success', 'Mantenimiento eliminado.');
    }

    // Exportar PDF
    public function exportarPDF(Request $request)
    {
        $mantenimientos = $this->filtrarMantenimientos($request);

        $pdf = Pdf::loadView('mantenimientos.reportes.pdf', compact('mantenimientos'))
            ->setPaper('a4', 'landscape')
            ->setOptions([
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true
            ]);

        LogActionService::log(
            'Exportar PDF',
            'mantenimientos',
            null,
            null,
            ['total_exportado' => $mantenimientos->count()]
        );

        return $pdf->download('reporte_mantenimientos.pdf');
    }

    // Exportar Excel
    public function exportarExcel(Request $request)
    {
        LogActionService::log(
            'Exportar Excel',
            'mantenimientos',
            null,
            null,
            ['filtros' => $request->all()]
        );

        return Excel::download(new MantenimientosExport($request), 'reporte_mantenimientos.xlsx');
    }

    // Filtros compartidos
    private function filtrarMantenimientos($request)
    {
        $query = Mantenimiento::with(['recurso.producto', 'tipoMantenimiento', 'tecnico'])
            ->orderBy('fecha', 'desc');

        if ($request->filled('tipo_mantenimiento_id')) {
            $query->where('tipo_mantenimiento_id', $request->tipo_mantenimiento_id);
        }

        if ($request->filled('tecnico_id')) {
            $query->where('tecnico_id', $request->tecnico_id);
        }

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }

        return $query->get();
    }

    public function finalizar($id)
    {
        $mantenimiento = Mantenimiento::with(['recurso'])->findOrFail($id);

        // Evitar doble finalización
        if ($mantenimiento->estado === 'finalizado') {
            return back()->with('info', 'Este mantenimiento ya se encuentra finalizado.');
        }

        $recurso = $mantenimiento->recurso;

        // Antes del cambio
        $before = $recurso->toArray();

        // Marcar mantenimiento como finalizado
        $mantenimiento->update([
            'estado' => 'finalizado',
            'fecha_fin' => now()
        ]);

        // Cambiar estado del recurso solo si es CORRECTIVO (tipo 2)
        if ($mantenimiento->tipo_mantenimiento_id == 2) {
            $recurso->update([
                'estado_id' => 3 // Bueno
            ]);
        }

        // Después del cambio
        $after = $recurso->fresh()->toArray();

        // Registrar bitácora
        LogActionService::log(
            'Finalizar Mantenimiento',
            'mantenimientos',
            $mantenimiento->id_mantenimiento,
            $before,
            $after
        );

        return redirect()
            ->route('mantenimientos.show', $id)
            ->with('success', 'Mantenimiento finalizado correctamente.');
    }
}
