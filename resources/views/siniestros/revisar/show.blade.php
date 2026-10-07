<x-app-layout>
    <div class="container mx-auto px-6 py-6">

        <h2 class="text-xl font-bold mb-4 text-ues-primary">
            Revisión de Siniestro
        </h2>

        {{-- DATOS DEL RECURSO --}}
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Recurso:</strong> {{ $siniestro->recurso->codigo }}</p>
            <p><strong>Producto:</strong> {{ $siniestro->recurso->producto->nombre }}</p>
            <p><strong>Ubicación:</strong> {{ $siniestro->recurso->ubicacion->nombre }}</p>
        </div>

        {{-- DATOS DEL SINIESTRO --}}
        <div class="bg-white p-4 rounded shadow mb-4">
            <p><strong>Tipo:</strong> {{ $siniestro->tipo }}</p>
            <p><strong>Fecha:</strong> {{ $siniestro->fecha_siniestro }}</p>
            <p class="mt-2"><strong>Descripción:</strong></p>
            <p class="text-gray-700">{{ $siniestro->descripcion }}</p>

            @if ($siniestro->archivo)
                <a href="{{ asset('storage/' . $siniestro->archivo) }}" class="text-blue-600 underline mt-2 inline-block"
                    target="_blank">
                    Ver archivo adjunto
                </a>
            @endif
        </div>

        {{-- FORMULARIO DE DECISIÓN --}}
        <form method="POST" action="{{ route('siniestros.procesar', $siniestro->id_siniestro) }}">
            @csrf
            @method('PATCH')

            <textarea name="observacion_revision" required minlength="10" class="w-full border rounded p-2 mb-3"
                placeholder="Observación de la revisión"></textarea>

            <div class="flex gap-3">
                <button name="estado" value="Devuelto" class="bg-yellow-500 text-white px-4 py-2 rounded">
                    Devolver
                </button>

                <button name="estado" value="En revisión decano" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Enviar al Decano
                </button>
            </div>
        </form>

        {{-- HISTORIAL --}}
        @if ($siniestro->historial->count())
            <div class="mt-6">
                <h3 class="font-semibold mb-2">Historial</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    @foreach ($siniestro->historial as $h)
                        <li>
                            {{ $h->created_at }} –
                            {{ $h->estado_nuevo }} –
                            {{ $h->usuario->name ?? 'Sistema' }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>
</x-app-layout>
