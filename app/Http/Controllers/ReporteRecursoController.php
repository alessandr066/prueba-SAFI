<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recurso;
use App\Models\Estado;
use App\Models\Ubicacion;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\LogActionService;

class ReporteRecursoController extends Controller
{
    // ==================================================
    // VISTA PRINCIPAL DEL REPORTE
    // ==================================================
    public function index(Request $request)
    {
        $query = Recurso::with(['producto', 'estado', 'ubicacion', 'empleado']);

        // ---- Filtros ----
        if ($request->filled('estado_id')) {
            $query->where('estado_id', $request->estado_id);
        }

        if ($request->filled('ubicacion_id')) {
            $query->where('ubicacion_id', $request->ubicacion_id);
        }

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha_adquisicion', [$request->fecha_inicio, $request->fecha_fin]);
        }

        if ($request->filled('valor_min') && $request->filled('valor_max')) {
            $query->whereBetween('valor_recurso', [$request->valor_min, $request->valor_max]);
        }

        $recursos = $query->orderBy('fecha_adquisicion', 'desc')->paginate(10);

        $estados = Estado::all();
        $ubicaciones = Ubicacion::all();

        return view('reportes.recursos.index', compact('recursos', 'estados', 'ubicaciones'));
    }

    // ==================================================
    // EXPORTAR EXCEL
    // ==================================================
    public function exportExcel(Request $request)
    {
        $recursos = Recurso::with(['producto', 'estado', 'ubicacion'])->get();

        return Excel::download(
            new \App\Exports\RecursosExport($recursos),
            'reporte_recursos.xlsx'
        );
    }

    // ==================================================
    // EXPORTAR PDF
    // ==================================================
    public function exportPDF()
    {
        $recursos = Recurso::with(['producto', 'estado', 'ubicacion'])->get();

        $pdf = Pdf::loadView('reportes.recursos.pdf', compact('recursos'))
            ->setPaper('A4', 'landscape');

        return $pdf->download('reporte_recursos.pdf');
    }
}
