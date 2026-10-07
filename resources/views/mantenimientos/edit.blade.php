<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-10 px-4">
        <div class="mx-auto max-w-3xl bg-white shadow-md rounded-lg px-8 py-6">

            {{-- Título --}}
            <h2 class="text-xl font-bold mb-4">
                Editar Mantenimiento
            </h2>

            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4 text-sm">
                    {{ implode(', ', $errors->all()) }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('mantenimientos.update', $mantenimiento->id_mantenimiento) }}">
                @csrf
                @method('PUT')

                {{-- Recurso --}}
                <div class="mb-4">
                    <label for="recurso_id" class="block font-medium">Recurso:</label>
                    <select id="recurso_id" name="recurso_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Seleccione un recurso</option>
                        @foreach ($recursos as $recurso)
                            <option value="{{ $recurso->id_recurso }}"
                                {{ old('recurso_id', $mantenimiento->recurso_id) == $recurso->id_recurso ? 'selected' : '' }}>
                                {{ $recurso->producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tipo de Mantenimiento --}}
                <div class="mb-4">
                    <label for="tipo_mantenimiento_id" class="block font-medium">
                        Tipo de Mantenimiento:
                    </label>
                    <select id="tipo_mantenimiento_id" name="tipo_mantenimiento_id"
                        class="w-full border rounded px-3 py-2" required>
                        <option value="">Seleccione tipo</option>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id_tipo_mantenimiento }}"
                                {{ old('tipo_mantenimiento_id', $mantenimiento->tipo_mantenimiento_id) == $tipo->id_tipo_mantenimiento ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Técnico --}}
                <div class="mb-4">
                    <label for="tecnico_id" class="block font-medium">Técnico:</label>
                    <select id="tecnico_id" name="tecnico_id" class="w-full border rounded px-3 py-2" required>
                        <option value="">Seleccione técnico</option>
                        @foreach ($tecnicos as $tecnico)
                            <option value="{{ $tecnico->id_tecnico }}"
                                {{ old('tecnico_id', $mantenimiento->tecnico_id) == $tecnico->id_tecnico ? 'selected' : '' }}>
                                {{ $tecnico->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Fecha --}}
                <div class="mb-4">
                    <label for="fecha" class="block font-medium">Fecha:</label>
                    <input type="date" id="fecha" name="fecha"
                        value="{{ old('fecha', $mantenimiento->fecha) }}" class="w-full border rounded px-3 py-2"
                        required>
                </div>

                {{-- Descripción --}}
                <div class="mb-4">
                    <label for="descripcion" class="block font-medium">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="3" class="w-full border rounded px-3 py-2">{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
                </div>
                <div class="mt-8 flex justify-between">
                    {{-- Botón regresar --}}
                    <a href="{{ route('mantenimientos.index') }}"
                        class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                        ← Volver al listado
                    </a>
                    <button type="submit"
                        class="bg-ues-primary hover:bg-ues-secondary text-white font-semibold py-2 px-6 rounded-md shadow">
                        Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
