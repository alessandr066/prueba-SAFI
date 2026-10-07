<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">

        <h2 class="text-2xl font-semibold text-ues-primary mb-4">
            Revisión de Solicitud {{ $solicitud->numero }}
        </h2>

        <div class="bg-white rounded-xl shadow p-6 space-y-4">

            <p><strong>Entidad:</strong> {{ $solicitud->entidad }}</p>
            <p><strong>Tipo:</strong> {{ $solicitud->tipo_peticion }}</p>
            <p><strong>Descripción:</strong> {{ $solicitud->descripcion }}</p>
            <p><strong>Responsable:</strong> {{ $solicitud->responsable }}</p>
            @if ($solicitud->archivo)
                <p>
                    <strong>Archivo:</strong>
                    <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank"
                        class="text-ues-primary underline">
                        Ver documento
                    </a>
                </p>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('solicitudes.revisionJefe', $solicitud->id_solicitud) }}">
                @csrf
                @method('PATCH')

                <label class="block font-semibold mt-4">Observación de revisión *</label>
                <textarea name="observacion_revision" required minlength="10" class="w-full border rounded px-3 py-2">{{ old('observacion_revision') }}</textarea>

                <div class="flex gap-4 mt-6">
                    <button type="submit" name="accion" value="devolver"
                        class="bg-yellow-500 text-white px-4 py-2 rounded">
                        Devolver al creador
                    </button>

                    <button type="submit" name="accion" value="enviar_decano"
                        class="bg-blue-600 text-white px-4 py-2 rounded">
                        Enviar al decano
                    </button>

                </div>
            </form>

        </div>
    </div>
</x-app-layout>
