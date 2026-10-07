<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        <h2 class="text-3xl font-bold text-ues-primary mb-6">
            Solicitudes para Aprobación Final
        </h2>

        {{-- MENSAJES --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded">
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        {{-- TABLA --}}
        <div class="overflow-x-auto bg-white shadow rounded-xl border">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-ues-primary text-white uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">N°</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Entidad</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3 text-center">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse ($solicitudes as $solicitud)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3 font-semibold text-ues-primary">
                                {{ $solicitud->numero }}
                            </td>

                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($solicitud->fecha_peticion)->format('d/m/Y') }}
                            </td>

                            <td class="px-4 py-3">{{ $solicitud->entidad }}</td>

                            <td class="px-4 py-3">{{ $solicitud->tipo_peticion }}</td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('solicitudes.aprobar.show', $solicitud->id_solicitud) }}"
                                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-1 rounded text-xs shadow">
                                    Ver y decidir
                                </a>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-500 italic">
                                No hay solicitudes pendientes de aprobación.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
