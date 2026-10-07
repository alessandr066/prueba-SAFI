<x-app-layout>
    <div class="max-w-6xl mx-auto px-6 py-8">

        {{-- Encabezado --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-ues-primary">
                Mis Solicitudes
            </h2>

            @role('Representante Unidad/Escuela')
                <a href="{{ route('solicitudes.create') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded text-sm shadow transition">
                    + Nueva Solicitud
                </a>
            @endrole
        </div>

        {{-- Tabla --}}
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full border-collapse text-sm">
                <thead class="bg-ues-primary text-white">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold">N°</th>
                        <th class="px-4 py-3 text-left font-semibold">Entidad</th>
                        <th class="px-4 py-3 text-left font-semibold">Tipo</th>
                        <th class="px-4 py-3 text-left font-semibold">Estado</th>
                        <th class="px-4 py-3 text-left font-semibold">Archivo</th>
                        <th class="px-4 py-3 text-center font-semibold">Acciones</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse ($solicitudes as $s)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-4 py-3 font-medium text-gray-700">
                                {{ $s->numero }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $s->entidad }}
                            </td>

                            <td class="px-4 py-3 text-gray-600">
                                {{ $s->tipo_peticion }}
                            </td>

                            {{-- Estado --}}
                            <td class="px-4 py-3">
                                @php
                                    $badge = match ($s->estado) {
                                        'Pendiente' => 'bg-yellow-500',
                                        'En revisión' => 'bg-blue-600',
                                        'Aprobada' => 'bg-green-600',
                                        'Rechazada' => 'bg-red-600',
                                        default => 'bg-gray-500',
                                    };
                                @endphp

                                <span class="text-white px-3 py-1 rounded-full text-xs {{ $badge }}">
                                    {{ $s->estado }}
                                </span>
                            </td>

                            {{-- Archivo --}}
                            <td class="px-4 py-3">
                                @if ($s->archivo)
                                    <a href="{{ asset('storage/' . $s->archivo) }}" target="_blank"
                                        class="text-ues-primary hover:underline font-semibold text-xs">
                                        Ver archivo
                                    </a>
                                @else
                                    <span class="text-gray-400 italic text-xs">Sin archivo</span>
                                @endif
                            </td>

                            {{-- Acciones --}}
                            <td class="px-4 py-3 text-center space-x-2">

                                <a href="{{ route('solicitudes.show', $s->id_solicitud) }}"
                                    class="bg-ues-primary hover:bg-ues-secondary text-white px-3 py-1 rounded text-xs">
                                    Detalles
                                </a>

                                @role('Jefe UF-Facultad,Encargado UAF-Facultad')
                                    <a href="{{ route('solicitudes.revisar') }}"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">
                                        Revisar
                                    </a>
                                @endrole

                                @role('Decano Facultad')
                                    <a href="{{ route('solicitudes.aprobar') }}"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs">
                                        Aprobar
                                    </a>
                                @endrole

                                @if (in_array($s->estado, ['Pendiente', 'Devuelta']))
                                    <a href="{{ route('solicitudes.edit', $s->id_solicitud) }}"
                                        class="bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                        Editar
                                    </a>
                                @endif

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">
                                No hay solicitudes registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>
