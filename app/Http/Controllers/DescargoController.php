<?php

namespace App\Http\Controllers;

use App\Models\Descargo;
use App\Models\Recurso;
use App\Models\TipoDescargo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DescargosExport;
use App\Services\LogActionService;

class DescargoController extends Controller
{
    // Listado de descargos
    public function index()
    {
        $descargos = Descargo::with(['recurso.producto', 'tipoDescargo'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('descargos.index', compact('descargos'));
    }

    // Formulario para crear un nuevo descargo
    public function create($recurso_id = null)
    {
        if ($recurso_id) {
            $recurso = Recurso::with('producto')->findOrFail($recurso_id);
            $tiposDescargo = TipoDescargo::orderBy('nombre')->get();

            return view('descargos.create', compact('recurso', 'tiposDescargo'));
        }

        $recursos = Recurso::with('producto')->get();
        $tiposDescargo = TipoDescargo::orderBy('nombre')->get();

        return view('descargos.create', compact('recursos', 'tiposDescargo'));
    }

    // Guardar un descargo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'recurso_id'        => 'required|exists:saf_recurso,id_recurso',
            'tipo_descargo_id'  => 'required|exists:saf_tipo_descargo,id_tipo_descargo',
            'fecha'             => 'required|date',
            'motivo'            => 'required|string|max:255',
            'observaciones'     => 'nullable|string'
        ]);

        // Crear descargo
        $descargo = Descargo::create($validated);

        // BITÁCORA — CREAR DESCARGO
        LogActionService::log(
            'Crear Descargo',
            'descargos',
            $descargo->id_descargo,
            null,
            $descargo->toArray()
        );

        // Cambio de estado del recurso
        $recurso = $descargo->recurso;
        $before = $recurso->toArray();

        $recurso->update(['estado_id' => 5]); // Dado de baja

        $after = $recurso->fresh()->toArray();

        // BITÁCORA — Actualizar Estado Recurso
        LogActionService::log(
            'Actualizar Estado Recurso',
            'recursos',
            $recurso->id_recurso,
            $before,
            $after
        );

        return redirect()->route('descargos.index')
            ->with('success', 'Descargo registrado con éxito.');
    }

    // Ver detalle de descargo
    public function show($id)
    {
        $descargo = Descargo::with(['recurso.producto', 'tipoDescargo'])
            ->findOrFail($id);

        return view('descargos.show', compact('descargo'));
    }

    // Eliminar descargo
    public function destroy($id)
    {
        $descargo = Descargo::findOrFail($id);

        $before = $descargo->toArray();

        $descargo->delete();

        // BITÁCORA — ELIMINAR DESCARGO
        LogActionService::log(
            'Eliminar Descargo',
            'descargos',
            $id,
            $before,
            null
        );

        return redirect()->route('descargos.index')
            ->with('success', 'Descargo eliminado correctamente.');
    }

    // Exportar Excel
    public function exportarExcel()
    {
        return Excel::download(new DescargosExport, 'Historial_Descargos.xlsx');
    }

    // Exportar PDF
    public function exportarPDF()
    {
        $descargos = Descargo::with(['recurso.producto', 'tipoDescargo'])
            ->orderBy('fecha', 'desc')
            ->get();

        $pdf = Pdf::loadView('descargos.exportar-pdf', compact('descargos'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('Historial_Descargos.pdf');
    }
}
