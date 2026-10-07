<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 px-4">

        {{-- Tarjeta principal --}}
        <div class="bg-white shadow-xl rounded-xl overflow-hidden border border-gray-200">

            {{-- Encabezado --}}
            <div class="bg-ues-primary text-white text-2xl font-semibold px-6 py-4 flex items-center gap-2">
                <i class="fas fa-home text-white"></i>
                Bienvenido al Sistema SAFI
            </div>

            {{-- Contenido --}}
            <div class="p-6 text-gray-700">

                @auth
                    <p class="text-lg mb-4">
                        Hola, <strong>{{ Auth::user()->name }}</strong>.
                    </p>

                    <p class="mb-4 text-gray-600">
                        Accede rápidamente a los módulos disponibles según tu rol:
                    </p>

                    {{-- Accesos rápidos --}}
                    <div class="grid md:grid-cols-2 gap-4 mt-4">

                        {{-- Inventario --}}
                        @role('Administrador,Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad')
                            <a href="{{ route('recursos.index') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Inventario</h3>
                                <p class="text-sm text-gray-600">Consulta recursos, activos y equipos.</p>
                            </a>
                        @endrole

                        {{-- SOLICITUDES : REPRESENTANTE --}}
                        @role('Representante Unidad/Escuela')
                            <a href="{{ route('solicitudes.index') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Solicitudes</h3>
                                <p class="text-sm text-gray-600">Crear y consultar solicitudes.</p>
                            </a>
                        @endrole

                        {{-- SOLICITUDES : JEFE UF --}}
                        @role('Jefe UF-Facultad')
                            <a href="{{ route('solicitudes.revisar') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Revisar Solicitudes</h3>
                                <p class="text-sm text-gray-600">Revisión y validación de solicitudes.</p>
                            </a>
                        @endrole

                        {{-- SOLICITUDES : ENCARGADO UAF --}}
                        @role('Encargado UAF-Facultad')
                            <a href="{{ route('solicitudes.revisar') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Revisar Solicitudes</h3>
                                <p class="text-sm text-gray-600">Gestión y control de solicitudes.</p>
                            </a>
                        @endrole

                        {{-- SOLICITUDES : DECANO --}}
                        @role('Decano Facultad')
                            <a href="{{ route('solicitudes.aprobar') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Aprobar Solicitudes</h3>
                                <p class="text-sm text-gray-600">Aprobación final de solicitudes.</p>
                            </a>
                        @endrole

                        {{-- Mantenimientos --}}
                        @role('Administrador')
                            <a href="{{ route('mantenimientos.index') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Mantenimientos</h3>
                                <p class="text-sm text-gray-600">Control y seguimiento de reparaciones.</p>
                            </a>
                        @endrole

                        {{-- Traslados --}}
                        @role('Administrador,Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad')
                            <a href="{{ route('traslados.index') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Traslados</h3>
                                <p class="text-sm text-gray-600">Movimiento y reasignación de recursos.</p>
                            </a>
                        @endrole

                        {{-- Descargos --}}
                        @role('Administrador,Encargado UAF-Facultad')
                            <a href="{{ route('descargos.index') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Descargos</h3>
                                <p class="text-sm text-gray-600">Baja de recursos institucionales.</p>
                            </a>
                        @endrole

                        {{-- Reportes --}}
                        @role('Administrador,Decano Facultad')
                            <a href="{{ route('reportes.recursos.index') }}"
                                class="p-4 bg-gray-100 rounded-xl border hover:bg-gray-200 transition shadow-sm">
                                <h3 class="font-semibold text-ues-primary text-lg">Reportes</h3>
                                <p class="text-sm text-gray-600">Exporta e interpreta información del sistema.</p>
                            </a>
                        @endrole

                    </div>
                @else
                    {{-- Si NO ha iniciado sesión --}}
                    <div class="text-center py-8">
                        <p class="text-lg mb-4">
                            No has iniciado sesión.
                        </p>

                        <a href="{{ route('login') }}"
                            class="bg-ues-primary hover:bg-ues-secondary text-white px-6 py-3 rounded-lg text-lg font-semibold transition">
                            Iniciar Sesión
                        </a>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</x-app-layout>
