<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Services\LogActionService;

class ProductoController extends Controller
{
    // ======================
    // LISTADO
    // ======================
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // ======================
    // FORMULARIO CREAR
    // ======================
    public function create()
    {
        return view('productos.create');
    }

    // ======================
    // GUARDAR
    // ======================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::create($validated);

        LogActionService::log(
            'Crear Producto',
            'productos',
            $producto->id_producto,
            null,
            $producto->toArray()
        );

        return redirect()->route('productos.index')
            ->with('success', 'Producto registrado con éxito.');
    }

    // ======================
    // DETALLE
    // ======================
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    // ======================
    // FORMULARIO EDITAR
    // ======================
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // ======================
    // ACTUALIZAR
    // ======================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $producto = Producto::findOrFail($id);

        $before = $producto->toArray();

        $producto->update($validated);

        LogActionService::log(
            'Editar Producto',
            'productos',
            $producto->id_producto,
            $before,
            $producto->toArray()
        );

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado con éxito.');
    }

    // ======================
    // ELIMINAR
    // ======================
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        $before = $producto->toArray();

        $producto->delete();

        LogActionService::log(
            'Eliminar Producto',
            'productos',
            $producto->id_producto,
            $before,
            null
        );

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado con éxito.');
    }
}
