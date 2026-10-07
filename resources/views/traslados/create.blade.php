<x-app-layout>
    <div class="max-w-2xl mx-auto px-6 py-8 bg-white"> {{-- limitamos ancho --}}
        <h2 class="text-2xl font-semibold mb-6">Registrar Traslado</h2>

        <form action="{{ route('traslados.store') }}" method="POST" class="space-y-4"> {{-- espacio uniforme entre campos --}}
            @csrf

            <input type="hidden" name="recurso_id" value="{{ $recurso->id_recurso }}">

            {{-- Producto --}}
            <div>
                <label class="block font-medium">Producto</label>
                <input type="text" value="{{ $recurso->producto->nombre }}" readonly
                    class="border border-gray-300 rounded px-3 py-2 w-full bg-gray-100">
            </div>

            {{-- Ubicación actual --}}
            <div>
                <label class="block font-medium">Ubicación actual</label>
                <input type="text" value="{{ $recurso->ubicacion->nombre }}" readonly
                    class="border border-gray-300 rounded px-3 py-2 w-full bg-gray-100">
            </div>

            {{-- Estado actual --}}
            <div>
                <label class="block font-medium">Estado actual</label>
                <input type="text" value="{{ $recurso->estado->nombre }}" readonly
                    class="border border-gray-300 rounded px-3 py-2 w-full bg-gray-100">
            </div>

            {{-- Tipo de traslado --}}
            <div>
                <label class="block font-medium">Tipo de traslado</label>
                <select name="tipo_traslado_id" required class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">Seleccione un tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id_tipo_traslado }}">{{ $tipo->nombre }}</option>
                    @endforeach
                </select>
                @error('tipo_traslado_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Fecha del traslado --}}
            <div>
                <label class="block font-medium">Fecha del traslado</label>
                <input type="date" name="fecha" value="{{ old('fecha', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                    {{-- value="{{ old('fecha') }}" --}}
                    class="border border-gray-300 rounded px-3 py-2 w-full @error('fecha') border-red-500 @enderror"
                    required>
                @error('fecha')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ubicación destino --}}
            <div>
                <label class="block font-medium">Ubicación destino</label>
                <select name="ubicacion_destino_id" required class="border border-gray-300 rounded px-3 py-2 w-full">
                    <option value="">Seleccione una ubicación</option>
                    @foreach ($ubicaciones as $ubicacion)
                        @if ($ubicacion->id_ubicacion != $recurso->ubicacion->id_ubicacion)
                            <option value="{{ $ubicacion->id_ubicacion }}">{{ $ubicacion->nombre }}</option>
                        @endif
                    @endforeach
                </select>
                @error('ubicacion_destino_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block font-medium">Descripción</label>
                <textarea name="descripcion" class="border border-gray-300 rounded px-3 py-2 w-full">{{ old('descripcion') }}</textarea>
            </div>
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('inventario.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded">
                    Guardar traslado
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
