<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Gestión de Usuarios</h2>

        <a href="{{ route('usuarios.create') }}"
            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
            Nuevo Usuario
        </a>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-ues-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">Empleado</th>
                        <th class="px-4 py-3 text-left font-semibold">Usuario</th>
                        <th class="px-4 py-3 text-left font-semibold">Rol</th>
                        <th class="px-4 py-3 text-left font-semibold">Cargo</th>
                        <th class="px-4 py-3 text-center font-semibold">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($usuarios as $usuario)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 text-gray-700 font-medium">
                                {{ $usuario->empleado->nombres ?? '—' }}
                            </td>

                            <td class="px-4 py-3 text-gray-700">
                                {{ $usuario->username }}
                            </td>

                            <td class="px-4 py-3">
                                <span
                                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                            bg-blue-100 text-blue-700">
                                    {{ $usuario->rol->nombre ?? 'Sin rol' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $usuario->cargo->nombre ?? '—' }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('usuarios.show', $usuario->id_usuario) }}"
                                        class="bg-ues-primary hover:bg-ues-secondary
                                      text-white px-3 py-1 rounded text-xs transition">
                                        Ver
                                    </a>

                                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}"
                                        class="bg-yellow-500 hover:bg-yellow-600
                                      text-white px-3 py-1 rounded text-xs transition">
                                        Editar
                                    </a>

                                    <form action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST"
                                        class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Eliminar usuario?')"
                                            class="bg-red-600 hover:bg-red-700
                                               text-white px-3 py-1 rounded text-xs transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
