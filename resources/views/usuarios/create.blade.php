<x-app-layout>
    <div class="max-w-2xl mx-auto px-6 py-8 bg-white rounded-xl shadow">
        <h2 class="text-2xl font-semibold text-ues-primary mb-6">Registrar Nuevo Usuario</h2>

        <form method="POST" action="{{ route('usuarios.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Empleado</label>
                <select name="empleado_id" required class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">Seleccione un empleado</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id_empleado }}">{{ $empleado->nombres }} {{ $empleado->apellidos }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Rol</label>
                <select name="rol_id" required class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">Seleccione un rol</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}">{{ $rol->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Cargo</label>
                <select name="cargo_id" required class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">Seleccione un cargo</option>
                    @foreach ($cargos as $cargo)
                        <option value="{{ $cargo->id_cargo }}">{{ $cargo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Nombre de usuario</label>
                <input type="text" name="username" class="border border-gray-300 rounded px-3 py-2 w-full" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" class="border border-gray-300 rounded px-3 py-2 w-full" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation"
                    class="border border-gray-300 rounded px-3 py-2 w-full" required>
            </div>
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('usuarios.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded">
                    Guardar Usuario
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
