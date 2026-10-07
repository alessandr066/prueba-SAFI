<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Listado de Técnicos</h2>

        <a href="{{ route('tecnicos.create') }}"
            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
            Nuevo Técnico
        </a>
        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Nombre</x-table-th>
                    <x-table-th>Estado</x-table-th>
                    <x-table-th class="text-center">Acciones</x-table-th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($tecnicos as $t)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Nombre --}}
                        <x-table-td class="font-medium text-gray-600">
                            {{ $t->nombre }}
                        </x-table-td>

                        {{-- Estado --}}
                        <x-table-td>
                            @php
                                $estadoClass = $t->estado === 'activo' ? 'bg-green-600' : 'bg-gray-500';
                            @endphp

                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full {{ $estadoClass }}">
                                {{ ucfirst($t->estado) }}
                            </span>
                        </x-table-td>

                        {{-- Acciones --}}
                        <x-table-td>
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('tecnicos.show', $t->id_tecnico) }}" class="btn-primary">
                                    Detalles
                                </a>

                                <a href="{{ route('tecnicos.edit', $t->id_tecnico) }}" class="btn-warning">
                                    Editar
                                </a>

                                <form action="{{ route('tecnicos.destroy', $t->id_tecnico) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar técnico?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-danger">
                                        Eliminar
                                    </button>
                                </form>

                            </div>
                        </x-table-td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-6 text-center text-gray-500">
                            No hay técnicos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>
</x-app-layout>
