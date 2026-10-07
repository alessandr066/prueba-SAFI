<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow mt-6">
        <h2 class="text-xl font-bold mb-4">
            {{ isset($usuario) ? 'Editar Usuario' : 'Registrar Usuario' }}
        </h2>

        <form method="POST"
            action="{{ isset($usuario) ? route('usuarios.update', $usuario->id_usuario) : route('usuarios.store') }}">
            @csrf
            @if (isset($usuario))
                @method('PUT')
            @endif

            {{-- Empleado --}}
            <div class="mb-3">
                <label class="block font-medium">Empleado</label>
                <select name="empleado_id" class="border rounded w-full p-2">
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id_empleado }}"
                            {{ old('empleado_id', $usuario->empleado_id ?? '') == $empleado->id_empleado ? 'selected' : '' }}>
                            {{ $empleado->nombres }} {{ $empleado->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Rol --}}
            <div class="mb-3">
                <label class="block font-medium">Rol</label>
                <select name="rol_id" class="border rounded w-full p-2">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}"
                            {{ old('rol_id', $usuario->rol_id ?? '') == $rol->id_rol ? 'selected' : '' }}>
                            {{ $rol->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Cargo --}}
            <div class="mb-3">
                <label class="block font-medium">Cargo</label>
                <select name="cargo_id" class="border rounded w-full p-2">
                    @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->id_cargo }}"
                            {{ old('cargo_id', $usuario->cargo_id ?? '') == $cargo->id_cargo ? 'selected' : '' }}>
                            {{ $cargo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Usuario --}}
            <div class="mb-3">
                <label class="block font-medium">Nombre de usuario</label>
                <input type="text" name="username" class="border rounded w-full p-2"
                    value="{{ old('username', $usuario->username ?? '') }}">
            </div>

            {{-- Contraseña --}}
            <div class="mb-3">
                <label class="block font-medium">Contraseña</label>
                <input type="password" name="password" class="border rounded w-full p-2">
            </div>

            <div class="mb-3">
                <label class="block font-medium">Confirmar contraseña</label>
                <input type="password" name="password_confirmation" class="border rounded w-full p-2">
            </div>
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('usuarios.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded">
                    {{ isset($usuario) ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
