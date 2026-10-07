<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">

        <div class="bg-white rounded-xl shadow border border-gray-200">

            {{-- Encabezado --}}
            <div class="bg-ues-primary text-white px-6 py-4 rounded-t-xl">
                <h2 class="text-xl font-semibold">Registrar Nueva Solicitud</h2>
            </div>

            <div class="p-6">

                {{-- Mensajes --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Número --}}
                <p class="text-sm text-gray-600 mb-4">
                    Número de solicitud:
                    <span class="font-semibold text-ues-primary">
                        SOL-{{ str_pad($siguienteNumero, 4, '0', STR_PAD_LEFT) }}
                    </span>
                </p>

                <form method="POST" action="{{ route('solicitudes.store') }}" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    @foreach ([
        'fecha_peticion' => 'Fecha de petición',
        'entidad' => 'Entidad',
        'tipo_peticion' => 'Tipo de petición',
        'responsable' => 'Responsable',
    ] as $name => $label)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
                            <input type="{{ $name === 'fecha_peticion' ? 'date' : 'text' }}" name="{{ $name }}"
                                value="{{ old($name) }}" required
                                class="w-full border rounded-lg px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">
                        </div>
                    @endforeach

                    {{-- Descripción --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">{{ old('descripcion') }}</textarea>
                    </div>

                    {{-- Archivo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Archivo (opcional)</label>
                        <input type="file" name="archivo" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    {{-- Observación inicial --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">
                            Observación (opcional)
                        </label>
                        <textarea name="observacion_inicial" rows="2"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2
               focus:ring-ues-primary focus:border-ues-primary"
                            placeholder="Información adicional que considere relevante">{{ old('observacion_inicial') }}</textarea>
                    </div>


                    {{-- Botones --}}
                    <div class="flex justify-between pt-4">
                        <a href="{{ route('solicitudes.index') }}"
                            class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                            ← Volver al listado
                        </a>

                        <button type="submit"
                            class="bg-ues-primary hover:bg-ues-secondary text-white px-5 py-2 rounded text-sm">
                            Guardar solicitud
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
