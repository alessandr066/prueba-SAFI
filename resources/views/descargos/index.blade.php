<x-app-layout>
    <div class="container mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary">Historial de Descargos</h2>
        <div class="flex justify-end space-x-2 mb-4">
            <a href="{{ route('descargos.exportar.excel') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar Excel
            </a>
            <a href="{{ route('descargos.exportar.pdf') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded mb-4 inline-block">
                Exportar PDF
            </a>
        </div>
        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Fecha</x-table-th>
                    <x-table-th>Recurso</x-table-th>
                    <x-table-th>Tipo Descargo</x-table-th>
                    <x-table-th>Motivo</x-table-th>
                    <x-table-th>Detalles</x-table-th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($descargos as $descargo)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Fecha --}}
                        <x-table-td class="font-medium text-gray-600">
                            {{ \Carbon\Carbon::parse($descargo->fecha)->format('d/m/Y') }}
                        </x-table-td>

                        {{-- Recurso --}}
                        <x-table-td class="font-medium text-gray-600">
                            {{ $descargo->recurso->producto->nombre ?? '-' }}
                        </x-table-td>

                        {{-- Tipo descargo --}}
                        <x-table-td>
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">
                                {{ $descargo->tipoDescargo->nombre ?? '-' }}
                            </span>
                        </x-table-td>

                        {{-- Motivo --}}
                        <x-table-td class="text-gray-600">
                            {{ $descargo->motivo ?? '-' }}
                        </x-table-td>

                        {{-- Acciones --}}
                        <x-table-td>
                            <div>
                                <a href="{{ route('descargos.show', $descargo->id_descargo) }}"
                                    class="inline-block bg-ues-primary hover:bg-ues-secondary
                                  text-white px-3 py-1 rounded text-xs transition">
                                    ver
                                </a>
                            </div>
                        </x-table-td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                            No hay descargos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>
    </div>
</x-app-layout>
