<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Services\LogActionService;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('profile.index', compact('user'));
    }

    public function updateUsername(Request $request)
    {
        $user = auth()->user();

        $before = [
            'username' => $user->username
        ];

        $request->validate([
            'username' => "required|string|max:50|unique:saf_usuario,username,{$user->id_usuario},id_usuario"
        ]);

        $user->update([
            'username' => $request->username
        ]);

        $after = [
            'username' => $user->username
        ];

        LogActionService::log(
            'Actualizar Usuario (Perfil)',
            'perfil',
            $user->id_usuario,
            $before,
            $after
        );

        return back()->with('success', 'Nombre de usuario actualizado correctamente.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        LogActionService::log(
            'Actualizar Contraseña',
            'perfil',
            $user->id_usuario,
            null,
            ['password_changed' => true]
        );

        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
