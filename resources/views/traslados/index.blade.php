<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary">Historial de Traslados</h2>
        {{-- Filtros --}}
        <form action="{{ route('traslados.filtrar') }}" method="POST" class="mb-6 bg-gray-50 p-4 rounded-lg shadow">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end flex space-x-2">
                <div>
                    <label class="block text-sm font-medium">Desde</label>
                    <input type="date" name="fecha_inicio" value="{{ $filters['fecha_inicio'] ?? '' }}"
                        class="border border-gray-300 rounded px-2 py-1 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium">Hasta</label>
                    <input type="date" name="fecha_fin" value="{{ $filters['fecha_fin'] ?? '' }}"
                        class="border border-gray-300 rounded px-2 py-1 w-full">
                </div>
                <div>
                    <label class="block text-sm font-medium">Tipo</label>
                    <select name="tipo_traslado_id" class="border border-gray-300 rounded px-2 py-1 w-full">
                        <option value="">Todos</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id_tipo_traslado }}"
                                {{ ($filters['tipo_traslado_id'] ?? '') == $tipo->id_tipo_traslado ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex space-x-2">
                    <button type="submit"
                        class="bg-ues-primary text-white px-3 py-2 rounded hover:bg-ues-secondary">Filtrar</button>
                    <a href="{{ route('traslados.index') }}"
                        class="bg-gray-300 px-3 py-2 rounded hover:bg-gray-400">Limpiar</a>
                </div>
            </div>
        </form>

        <div class="mb-4 flex space-x-2">
            <a href="{{ route('traslados.export.excel') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar Excel
            </a>
            <a href="{{ route('traslados.export.pdf') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar PDF
            </a>
        </div>


        {{-- Tabla de resultados --}}
        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Fecha</x-table-th>
                    <x-table-th>Producto</x-table-th>
                    <x-table-th>Origen</x-table-th>
                    <x-table-th>Destino</x-table-th>
                    <x-table-th>Tipo</x-table-th>
                    <x-table-th class="text-center">Detalles</x-table-th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($traslados as $traslado)
                    <tr class="hover:bg-gray-50 transition">

                        <x-table-td class="font-medium text-gray-600 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($traslado->fecha)->format('d/m/Y') }}
                        </x-table-td>

                        <x-table-td class="text-gray-600">
                            {{ $traslado->recurso->producto->nombre ?? '-' }}
                        </x-table-td>

                        <x-table-td class="text-gray-500">
                            {{ $traslado->ubicacionOrigen->nombre ?? '-' }}
                        </x-table-td>

                        <x-table-td class="text-gray-500">
                            {{ $traslado->ubicacionDestino->nombre ?? '-' }}
                        </x-table-td>

                        <x-table-td class="text-gray-500">
                            {{ $traslado->tipoTraslado->nombre ?? '-' }}
                        </x-table-td>

                        <x-table-td>
                            <div class="flex justify-center">
                                <a href="{{ route('traslados.show', $traslado->id_traslado) }}"
                                    class="inline-block bg-ues-primary hover:bg-ues-secondary
                                  text-white px-3 py-1 rounded text-xs transition">
                                    Ver
                                </a>
                            </div>
                        </x-table-td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                            No se encontraron traslados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $traslados->links() }}
        </div>
    </div>
</x-app-layout>
