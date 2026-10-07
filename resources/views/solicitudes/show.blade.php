<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">

        <h2 class="text-2xl font-semibold text-ues-primary mb-6">
            Detalle de Solicitud
        </h2>

        <div class="bg-white rounded-xl shadow p-6 space-y-4">

            <div class="grid md:grid-cols-2 gap-4">

                <div>
                    <p class="font-semibold text-gray-700">Número</p>
                    <p class="text-sm text-gray-600">{{ $solicitud->numero }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Entidad</p>
                    <p class="text-sm text-gray-600">{{ $solicitud->entidad }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Tipo de solicitud</p>
                    <p class="text-sm text-gray-600">{{ $solicitud->tipo_peticion }}</p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Estado</p>
                    @php
                        $badge = match ($solicitud->estado) {
                            'Pendiente' => ' text-sm bg-yellow-500',
                            'En revisión' => 'text-sm bg-blue-600',
                            'Aprobada' => 'text-sm bg-green-600',
                            'Rechazada' => ' text-sm bg-red-600',
                            default => 'text-sm bg-gray-500',
                        };
                    @endphp

                    <span class="inline-block text-white px-3 py-1 rounded-full text-xs {{ $badge }}">
                        {{ $solicitud->estado }}
                    </span>
                </div>

                <div class="md:col-span-2">
                    <p class="font-semibold text-gray-700">Descripción</p>
                    <p class="text-sm text-gray-600">
                        {{ $solicitud->descripcion ?? '—' }}
                    </p>
                </div>

                <div>
                    <p class="font-semibold text-gray-700">Archivo adjunto</p>
                    @if ($solicitud->archivo)
                        <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank"
                            class="text-ues-primary hover:underline font-semibold text-sm">
                            Ver archivo
                        </a>
                    @else
                        <span class="text-gray-400 italic text-sm">No adjunto</span>
                    @endif
                </div>
                <div>
                    @if ($solicitud->observacion_inicial)
                        <p><strong>Observación inicial:</strong> {{ $solicitud->observacion_inicial }}</p>
                    @endif

                    @if ($solicitud->observacion_revision)
                        <p><strong>Observación de revisión:</strong> {{ $solicitud->observacion_revision }}</p>
                    @endif
                </div>
                @if ($solicitud->estado === 'Devuelta')
                    <div class="bg-yellow-100 border-l-4 border-yellow-500 p-3">
                        <strong>Devuelta por revisión:</strong><br>
                        {{ $solicitud->observacion_revision }}
                    </div>
                @endif


            </div>
            @if ($solicitud->historial->count())
                <div class="mt-6">
                    <h3 class="font-semibold text-lg mb-3 text-ues-primary">
                        Historial de la solicitud
                    </h3>

                    <ul class="space-y-3 text-sm">
                        @foreach ($solicitud->historial as $h)
                            <li class="border-l-4 border-ues-primary pl-4">
                                <p>
                                    <strong>{{ $h->estado_anterior }}</strong>
                                    →
                                    <strong>{{ $h->estado_nuevo }}</strong>
                                </p>

                                <p class="text-gray-600">
                                    {{ $h->created_at->format('d/m/Y H:i') }}
                                    — {{ $h->usuario->username ?? 'Sistema' }}
                                </p>

                                @if ($h->observacion)
                                    <p class="italic text-gray-700">
                                        “{{ $h->observacion }}”
                                    </p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- Botones --}}
            <div class="pt-6 flex justify-between">
                @php
                    $userRole = auth()->user()->rol->nombre ?? null;
                    $destino = in_array($userRole, ['Jefe UF-Facultad', 'Encargado UAF-Facultad'])
                        ? route('solicitudes.revisar')
                        : route('solicitudes.index');
                @endphp

                <a href="{{ $destino }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
