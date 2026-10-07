<x-app-layout>
    <div class="container mx-auto px-4 py-6">

        <h2 class="text-2xl font-bold text-ues-primary mb-6">
            Aprobación de Siniestros
        </h2>

        <x-table>
            <thead class="bg-ues-primary">
                <tr>
                    <x-table-th>Recurso</x-table-th>
                    <x-table-th>Detalle del Siniestro</x-table-th>
                    <x-table-th>Revisión del Jefe</x-table-th>
                    <x-table-th>Decisión del Decano</x-table-th>
                </tr>
            </thead>

            <tbody>
                @forelse($siniestros as $siniestro)
                    <tr class="align-top">

                        {{-- RECURSO --}}
                        <x-table-td class="font-semibold">
                            <div class="text-sm">
                                <p class="font-semibold">{{ $siniestro->recurso->codigo }}</p>
                                <p class="text-gray-600">{{ $siniestro->recurso->nombre }}</p>
                                <p class="text-xs text-gray-500">
                                    Ubicación: {{ $siniestro->recurso->ubicacion->nombre ?? 'N/A' }}
                                </p>
                            </div>

                        </x-table-td>

                        {{-- DETALLE --}}
                        <x-table-td class="text-sm">
                            <p><strong>Tipo:</strong> {{ $siniestro->tipo }}</p>
                            <p><strong>Fecha:</strong> {{ $siniestro->fecha_siniestro }}</p>
                            <p class="mt-1 text-gray-600">
                                {{ $siniestro->descripcion }}
                            </p>

                            @if ($siniestro->archivo)
                                <a href="{{ asset('storage/' . $siniestro->archivo) }}" target="_blank"
                                    class="text-blue-600 underline text-xs mt-1 inline-block">
                                    Ver archivo adjunto
                                </a>
                            @endif
                        </x-table-td>

                        {{-- OBSERVACIÓN JEFE --}}
                        <x-table-td class="italic text-sm text-gray-700">
                            {{ $siniestro->observacion_revision }}
                        </x-table-td>

                        {{-- DECISIÓN --}}
                        <x-table-td>
                            <form method="POST" action="{{ route('siniestros.procesar', $siniestro->id_siniestro) }}">
                                @csrf
                                @method('PATCH')

                                <textarea name="observacion_revision" class="w-full border rounded px-2 py-1 text-xs"
                                    placeholder="Observación (obligatoria solo si rechaza)"></textarea>

                                <div class="flex gap-2 mt-2">
                                    <button name="estado" value="Rechazado"
                                        onclick="return confirm('¿Seguro que desea RECHAZAR este siniestro?')"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">
                                        Rechazar
                                    </button>

                                    <button name="estado" value="Aprobado"
                                        onclick="return confirm('¿Confirmar aprobación del siniestro?')"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                        Aprobar
                                    </button>
                                </div>
                            </form>
                        </x-table-td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">
                            No hay siniestros para aprobar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>

    </div>
</x-app-layout>
