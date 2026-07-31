<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Detalle {{$title}}" />
        </x-slot>
        <x-slot:body>
           <div class="flex w-full flex-wrap m-4">


        <div class=" fleX w-full">

        </div>

        <div class="flex w-full ">
            <div class="flex w-full md:w-1/3">
                <x-frk.components.title  label="Combustible" />

            </div>
            <div class="flex w-full md:w-1/3">
                <x-frk.components.label-input  label="No Combustible" error="no_combustible" :disabled="$disabled" wire:model.live="no_combustible" />
            </div>
            <div class=" flex w-full md:w-1/3">
                <x-frk.components.date-picker label="Fecha Combustible" error="fecha_combustible" :disabled="$disabled" wire:model.live="fecha_combustible" />
            </div>

        </div>

                <div class="flex w-full ">
            <div class="flex w-full md:w-1/3">


            </div>
            <div class=" flex w-full md:w-1/3">

            </div>
            <div class="flex w-full md:w-1/3">
                <x-frk.components.label-input-money  label="total Combustible" error="total_combustible" :disabled="$disabled" wire:model.live="total_combustible" />
            </div>
        </div>


        <div class="flex w-full ">
            <div class=" flex w-full md:w-1/2">
                <x-frk.components.label-input  label="Usuario" error="no_combustible" :disabled="$disabled" wire:model.live="user_id" />
            </div>
            <div class=" flex w-full md:w-1/2">
 <x-frk.components.label-input  label="Vehiculo" error="no_combustible" :disabled="$disabled" wire:model.live="vehiculo_id" />
            </div>
        </div>




        <div class="flex w-full ">
            <x-frk.components.label-input label="Observaciones"   wire:model="observaciones" />
        </div>

    @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
    @endif
</div>

        </x-slot>
        <x-slot:footer>
            <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
        </x-slot>
   </x-frk.components.template-crud>
</div>
