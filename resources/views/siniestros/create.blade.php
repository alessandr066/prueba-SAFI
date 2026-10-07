<x-app-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">

        <h2 class="text-2xl font-bold text-ues-primary mb-4">
            Reportar Siniestro — {{ $recurso->codigo }}
        </h2>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow p-6">

            <p><strong>Recurso:</strong> {{ $recurso->nombre }}</p>
            <p><strong>Ubicación:</strong> {{ $recurso->ubicacion->nombre ?? '-' }}</p>

            <form method="POST" action="{{ route('siniestros.store') }}" enctype="multipart/form-data"
                class="mt-6 space-y-4">
                @csrf

                <input type="hidden" name="recurso_id" value="{{ $recurso->id_recurso }}">

                <div>
                    <label class="font-semibold">Fecha del siniestro *</label>
                    <input type="date" name="fecha_siniestro" required class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="font-semibold">Tipo de siniestro *</label>
                    <select name="tipo" required class="w-full border rounded px-3 py-2">
                        <option value="">Seleccione</option>
                        <option value="Daño">Daño</option>
                        <option value="Robo">Robo</option>
                        <option value="Pérdida">Pérdida</option>
                        <option value="Destrucción">Destrucción</option>
                    </select>
                </div>

                <div>
                    <label class="font-semibold">Descripción *</label>
                    <textarea name="descripcion" required rows="4" class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div>
                    <label class="font-semibold">Documento de respaldo (opcional)</label>
                    <input type="file" name="archivo" class="w-full border rounded px-3 py-2">
                </div>

                <div class="flex justify-end">
                    <button class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
                        Reportar Siniestro
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
