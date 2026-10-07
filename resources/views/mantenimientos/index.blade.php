<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Historial de Mantenimientos</h2>

        <a href="{{ route('mantenimientos.create') }}"
            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
            Nuevo Mantenimiento
        </a>
        <div class="flex space-x-2 mb-4">
            <a href="{{ route('mantenimientos.exportar.pdf') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar PDF
            </a>
            <a href="{{ route('mantenimientos.exportar.excel') }}"
                class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar Excel
            </a>
        </div>
        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Fecha</x-table-th>
                    <x-table-th>Recurso</x-table-th>
                    <x-table-th>Tipo</x-table-th>
                    <x-table-th>Técnico</x-table-th>
                    <x-table-th>Descripción</x-table-th>
                    <x-table-th>Estado</x-table-th>
                    <x-table-th class="text-center">Acciones</x-table-th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($mantenimientos as $m)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Fecha --}}
                        <x-table-td class="whitespace-nowrap font-medium text-gray-600">
                            {{ \Carbon\Carbon::parse($m->fecha)->format('d/m/Y') }}
                        </x-table-td>

                        {{-- Recurso --}}
                        <x-table-td class="text-gray-600">
                            {{ $m->recurso->producto->nombre ?? '-' }}
                        </x-table-td>

                        {{-- Tipo --}}
                        <x-table-td class="text-gray-500">
                            {{ $m->tipoMantenimiento->nombre ?? '-' }}
                        </x-table-td>

                        {{-- Técnico --}}
                        <x-table-td class="text-gray-500">
                            {{ $m->tecnico->nombre ?? '-' }}
                        </x-table-td>

                        {{-- Descripción --}}
                        <x-table-td class="text-gray-500 max-w-xs truncate">
                            {{ $m->descripcion ?? '-' }}
                        </x-table-td>

                        {{-- Estado --}}
                        <x-table-td>
                            @php
                                $badgeClass = match ($m->estado) {
                                    'finalizado' => 'bg-green-600',
                                    'pendiente' => 'bg-yellow-500',
                                    default => 'bg-gray-500',
                                };
                            @endphp

                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full {{ $badgeClass }}">
                                {{ ucfirst($m->estado ?? 'pendiente') }}
                            </span>
                        </x-table-td>

                        {{-- Acciones --}}
                        <x-table-td>
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('mantenimientos.show', $m->id_mantenimiento) }}" class="btn-primary">
                                    Detalles
                                </a>

                                <a href="{{ route('mantenimientos.edit', $m->id_mantenimiento) }}" class="btn-warning">
                                    Editar
                                </a>

                                <form action="{{ route('mantenimientos.destroy', $m->id_mantenimiento) }}"
                                    method="POST" onsubmit="return confirm('¿Eliminar este registro?')">
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
                        <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                            No hay registros de mantenimiento.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
        <div class="mt-4">
            {{ $mantenimientos->links() }}
        </div>
    </div>
</x-app-layout>
