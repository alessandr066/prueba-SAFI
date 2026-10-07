<x-app-layout>
    <div class="max-w-3xl mx-auto px-6 py-8">
        <h2 class="text-2xl font-bold text-ues-primary mb-6">Detalle del Técnico</h2>

        <div class="bg-white shadow rounded-lg p-6 mb-6 grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="font-semibold text-gray-700">Nombre:</p>
                <p class="text-sm text-gray-600">{{ $tecnico->nombre }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Descripción:</p>
                <p class="text-sm text-gray-600">{{ $tecnico->descripcion ?? 'Sin descripción' }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Estado:</p>
                <p class="text-sm text-gray-600">{{ ucfirst($tecnico->estado ?? 'activo') }}</p>
            </div>
            <div>
                <p class="font-semibold text-gray-700">Creado:</p>
                <p class="text-sm text-gray-600">{{ optional($tecnico->created_at)->format('d/m/Y H:i') ?? '-' }}</p>
            </div>
        </div>

        <h3 class="text-2xl font-bold text-ues-primary mb-6">Mantenimientos asignados</h3>

        @if ($tecnico->mantenimientos->isEmpty())
            <div class="bg-gray-50 p-4 rounded text-gray-600">No hay mantenimientos para este técnico.</div>
        @else
            <div class="bg-white rounded-xl shadow overflow-x-auto mb-8">
                <table class="min-w-full text-sm border-collapse">

                    {{-- HEADER --}}
                    <thead class="bg-ues-primary text-white">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold">Fecha</th>
                            <th class="px-4 py-3 text-left font-semibold">Recurso</th>
                            <th class="px-4 py-3 text-left font-semibold">Tipo</th>
                            <th class="px-4 py-3 text-left font-semibold">Descripción</th>
                            <th class="px-4 py-3 text-left font-semibold">Estado</th>
                        </tr>
                    </thead>
                    {{-- BODY --}}
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tecnico->mantenimientos as $m)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-4 py-3 font-medium text-gray-600 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($m->fecha)->format('d/m/Y') }}
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ $m->recurso->producto->nombre ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-gray-700">
                                    {{ $m->tipoMantenimiento->nombre ?? '—' }}
                                </td>

                                <td class="px-4 py-3 text-gray-600">
                                    {{ Str::limit($m->descripcion, 80) ?? '—' }}
                                </td>

                                <td class="px-4 py-3">
                                    @php
                                        $estadoClass = match ($m->estado) {
                                            'finalizado' => 'bg-green-600',
                                            'pendiente' => 'bg-yellow-500',
                                            default => 'bg-gray-500',
                                        };
                                    @endphp

                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white rounded-full {{ $estadoClass }}">
                                        {{ ucfirst($m->estado ?? 'pendiente') }}
                                    </span>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                    Este técnico no tiene mantenimientos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        @endif
        <div class="mt-8 flex justify-between">
            {{-- Botón regresar --}}
            <a href="{{ route('tecnicos.index') }}"
                class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                ← Volver al listado
            </a>
            <a href="{{ route('tecnicos.edit', $tecnico->id_tecnico) }}"
                class="ml-2 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                Editar técnico
            </a>
        </div>

    </div>
</x-app-layout>
