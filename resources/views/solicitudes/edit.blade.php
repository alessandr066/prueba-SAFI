<x-app-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">

        <div class="bg-white rounded-xl shadow border border-gray-200">

            {{-- Encabezado --}}
            <div class="bg-ues-primary text-white px-6 py-4 rounded-t-xl">
                <h2 class="text-xl font-semibold">Editar Solicitud</h2>
            </div>

            <div class="p-6">

                {{-- Estado actual --}}
                <p class="mb-4 text-sm">
                    Estado actual:
                    <span class="font-semibold text-ues-primary">
                        {{ $solicitud->estado }}
                    </span>
                </p>

                {{-- Mensajes de error --}}
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulario --}}
                <form method="POST" action="{{ route('solicitudes.update', $solicitud->id_solicitud) }}"
                    enctype="multipart/form-data" class="space-y-4">

                    @csrf
                    @method('PUT')

                    {{-- Número (bloqueado) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Número de solicitud</label>
                        <input type="text" value="{{ $solicitud->numero }}" readonly
                            class="w-full bg-gray-100 border rounded-lg px-3 py-2 text-gray-600">
                    </div>

                    {{-- Fecha (bloqueada) --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de petición</label>
                        <input type="date" value="{{ $solicitud->fecha_peticion }}" readonly
                            class="w-full bg-gray-100 border rounded-lg px-3 py-2 text-gray-600">
                    </div>

                    {{-- Entidad --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Entidad</label>
                        <input type="text" name="entidad" value="{{ old('entidad', $solicitud->entidad) }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">
                    </div>

                    {{-- Tipo de petición --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de petición</label>
                        <input type="text" name="tipo_peticion"
                            value="{{ old('tipo_peticion', $solicitud->tipo_peticion) }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">
                    </div>

                    {{-- Responsable --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                        <input type="text" name="responsable"
                            value="{{ old('responsable', $solicitud->responsable) }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">
                    </div>

                    {{-- Descripción --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-ues-primary focus:border-ues-primary">{{ old('descripcion', $solicitud->descripcion) }}</textarea>
                    </div>

                    {{-- Archivo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Archivo (opcional)
                        </label>

                        @if ($solicitud->archivo)
                            <p class="text-xs mb-2">
                                Archivo actual:
                                <a href="{{ asset('storage/' . $solicitud->archivo) }}" target="_blank"
                                    class="text-ues-primary underline">
                                    Ver archivo
                                </a>
                            </p>
                        @endif

                        <input type="file" name="archivo" class="w-full border rounded-lg px-3 py-2">
                    </div>

                    {{-- Observación inicial (solo lectura) --}}
                    @if ($solicitud->observacion_inicial)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Observación inicial
                            </label>
                            <textarea rows="2" readonly class="w-full bg-gray-100 border rounded-lg px-3 py-2 text-gray-600">{{ $solicitud->observacion_inicial }}</textarea>
                        </div>
                    @endif

                    {{-- Observación de revisión --}}
                    @if ($solicitud->observacion_revision)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1 text-red-600">
                                Observación de revisión
                            </label>
                            <textarea rows="2" readonly class="w-full bg-red-50 border border-red-300 rounded-lg px-3 py-2 text-red-700">{{ $solicitud->observacion_revision }}</textarea>
                        </div>
                    @endif

                    {{-- Botones --}}
                    <div class="flex justify-between pt-4">
                        <a href="{{ route('solicitudes.index') }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded shadow">
                            ← Volver
                        </a>

                        <button type="submit"
                            class="bg-ues-primary hover:bg-ues-secondary text-white px-5 py-2 rounded text-sm">
                            Guardar cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
