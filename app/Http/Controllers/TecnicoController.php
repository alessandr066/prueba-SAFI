<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;
use App\Services\LogActionService;

class TecnicoController extends Controller
{
    // LISTADO
    public function index()
    {
        $tecnicos = Tecnico::all();

        return view('tecnicos.index', compact('tecnicos'));
    }

    // FORMULARIO CREAR
    public function create()
    {
        return view('tecnicos.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string'
        ]);

        $tecnico = Tecnico::create($validated);

        LogActionService::log(
            'Crear Técnico',
            'tecnicos',
            $tecnico->id_tecnico,
            null,
            $tecnico->toArray()
        );

        return redirect()->route('tecnicos.index')
            ->with('success', 'Técnico registrado correctamente.');
    }

    // DETALLE
    public function show($id)
    {
        $tecnico = Tecnico::with(['mantenimientos.recurso.producto', 'mantenimientos.tipoMantenimiento'])
            ->findOrFail($id);

        return view('tecnicos.show', compact('tecnico'));
    }


    // FORMULARIO EDITAR
    public function edit($id)
    {
        $tecnico = Tecnico::findOrFail($id);

        return view('tecnicos.edit', compact('tecnico'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|string'
        ]);

        $tecnico = Tecnico::findOrFail($id);
        $before = $tecnico->toArray();

        $tecnico->update($validated);
        $after = $tecnico->toArray();

        LogActionService::log(
            'Editar Técnico',
            'tecnicos',
            $id,
            $before,
            $after
        );

        return redirect()->route('tecnicos.index')
            ->with('success', 'Técnico actualizado correctamente.');
    }

    // ELIMINAR
    public function destroy($id)
    {
        $tecnico = Tecnico::findOrFail($id);

        if ($tecnico->mantenimientos()->exists()) {
            return back()->with('error', 'No puedes eliminar este técnico, está asignado a mantenimientos.');
        }

        $before = $tecnico->toArray();
        $tecnico->delete();

        LogActionService::log(
            'Eliminar Técnico',
            'tecnicos',
            $id,
            $before,
            null
        );

        return redirect()->route('tecnicos.index')
            ->with('success', 'Técnico eliminado correctamente.');
    }
}
