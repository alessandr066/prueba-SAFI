<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Empleado;
use App\Models\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\LogActionService;

class UsuarioController extends Controller
{
    // ==========================
    // LISTADO DE USUARIOS
    // ==========================
    public function index(Request $request)
    {
        $usuarios = Usuario::with(['rol', 'empleado'])
            ->orderBy('id_usuario', 'desc')
            ->get();

        return view('usuarios.index', compact('usuarios'));
    }

    // ==========================
    // FORMULARIO CREAR
    // ==========================
    public function create()
    {
        $roles = Rol::all();
        $empleados = Empleado::all();
        $cargos = Cargo::all();

        return view('usuarios.create', compact('roles', 'empleados', 'cargos'));
    }

    // ==========================
    // GUARDAR USUARIO
    // ==========================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'empleado_id' => 'required|exists:saf_empleado,id_empleado',
            'rol_id'      => 'required|exists:saf_rol,id_rol',
            'cargo_id'    => 'required|exists:saf_cargo,id_cargo',
            'username'    => 'required|string|max:50|unique:saf_usuario,username',
            'password'    => 'required|string|min:6|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $usuario = Usuario::create($validated);

        // BITÁCORA: CREAR USUARIO
        LogActionService::log(
            'Crear Usuario',
            'usuarios',
            $usuario->id_usuario,
            null,
            $usuario->toArray()
        );

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    // ==========================
    // FORMULARIO EDITAR
    // ==========================
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        $roles = Rol::all();
        $empleados = Empleado::all();
        $cargos = Cargo::all();

        return view('usuarios.edit', compact('usuario', 'roles', 'empleados', 'cargos'));
    }

    // ==========================
    // ACTUALIZAR USUARIO
    // ==========================
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $before = $usuario->toArray();

        $validated = $request->validate([
            'empleado_id' => 'required|exists:saf_empleado,id_empleado',
            'rol_id'      => 'required|exists:saf_rol,id_rol',
            'cargo_id'    => 'required|exists:saf_cargo,id_cargo',
            'username'    => 'required|string|max:50|unique:saf_usuario,username,' . $usuario->id_usuario . ',id_usuario',
            'password'    => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $usuario->update($validated);

        $after = $usuario->toArray();

        // BITÁCORA — EDITAR USUARIO
        LogActionService::log(
            'Editar Usuario',
            'usuarios',
            $id,
            $before,
            $after
        );

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    // ==========================
    // ELIMINAR USUARIO
    // ==========================
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        $before = $usuario->toArray();

        $usuario->delete();

        // BITÁCORA — ELIMINAR USUARIO
        LogActionService::log(
            'Eliminar Usuario',
            'usuarios',
            $id,
            $before,
            null
        );

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

    // ==========================
    // DETALLE DE USUARIO
    // ==========================
    public function show($id)
    {
        $usuario = Usuario::with(['empleado', 'rol', 'cargo'])->findOrFail($id);

        return view('usuarios.show', compact('usuario'));
    }
}
