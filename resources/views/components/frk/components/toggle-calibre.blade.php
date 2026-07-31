@props(['label'=>'','left'=>'Si','right'=>'No','attrib','disabled'])

<div class="w-full flex-wrap rounded-lg mx-1 px-1 pb-1" x-data="{open_calibre: @entangle('usa_calibre').live}" >
    <x-frk.components.label label="{{$label}}" class="font-semibold text-sm capitalize" />
    @if ($disabled)
        <div class="flex items-center cursor-pointer cm-toggle-wrapper justify-center" {{$attributes}}>
    @else
       <div class="flex items-center justify-center cm-toggle-wrapper"
        :class="{ 'cursor-not-allowed opacity-50': {{ $disabled ? 'true' : 'false' }} }"
        @click="{{ $disabled ? '' : 'open_calibre = !open_calibre' }}" >
    @endif
    <span class="font-semibold text-xs mr-1">Activo</span>
        <div class="rounded-full w-8 h-4 p-0.5" :class="{'bg-green-500': open_calibre === true,'bg-red-500':open_calibre === false}">
            <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out" disabled :class="{'-translate-x-2': open_calibre === true,'translate-x-2': open_calibre === false}">
            </div>
        </div>
        <span class="font-semibold text-xs ml-1">Inactivo </span>
    </div>
</div>
