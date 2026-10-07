<?php

namespace App\Http\Controllers;

use App\Models\Recurso;
use App\Models\Producto;
use App\Models\Estado;
use App\Models\Ubicacion;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\LogActionService;

class RecursoController extends Controller
{
    // ========================
    // LISTADO GENERAL
    // ========================
    public function index()
    {
        $recursos = Recurso::with(['producto', 'estado', 'ubicacion', 'empleado'])->get();

        return view('recursos.index', compact('recursos'));
    }

    // ========================
    // FORMULARIO CREAR
    // ========================
    public function create()
    {

        $productos  = Producto::all();
        $estados    = Estado::all();
        $ubicaciones = Ubicacion::all();
        $empleados   = Empleado::all();

        return view('recursos.create', compact('productos', 'estados', 'ubicaciones', 'empleados'));
    }

    // ========================
    // GUARDAR
    // ========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo'            => 'required|string|unique:saf_recurso,codigo',
            'nombre'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string',
            'fecha_ingreso'     => 'required|date',

            'producto_id'       => 'required|exists:saf_producto,id_producto',
            'estado_id'         => 'required|exists:saf_estado,id_estado',
            'ubicacion_id'      => 'required|exists:saf_ubicacion,id_ubicacion',
            'empleado_asignado' => 'nullable|exists:saf_empleado,id_empleado',

            'fecha_adquisicion' => 'required|date',
            'valor_recurso'     => 'required|numeric|min:0',
        ]);

        $recurso = Recurso::create($validated);

        // BITÁCORA — CREAR
        LogActionService::log(
            'Crear Recurso',
            'recursos',
            $recurso->id_recurso,
            null,
            $recurso->toArray()
        );

        return redirect()->route('recursos.index')->with('success', 'Recurso registrado con éxito.');
    }

    // ========================
    // VER DETALLE
    // ========================
    public function show($id)
    {
        $recurso = Recurso::with([
            'producto',
            'estado',
            'ubicacion',
            'empleado',
            'mantenimientos.tecnico',
            'mantenimientos.tipoMantenimiento'
        ])->findOrFail($id);

        return view('recursos.show', compact('recurso'));
    }

    // ========================
    // FORMULARIO EDITAR
    // ========================
    public function edit($id)
    {
        $recurso = Recurso::findOrFail($id);

        if ($recurso->estado_id == 5) {
            return back()->with('error', 'No se puede editar un recurso dado de baja.');
        }

        $productos = Producto::all();
        $estados = Estado::all();
        $ubicaciones = Ubicacion::all();
        $empleados = Empleado::all();

        return view('recursos.edit', compact('recurso', 'productos', 'estados', 'ubicaciones', 'empleados'));
    }


    // ========================
    // ACTUALIZAR
    // ========================
    public function update(Request $request, $id)
    {
        $recurso = Recurso::findOrFail($id);

        if ($recurso->estado_id == 5) {
            return back()->with('error', 'No se puede actualizar un recurso dado de baja.');
        }

        $validated = $request->validate([
            'codigo'            => 'required|string|unique:saf_recurso,codigo',
            'nombre'            => 'required|string|max:255',
            'descripcion'       => 'nullable|string',
            'fecha_ingreso'     => 'required|date',

            'producto_id'       => 'required|exists:saf_producto,id_producto',
            'estado_id'         => 'required|exists:saf_estado,id_estado',
            'ubicacion_id'      => 'required|exists:saf_ubicacion,id_ubicacion',
            'empleado_asignado' => 'nullable|exists:saf_empleado,id_empleado',

            'fecha_adquisicion' => 'required|date',
            'valor_recurso'     => 'required|numeric|min:0',
        ]);


        $before = $recurso->toArray();
        $recurso->update($validated);
        $after = $recurso->toArray();

        LogActionService::log('Editar Recurso', 'recursos', $id, $before, $after);

        return redirect()->route('recursos.index')->with('success', 'Recurso actualizado con éxito.');
    }


    // ========================
    // ELIMINAR
    // ========================
    public function destroy($id)
    {
        $recurso = Recurso::findOrFail($id);

        // BLOQUEO si está dado de baja
        if ($recurso->estado_id == 5) {
            return back()->with('error', 'No se puede eliminar un recurso que está dado de baja.');
        }

        $before = $recurso->toArray();
        $recurso->delete();

        LogActionService::log(
            'Eliminar Recurso',
            'recursos',
            $id,
            $before,
            null
        );

        return redirect()->route('recursos.index')
            ->with('success', 'Recurso eliminado con éxito.');
    }

    // ========================
    // EXPORTAR PDF
    // ========================
    public function exportarPDF()
    {
        $recursos = Recurso::with(['producto', 'estado', 'ubicacion', 'empleado'])->get();

        // BITÁCORA — EXPORTAR PDF
        LogActionService::log(
            'Exportar PDF',
            'recursos',
            null,
            null,
            ['total_exportado' => $recursos->count()]
        );

        $pdf = Pdf::loadView('reportes.recursos.pdf', compact('recursos'))
            ->setPaper('a4', 'landscape');

        return $pdf->stream('reporte_recursos.pdf');
    }
}
