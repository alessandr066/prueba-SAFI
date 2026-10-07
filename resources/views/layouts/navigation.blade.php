<nav class="bg-white dark:bg-gray-900 shadow sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">

        {{-- Logo --}}
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="https://www.ues.edu.sv/wp-content/uploads/sites/20/2024/08/dark-header-v2-500x176.png"
                class="h-12 block dark:hidden">
            <img src="https://www.ues.edu.sv/wp-content/uploads/sites/20/2024/08/light-header-v2.png"
                class="h-12 hidden dark:block">
        </a>

        {{-- MENÚ DESKTOP --}}
        <ul id="desktop-menu" class="hidden lg:flex space-x-6 font-medium text-sm items-center">

            <li>
                <a href="{{ url('/') }}" class="hover:text-ues-primary transition">Inicio</a>
            </li>

            {{-- --------------------------- SOLICITUDES --}}
            @role('Representante Unidad/Escuela')
                <li><a href="{{ route('solicitudes.index') }}" class="hover:text-ues-primary">Solicitudes</a></li>
            @endrole

            @role('Jefe UF-Facultad,Encargado UAF-Facultad')
                <li><a href="{{ route('solicitudes.revisar') }}" class="hover:text-ues-primary">Revisar Solicitudes</a></li>
            @endrole

            @role('Decano Facultad')
                <li><a href="{{ route('solicitudes.aprobar') }}" class="hover:text-ues-primary">Aprobaciones</a></li>
            @endrole

            {{-- INVENTARIO --}}
            @role('Administrador,Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad,Representante Unidad/Escuela')
                <li><a href="{{ route('recursos.index') }}" class="hover:text-ues-primary">Inventario</a></li>
            @endrole

            {{-- Productos --}}
            @role('Administrador')
                <li><a href="{{ route('productos.index') }}" class="hover:text-ues-primary">Productos</a></li>
            @endrole

            {{-- TRASLADOS --}}
            @role('Administrador,Jefe UF-Facultad,Encargado UAF-Facultad,Decano Facultad')
                <li><a href="{{ route('traslados.index') }}" class="hover:text-ues-primary">Traslados</a></li>
            @endrole

            {{-- MANTENIMIENTOS --}}
            @role('Administrador')
                <li><a href="{{ route('mantenimientos.index') }}" class="hover:text-ues-primary">Mantenimientos</a></li>
            @endrole

            @role('Administrador,Jefe UF-Facultad,Encargado UAF-Facultad')
                <li><a href="{{ route('tecnicos.index') }}" class="hover:text-ues-primary">Técnicos</a></li>
            @endrole

            {{-- DESCARGOS --}}
            @role('Administrador,Encargado UAF-Facultad')
                <li><a href="{{ route('descargos.index') }}" class="hover:text-ues-primary">Descargos</a></li>
            @endrole

            {{-- REPORTES --}}
            @role('Administrador,Decano Facultad')
                <li><a href="{{ route('reportes.recursos.index') }}" class="hover:text-ues-primary">Reportes</a></li>
            @endrole

            {{-- BITÁCORA --}}
            @role('Administrador')
                <li><a href="{{ route('bitacora.index') }}" class="hover:text-ues-primary">Bitácora</a></li>
            @endrole

            {{-- USUARIOS --}}
            @role('Administrador')
                <li><a href="{{ route('usuarios.index') }}" class="hover:text-ues-primary">Usuarios</a></li>
            @endrole

            {{-- =================== SINIESTROS =================== --}}

            @role('Jefe UF-Facultad,Encargado UAF-Facultad')
                <li>
                    <a href="{{ route('siniestros.revisar') }}" class="hover:text-ues-primary">
                        Revisar Siniestros
                    </a>
                </li>
            @endrole

            @role('Decano Facultad')
                <li>
                    <a href="{{ route('siniestros.aprobar') }}" class="hover:text-ues-primary font-semibold">
                        Aprobar Siniestros
                    </a>
                </li>
            @endrole



            {{-- AUTENTICACIÓN --}}
            @guest
                <li><a href="{{ route('login') }}" class="hover:text-ues-primary">Ingresar</a></li>
            @endguest

            @auth
                <div x-data="{ open: false }" class="relative">

                    {{-- BOTÓN DEL USUARIO --}}
                    <button @click="open = !open"
                        class="flex items-center gap-2 font-semibold text-gray-800 hover:text-ues-primary">

                        <span class="text-base font-bold">
                            {{ Auth::user()->name }}
                        </span>

                        <span class="text-xs bg-ues-primary text-white px-2 py-0.5 rounded">
                            {{ Auth::user()->rol->nombre ?? 'Sin rol' }}
                        </span>

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- DROPDOWN --}}
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-50">

                        {{-- MI PERFIL --}}
                        <a href="{{ route('profile.index') }}"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-ues-primary hover:text-white transition">
                            Mi Perfil
                        </a>

                        {{-- CERRAR SESIÓN --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-red-700 hover:text-white transition">
                                Cerrar sesión
                            </button>
                        </form>

                    </div>

                </div>
            @endauth

        </ul>
        {{-- ICONOS DERECHA --}}
        <div class="flex items-center space-x-4">

            <button class="text-gray-600 dark:text-gray-300 hover:text-ues-primary transition">
                <i class="fas fa-search"></i>
            </button>

            {{-- Menú móvil --}}
            <button class="lg:hidden text-gray-600 dark:text-gray-300 hover:text-ues-primary js-menu-toggle">
                <div class="space-y-1">
                    <span class="block h-0.5 w-6 bg-current"></span>
                    <span class="block h-0.5 w-6 bg-current"></span>
                </div>
            </button>

        </div>

    </div>

    {{-- MENÚ MÓVIL --}}
    <div
        class="site-mobile-menu lg:hidden fixed top-0 left-0 w-3/4 max-w-xs h-full bg-white shadow-lg transform -translate-x-full transition-transform duration-300 z-50">

        <div class="p-4 border-b">
            <span class="text-lg font-bold">Menú</span>
        </div>

        {{-- Datos del usuario --}}
        @auth
            <div class="p-4 border-b">
                <div class="font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                <div class="inline-block mt-1 text-xs bg-ues-primary text-white px-2 py-1 rounded">
                    {{ Auth::user()->rol->nombre ?? 'Sin rol' }}
                </div>
            </div>
        @endauth

        <div class="site-mobile-menu-body flex flex-col p-4 space-y-3 text-gray-800 text-base"></div>

    </div>
    <div class="site-mobile-menu-overlay fixed inset-0 bg-black bg-opacity-40 hidden z-40"></div>





</nav>
