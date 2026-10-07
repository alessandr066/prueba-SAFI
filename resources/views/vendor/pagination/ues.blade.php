@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-4">
        {{-- Botón Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-default">
                « Anterior
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" 
               class="px-3 py-2 bg-ues-primary text-white rounded-lg hover:bg-ues-secondary transition">
                « Anterior
            </a>
        @endif

        {{-- Números --}}
        <div class="flex space-x-1 mx-4">
            @foreach ($elements as $element)
                {{-- Separador ... --}}
                @if (is_string($element))
                    <span class="px-3 py-2 text-gray-500">{{ $element }}</span>
                @endif

                {{-- Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-2 bg-ues-primary text-white rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                               class="px-3 py-2 bg-gray-100 hover:bg-ues-light text-ues-primary rounded-lg transition">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Botón Siguiente --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" 
               class="px-3 py-2 bg-ues-primary text-white rounded-lg hover:bg-ues-secondary transition">
                Siguiente »
            </a>
        @else
            <span class="px-3 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-default">
                Siguiente »
            </span>
        @endif
    </nav>
@endif
