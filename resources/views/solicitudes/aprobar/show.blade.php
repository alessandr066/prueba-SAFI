<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">

        <h2 class="text-2xl font-semibold text-ues-primary mb-6">
            Decisión Final — {{ $solicitud->numero }}
        </h2>

        <div class="bg-white rounded-xl shadow p-6 space-y-6">
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ implode(', ', $errors->all()) }}
                </div>
            @endif

            {{-- DATOS GENERALES --}}
            <div class="grid md:grid-cols-2 gap-4 text-sm">
                <div>
                    <strong>Entidad:</strong>
                    <p>{{ $solicitud->entidad }}</p>
                </div>

                <div>
                    <strong>Tipo de solicitud:</strong>
                    <p>{{ $solicitud->tipo_peticion }}</p>
                </div>

                <div class="md:col-span-2">
                    <strong>Descripción:</strong>
                    <p class="text-gray-700">{{ $solicitud->descripcion }}</p>
                </div>
            </div>

            {{-- ARCHIVO --}}
            <div>
                <strong>Archivo adjunto:</strong>
                @if ($solicitud->archivo)
                    <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank"
                        class="text-ues-primary underline font-semibold">
                        Ver archivo
                    </a>
                @else
                    <span class="text-gray-400 italic">No adjunto</span>
                @endif
            </div>

            {{-- OBSERVACIÓN JEFE --}}
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                <strong>Observación del jefe:</strong>
                <p class="italic text-gray-700">
                    {{ $solicitud->observacion_revision ?? '—' }}
                </p>
            </div>

            {{-- FORM DECISIÓN --}}
            <form method="POST" action="{{ route('solicitudes.procesarAprobacion', $solicitud->id_solicitud) }}"
                class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold mb-1">
                        Observación del decano
                    </label>
                    <textarea name="observacion_revision" minlength="10" class="w-full border rounded px-3 py-2"
                        placeholder="Obligatoria si se rechaza">{{ old('observacion_revision') }}</textarea>
                </div>

                <div class="flex gap-4 pt-4">
                    <button name="estado" value="Rechazada"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                        Rechazar
                    </button>

                    <button name="estado" value="Aprobada"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Aprobar
                    </button>
                </div>
            </form>

            {{-- HISTORIAL --}}
            @if ($solicitud->historial->count())
                <div class="pt-6">
                    <h3 class="font-semibold text-lg text-ues-primary mb-3">
                        Historial de la solicitud
                    </h3>

                    <ul class="space-y-3 text-sm">
                        @foreach ($solicitud->historial as $h)
                            <li class="border-l-4 border-ues-primary pl-4">
                                <strong>{{ $h->estado_anterior }}</strong>
                                →
                                <strong>{{ $h->estado_nuevo }}</strong>
                                <br>
                                <span class="text-gray-600">
                                    {{ $h->created_at->format('d/m/Y H:i') }}
                                    — {{ $h->usuario->username ?? 'Sistema' }}
                                </span>
                                @if ($h->observacion)
                                    <p class="italic">“{{ $h->observacion }}”</p>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- VOLVER --}}
            <div class="pt-6">
                <a href="{{ route('solicitudes.aprobar') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
