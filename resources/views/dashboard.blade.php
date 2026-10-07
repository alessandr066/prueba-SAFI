<x-app-layout>
    <div class="mx-auto max-w-6xl px-6 py-8 space-y-8">

        {{-- TÍTULO --}}
        <h2 class="text-3xl font-bold text-ues-primary tracking-wide">
            Panel General
        </h2>

        {{-- ===== KPIs ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

            @php
                $cards = [
                    ['title' => 'Traslados', 'value' => $totalTraslados, 'color' => 'text-blue-700'],
                    ['title' => 'Solicitudes', 'value' => $totalSolicitudes, 'color' => 'text-green-700'],
                    ['title' => 'Usuarios', 'value' => $totalUsuarios, 'color' => 'text-purple-700'],
                    ['title' => 'Pendientes', 'value' => $pendientes, 'color' => 'text-red-700'],
                ];
            @endphp

            @foreach ($cards as $c)
                <div class="bg-white shadow-md rounded-xl p-5 border hover:shadow-lg transition">
                    <h3 class="text-gray-500 text-sm">{{ $c['title'] }}</h3>
                    <p class="text-3xl font-extrabold mt-1 {{ $c['color'] }}">
                        {{ $c['value'] }}
                    </p>
                </div>
            @endforeach

        </div>

        {{-- ===== GRÁFICAS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Traslados --}}
            <div class="bg-white shadow-md rounded-xl p-6 border">
                <h3 class="text-gray-800 font-semibold mb-3 text-lg">Traslados por mes</h3>
                <canvas id="chartTraslados" height="180"></canvas>
            </div>

            {{-- Solicitudes --}}
            <div class="bg-white shadow-md rounded-xl p-6 border">
                <h3 class="text-gray-800 font-semibold mb-3 text-lg">Solicitudes por estado</h3>
                <canvas id="chartSolicitudes" height="180"></canvas>
            </div>

            {{-- Mantenimientos --}}
            <div class="bg-white shadow-md rounded-xl p-6 border">
                <h3 class="text-gray-800 font-semibold mb-3 text-lg">Mantenimientos por estado</h3>
                <canvas id="chartMantenimientos" height="180"></canvas>
            </div>

        </div>

        {{-- ===== ÚLTIMOS MOVIMIENTOS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Últimos traslados --}}
            <div class="bg-white rounded-xl shadow-md p-6 border">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Últimos Traslados</h3>

                <ul class="text-sm divide-y">
                    @forelse($ultimosTraslados as $t)
                        <li class="py-2">
                            <span class="font-semibold text-ues-primary">
                                {{ $t->recurso->producto->nombre ?? '-' }}
                            </span>
                            →
                            <span class="text-gray-700">
                                {{ $t->ubicacionDestino->nombre ?? '-' }}
                            </span>
                        </li>
                    @empty
                        <li class="py-3 text-gray-500">No hay registros recientes.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Bitácora --}}
            <div class="bg-white rounded-xl shadow-md p-6 border">
                <h3 class="text-lg font-semibold text-gray-700 mb-3">Última Actividad</h3>

                <ul class="text-sm divide-y">
                    @forelse($ultimosBitacora as $b)
                        <li class="py-2">
                            <strong class="text-ues-primary">{{ $b->usuario->username ?? 'Usuario' }}</strong>
                            <span class="text-gray-600">— {{ $b->accion->nombre ?? 'Acción' }}</span>
                        </li>
                    @empty
                        <li class="py-3 text-gray-500">Sin actividad registrada.</li>
                    @endforelse
                </ul>
            </div>

            {{-- Recursos por estado --}}
            <div class="bg-white shadow-md rounded-xl p-6 border">
                <h3 class="font-semibold text-gray-700 mb-2 text-lg">Recursos por estado</h3>
                <ul class="text-sm space-y-1">
                    @foreach ($recursosPorEstado as $estado => $total)
                        <li class="flex justify-between border-b pb-1">
                            <span>{{ $estado }}</span>
                            <span class="font-bold text-ues-primary">{{ $total }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // === TRASLADOS ===
        new Chart(document.getElementById('chartTraslados'), {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($trasladosPorMes->toArray())) !!},
                datasets: [{
                    label: 'Traslados',
                    data: {!! json_encode(array_values($trasladosPorMes->toArray())) !!},
                    backgroundColor: '#b91c1c',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // === SOLICITUDES ===
        new Chart(document.getElementById('chartSolicitudes'), {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($solicitudesPorEstado->toArray())) !!},
                datasets: [{
                    data: {!! json_encode(array_values($solicitudesPorEstado->toArray())) !!},
                    backgroundColor: ['#b91c1c', '#fbbf24', '#1e3a8a'],
                }]
            }
        });

        // === MANTENIMIENTOS ===
        new Chart(document.getElementById('chartMantenimientos'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($mantenimientosPorEstado->toArray())) !!},
                datasets: [{
                    data: {!! json_encode(array_values($mantenimientosPorEstado->toArray())) !!},
                    backgroundColor: ['#0E4C92', '#28A745', '#FFC107', '#DC3545']
                }]
            }
        });
    </script>

</x-app-layout>
