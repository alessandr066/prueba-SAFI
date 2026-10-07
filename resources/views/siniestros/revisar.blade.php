<x-app-layout>
    <div class="container mx-auto px-4 py-6">

        <h2 class="text-2xl font-bold text-ues-primary mb-6">
            Revisar Siniestros
        </h2>

        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Recurso</x-table-th>
                    <x-table-th>Tipo</x-table-th>
                    <x-table-th>Fecha</x-table-th>
                    <x-table-th>Acciones</x-table-th>
                </tr>
            </thead>

            <tbody>
                @forelse($siniestros as $siniestro)
                    <tr>
                        <x-table-td>
                            <div class="text-sm">
                                <p class="font-semibold">{{ $siniestro->recurso->codigo }}</p>
                                <p class="text-gray-600">{{ $siniestro->recurso->nombre }}</p>
                                <p class="text-xs text-gray-500">
                                    Ubicación: {{ $siniestro->recurso->ubicacion->nombre ?? 'N/A' }}
                                </p>
                            </div>
                        </x-table-td>
                        <x-table-td>{{ $siniestro->tipo }}</x-table-td>
                        <x-table-td>{{ $siniestro->fecha_siniestro }}</x-table-td>

                        <x-table-td>
                            <a href="{{ route('siniestros.revisar.show', $siniestro->id_siniestro) }}"
                                class="btn-primary">
                                Revisar
                            </a>

                            </form>
                        </x-table-td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            No hay siniestros pendientes.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>

    </div>
</x-app-layout>
