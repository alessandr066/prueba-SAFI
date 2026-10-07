<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;
use App\Models\Traslado;
use App\Models\TipoTraslado;
use App\Models\Ubicacion;
use App\Exports\TrasladosExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\LogActionService;

class TrasladoController extends Controller
{
    // =======================
    // LISTADO
    // =======================
    public function index(Request $request)
    {
        $query = Traslado::with(['recurso.producto', 'tipoTraslado', 'ubicacionOrigen', 'ubicacionDestino'])
            ->orderBy('fecha', 'desc');

        if ($request->filled('codigo')) {
            $query->where('id_traslado', $request->codigo)
                ->orWhere('recurso_id', $request->codigo);
        }

        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        if ($request->filled('tipo_traslado_id')) {
            $query->where('tipo_traslado_id', $request->tipo_traslado_id);
        }

        $traslados = $query->paginate(10)->appends($request->all());
        $tipos = TipoTraslado::orderBy('nombre')->get();

        return view('traslados.index', compact('traslados', 'tipos'));
    }

    // =======================
    // FORMULARIO CREAR
    // =======================
    public function create($recurso_id)
    {
        $recurso = Recurso::with(['producto', 'estado', 'ubicacion', 'empleado'])
            ->findOrFail($recurso_id);

        $tipos = TipoTraslado::orderBy('nombre')->get();
        $ubicaciones = Ubicacion::where('id_ubicacion', '!=', $recurso->ubicacion_id)->get();

        return view('traslados.create', compact('recurso', 'tipos', 'ubicaciones'));
    }

    // =======================
    // GUARDAR TRASLADO
    // =======================
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'recurso_id'           => 'required|exists:saf_recurso,id_recurso',
                'tipo_traslado_id'     => 'required|exists:saf_tipo_traslado,id_tipo_traslado',
                'ubicacion_destino_id' => 'required|exists:saf_ubicacion,id_ubicacion',
                'fecha'                => 'required|date',
                'descripcion'          => 'nullable|string'
            ]);

            $recurso = Recurso::findOrFail($validated['recurso_id']);

            if ((int)$validated['ubicacion_destino_id'] === (int)$recurso->ubicacion_id) {
                return back()->withErrors([
                    'ubicacion_destino_id' => 'La ubicación de destino no puede ser la misma que la actual.'
                ])->withInput();
            }

            $ultimoTraslado = Traslado::where('recurso_id', $recurso->id_recurso)
                ->orderByDesc('fecha')
                ->first();

            if ($ultimoTraslado && $validated['fecha'] < $ultimoTraslado->fecha) {
                return back()->withErrors([
                    'fecha' => 'La fecha del traslado no puede ser anterior al último traslado registrado (' . $ultimoTraslado->fecha . ').'
                ])->withInput();
            }

            // BEFORE
            $before = $recurso->toArray();

            // Crear traslado
            $traslado = Traslado::create([
                'recurso_id'            => $recurso->id_recurso,
                'tipo_traslado_id'      => $validated['tipo_traslado_id'],
                'fecha'                 => $validated['fecha'],
                'ubicacion_origen_id'   => $recurso->ubicacion_id,
                'ubicacion_destino_id'  => $validated['ubicacion_destino_id'],
                'descripcion'           => $validated['descripcion'] ?? null,
            ]);

            // Actualizar RECURSO
            $recurso->update(['ubicacion_id' => $validated['ubicacion_destino_id']]);

            // AFTER
            $after = [
                'traslado' => $traslado->toArray(),
                'recurso'  => $recurso->fresh()->toArray()
            ];

            // BITÁCORA — CREAR TRASLADO
            LogActionService::log(
                'Crear Traslado',
                'traslados',
                $traslado->id_traslado,
                $before,
                $after
            );

            return redirect()->route('inventario.index')
                ->with('success', 'Traslado registrado con éxito.');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }

    // =======================
    // DETALLE DE TRASLADO
    // =======================
    public function show($id)
    {
        $traslado = Traslado::with([
            'recurso.producto',
            'recurso.empleado',
            'tipoTraslado',
            'ubicacionOrigen',
            'ubicacionDestino'
        ])->findOrFail($id);

        return view('traslados.show', compact('traslado'));
    }

    // =======================
    // EXPORTAR EXCEL
    // =======================
    public function exportExcel()
    {
        $count = Traslado::count();

        return Excel::download(new TrasladosExport, 'traslados.xlsx');
    }

    // =======================
    // EXPORTAR PDF
    // =======================
    public function exportPdf()
    {
        $traslados = Traslado::with(['recurso.producto', 'tipoTraslado', 'ubicacionOrigen', 'ubicacionDestino'])->get();

        $pdf = Pdf::loadView('traslados.export-pdf', compact('traslados'));

        return $pdf->download('traslados.pdf');
    }
}
