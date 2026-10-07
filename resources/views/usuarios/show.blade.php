<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Detalles del Usuario</h2>
        <div class="bg-white shadow rounded-lg p-6 space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="font-semibold text-gray-700">Nombre de Usuario</p>
                    <p class="text-sm text-gray-600">{{ $usuario->username }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Empleado Asignado</p>
                    <p class="text-sm text-gray-600">
                        {{ $usuario->empleado->nombres ?? 'No asignado' }}
                        {{ $usuario->empleado->apellidos ?? '' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Cargo</p>
                    <p class="text-sm text-gray-600">{{ $usuario->cargo->nombre ?? 'Sin cargo' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Rol del Sistema</p>
                    <p class="text-sm text-gray-600">{{ $usuario->rol->nombre ?? 'Sin rol' }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Fecha de Creación</p>
                    <p class="text-sm text-gray-600">
                        {{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '—' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="mt-8 flex justify-between">
            <a href="{{ route('usuarios.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>

            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white font-semibold px-4 py-2 rounded-md">
                Editar Usuario
            </a>
        </div>
</x-app-layout>
