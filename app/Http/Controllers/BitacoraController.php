<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Exports\BitacoraExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BitacoraController extends Controller
{
    // ============================================
    // LISTADO + FILTROS
    // ============================================
    public function index(Request $request)
    {
        $request->validate([
            'fecha'         => 'nullable|date',
            'fecha_inicio'  => 'nullable|date',
            'fecha_fin'     => 'nullable|date|after_or_equal:fecha_inicio',
            'accion_id'     => 'nullable|integer',
            'usuario'       => 'nullable|string|max:255'
        ]);

        $query = Bitacora::with(['usuario', 'accion'])
            ->orderBy('fecha', 'desc');

        // ----- Filtro: Usuario
        if ($request->filled('usuario')) {
            $query->whereHas('usuario', function ($q) use ($request) {
                $q->where('username', 'like', '%' . $request->usuario . '%');
            });
        }

        // ----- Filtro: Acción
        if ($request->filled('accion_id')) {
            $query->where('accion_id', $request->accion_id);
        }

        // ----- Filtro: Módulo
        if ($request->filled('modulo')) {
            $query->where('modulo', $request->modulo);
        }

        // ----- Filtro: Fecha exacta
        if ($request->filled('fecha')) {
            $query->whereDate('fecha', $request->fecha);
        }

        // ----- Filtro: Rango de fechas
        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }

        $bitacoras = $query->paginate(10)->appends($request->all());

        return view('bitacora.index', compact('bitacoras'));
    }

    // ============================================
    // MOSTRAR DETALLE
    // ============================================
    public function show($id)
    {
        $bitacora = Bitacora::with(['usuario', 'accion'])->findOrFail($id);
        return view('bitacora.show', compact('bitacora'));
    }

    // ============================================
    // EXPORTAR A EXCEL
    // ============================================
    public function exportExcel(Request $request)
    {
        return Excel::download(new BitacoraExport($request), 'bitacora.xlsx');
    }

    // ============================================
    // EXPORTAR A PDF
    // ============================================
    public function exportPdf(Request $request)
    {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', '300');

        $query = Bitacora::with(['usuario', 'accion'])
            ->orderBy('fecha', 'desc');

        if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
            $query->whereBetween('fecha', [$request->fecha_inicio, $request->fecha_fin]);
        }

        if ($request->filled('accion_id')) {
            $query->where('accion_id', $request->accion_id);
        }

        $registros = $query->get();

        $pdf = Pdf::loadView('bitacora.pdf', compact('registros'));

        return $pdf->download('bitacora.pdf');
    }
}
