<x-app-layout>
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow mt-6">
        <h2 class="text-xl font-bold mb-4">Registrar Mantenimiento</h2>

        <form method="POST" action="{{ route('mantenimientos.store') }}">
            @csrf

            {{-- Recurso --}}
            <div class="mb-3">
                <label class="block font-medium">Recurso</label>
                <select name="recurso_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Seleccione</option>
                    @foreach ($recursos as $r)
                        <option value="{{ $r->id_recurso }}">{{ $r->producto->nombre }} ({{ $r->codigo }})</option>
                    @endforeach
                </select>
            </div>

            {{-- Tipo --}}
            <div class="mb-3">
                <label class="block font-medium">Tipo de mantenimiento</label>
                <select name="tipo_mantenimiento_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Seleccione</option>
                    @foreach ($tipos as $t)
                        <option value="{{ $t->id_tipo_mantenimiento }}">{{ $t->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Técnico --}}
            <div class="mb-3">
                <label class="block font-medium">Técnico</label>
                <select name="tecnico_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Seleccione</option>
                    @foreach ($tecnicos as $tec)
                        <option value="{{ $tec->id_tecnico }}">{{ $tec->nombre }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha --}}
            <div class="mb-3">
                <label class="block font-medium">Fecha</label>
                <input type="date" name="fecha" required class="w-full border rounded px-3 py-2">
            </div>

            {{-- Descripción --}}
            <div class="mb-3">
                <label class="block font-medium">Descripción</label>
                <textarea name="descripcion" class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div class="mt-8 flex justify-between">
                {{-- Botón regresar --}}
                <a href="{{ route('mantenimientos.index') }}"
                    class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded shadow">
                    ← Volver al listado
                </a>
                <button type="submit" class="bg-ues-primary hover:bg-ues-secondary text-white px-4 py-2 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
