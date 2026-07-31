@props([
    'label' => '',
    'route' => '#',
])

@php
    $active = request()->routeIs($route);
@endphp

<a
    href="{{ route($route) }}"

    class="group
           relative
           flex
           items-center
           gap-3
           rounded-lg
           px-1
           py-1
           text-sm
           transition-all
           duration-200

           {{ $active
                ? 'bg-fourthColor text-white font-medium'
                : 'text-white hover:bg-white/5 hover:text-white hover:translate-x-1'
           }}"
>

    {{-- Punto indicador --}}
    <span
        class="w-2 h-2 rounded-full transition-all duration-200

        {{ $active
            ? 'bg-white'
            : 'bg-white/30 group-hover:bg-white/70'
        }}"
    ></span>

    {{-- Texto --}}
    <span class="flex-1">

        {{ $label }}

    </span>

    {{-- Check cuando está activo --}}
    @if($active)

        <i
            class="fa-solid
                   fa-check
                   text-[10px]
                   opacity-70"
        ></i>

    @endif

</a>
