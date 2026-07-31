
<div class="flex w-full flex-wrap items-center my-1 px-1 ">
    <x-frk.components.label textLabel="Estado" class="w-full text-xs font-bold uppercase" />

    <div class="flex  m-2 cursor-pointer justify-center "   wire:click="estadoToggle()"   x-data="{valueData: @entangle('estado')}">
        <span class="font-semibold text-xs mr-1">Inactivo</span>
        <div class="rounded-full w-8 h-4 p-0.5"  :class="{'bg-red-500': valueData === 'Inactivo','bg-green-500': valueData === 'Activo'}">
            <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out" disabled :class="{'-translate-x-2': valueData === 'Inactivo','translate-x-2': valueData === 'Activo'}"></div>
        </div>
        <span class="font-semibold text-xs ml-1">Activo</span>
    </div>
</div>
