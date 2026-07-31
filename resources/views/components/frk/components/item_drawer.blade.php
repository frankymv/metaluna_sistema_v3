@props([
    'label' => 'Item',
    'route' => '#',
    'icon' => 'fa-solid fa-circle',
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
           gap-4
           px-1
           py-1
           rounded-xl
           transition-all
           duration-200

           {{ $active
                ? 'bg-fourthColor text-white shadow-lg'
                : 'text-white hover:bg-white/10 hover:text-white hover:translate-x-1'
           }}"
>

    {{-- Barra lateral --}}
    <span
        class="absolute
               left-0
               top-2
               bottom-2
               w-1
               rounded-r-full

               {{ $active
                    ? 'bg-white'
                    : 'bg-transparent group-hover:bg-white/40'
               }}"
    ></span>

    {{-- Icono --}}
    <div
        class="flex
               items-center
               justify-center
               w-9
               h-9
               rounded-lg

               {{ $active
                    ? 'bg-white/20'
                    : 'group-hover:bg-white/10'
               }}"
    >

        <i class="{{ $icon }} text-sm"></i>

    </div>

    {{-- Texto --}}
    <div class="flex-1">

        <span class="font-medium">

            {{ $label }}

        </span>

    </div>

    {{-- Flecha opcional --}}
    @if($active)

        <i
            class="fa-solid
                   fa-chevron-right
                   text-xs
                   opacity-80"
        ></i>

    @endif

</a>
