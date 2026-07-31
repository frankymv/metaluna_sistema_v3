@props([
    'label' => '',
    'icon' => 'fa-solid fa-folder',
    'active' => false,
])

<div
    x-data="{
        open: {{ $active ? 'true' : 'false' }}
    }"
    class="space-y-2"
>

    <button
        type="button"

        @click="open = !open"

        class="group
               relative
               w-full
               flex
               items-center
               gap-4
               px-1
               py-1
               rounded-xl
               transition-all
               duration-200

               {{ $active
                    ? 'bg-fourthColor shadow-lg text-white'
                    : 'text-white hover:bg-white/10 hover:text-white'
               }}"
    >

        {{-- Barra izquierda --}}
        <span
            class="absolute
                   left-0
                   top-2
                   bottom-2
                   w-1
                   rounded-r-full

                   {{ $active
                        ? 'bg-white'
                        : 'bg-transparent group-hover:bg-white/30'
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

            <i class="{{ $icon }}"></i>

        </div>

        {{-- Texto --}}
        <div class="flex-1 text-left">

            <span class="font-medium">

                {{ $label }}

            </span>

        </div>

        {{-- Flecha --}}
        <i
            class="fa-solid
                   fa-chevron-down
                   text-xs
                   transition-transform
                   duration-300"

            :class="{
                'rotate-180' : open
            }"
        ></i>

    </button>

    {{-- Submenú --}}
    <div

        x-show="open"

        x-collapse

        x-transition

        class="
               space-y-1
               border-l
               border-white/10
               ml-5"

    >

        {{ $slot }}

    </div>

</div>
