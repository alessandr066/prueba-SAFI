<x-app-layout>
    <div class="container mx-auto px-4 py-8">

        {{-- ENCABEZADO --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-ues-primary">
                Solicitudes Pendientes de Revisión
            </h2>
        </div>

        {{-- MENSAJES --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded text-sm">
                {{ implode(', ', $errors->all()) }}
            </div>
        @endif

        {{-- TABLA --}}
        <div class="overflow-x-auto bg-white shadow-md rounded-xl border border-gray-200">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-ues-primary text-white uppercase tracking-wide text-xs">
                    <tr>
                        <th class="px-4 py-3">N°</th>
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Entidad</th>
                        <th class="px-4 py-3">Tipo</th>
                        <th class="px-4 py-3">Estado</th>
                        <th class="px-4 py-3">Archivo</th>
                        <th class="px-4 py-3 text-center">Acción</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 text-gray-700">
                    @forelse ($solicitudes as $solicitud)
                        <tr class="hover:bg-gray-50 transition">

                            {{-- NÚMERO --}}
                            <td class="px-4 py-3 font-semibold text-ues-primary">
                                {{ $solicitud->numero }}
                            </td>

                            {{-- FECHA --}}
                            <td class="px-4 py-3">
                                {{ \Carbon\Carbon::parse($solicitud->fecha_peticion)->format('d/m/Y') }}
                            </td>

                            {{-- ENTIDAD --}}
                            <td class="px-4 py-3">
                                {{ $solicitud->entidad }}
                            </td>

                            {{-- TIPO --}}
                            <td class="px-4 py-3">
                                {{ $solicitud->tipo_peticion }}
                            </td>

                            {{-- ESTADO --}}
                            <td class="px-4 py-3">
                                @php
                                    $badge = match ($solicitud->estado) {
                                        'Pendiente' => 'bg-yellow-200 text-yellow-800',
                                        'En revisión' => 'bg-blue-200 text-blue-800',
                                        'Aprobada' => 'bg-green-200 text-green-800',
                                        'Rechazada' => 'bg-red-200 text-red-800',
                                        default => 'bg-gray-200 text-gray-700',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                                    {{ $solicitud->estado }}
                                </span>
                            </td>

                            {{-- ARCHIVO --}}
                            <td class="px-4 py-3">
                                @if ($solicitud->archivo)
                                    <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank"
                                        class="text-ues-primary hover:underline font-semibold">
                                        Ver archivo
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Sin archivo</span>
                                @endif
                            </td>
                            {{-- ACCIÓN --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">

                                    {{-- Botón Detalles --}}
                                    <a href="{{ route('solicitudes.revisionJefe.form', $solicitud->id_solicitud) }}"
                                        class="bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                        Revisar solicitud
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-500 italic">
                                No hay solicitudes pendientes.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
