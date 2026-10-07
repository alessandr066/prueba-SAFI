<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-ues-primary">Inventario de Recursos</h2>

        </div>
        @role('Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad')
            <div class="mt-8 flex justify-between">
                <a href="{{ route('inventario.create') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
                    Registrar Recurso
                </a>
                <!-- Botón Exportar PDF -->
                <a href="{{ route('inventario.exportarPDF') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
                    Exportar PDF
                </a>
            </div>
        @endrole

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Producto</x-table-th>
                    <x-table-th>Estado</x-table-th>
                    <x-table-th>Ubicación</x-table-th>
                    <x-table-th>Asignado</x-table-th>
                    <x-table-th class="text-center">Acciones</x-table-th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($recursos as $recurso)
                    <tr class="hover:bg-gray-50 transition">

                        <x-table-td class="font-semibold text-gray-600">
                            {{ $recurso->producto->nombre ?? '-' }}
                        </x-table-td>

                        <x-table-td>
                            <span class="px-2 py-1 text-xs rounded bg-gray-100">
                                {{ $recurso->estado->nombre ?? '-' }}
                            </span>
                        </x-table-td>

                        <x-table-td>
                            {{ $recurso->ubicacion->nombre ?? '-' }}
                        </x-table-td>

                        <x-table-td>
                            {{ $recurso->empleado ? $recurso->empleado->nombres . ' ' . $recurso->empleado->apellidos : 'No asignado' }}
                        </x-table-td>

                        <x-table-td>
                            <div class="flex flex-wrap gap-1">

                                {{-- TODOS pueden ver detalles --}}
                                <a href="{{ route('inventario.show', $recurso->id_recurso) }}" class="btn-primary">
                                    Detalles
                                </a>

                                {{-- SOLO roles administrativos --}}
                                @role('Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad')
                                    @if ($recurso->estado_id != 5)
                                        <a href="{{ route('inventario.edit', $recurso->id_recurso) }}" class="btn-warning">
                                            Editar
                                        </a>

                                        <a href="{{ route('traslados.create.recurso', $recurso->id_recurso) }}"
                                            class="btn-purple">
                                            Trasladar
                                        </a>

                                        <form action="{{ route('inventario.destroy', $recurso->id_recurso) }}"
                                            method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn-danger"
                                                onclick="return confirm('¿Eliminar este recurso?')">
                                                Eliminar
                                            </button>
                                        </form>

                                        <a href="{{ route('descargos.create', $recurso->id_recurso) }}"
                                            class="btn-danger-dark">
                                            Descargo
                                        </a>
                                    @else
                                        <span class="text-xs italic text-gray-400">
                                            Dado de baja
                                        </span>
                                    @endif
                                @endrole

                                {{-- SOLO REPRESENTANTE --}}
                                @role('Representante Unidad/Escuela')
                                    @if ($recurso->estado_id != 5)
                                        <a href="{{ route('siniestros.create', $recurso->id_recurso) }}"
                                            class="btn-danger">
                                            Reportar siniestro
                                        </a>
                                    @endif
                                @endrole

                            </div>
                        </x-table-td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                            No hay recursos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>

    </div>
</x-app-layout>
