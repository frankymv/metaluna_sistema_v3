<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>

    </x-slot>
    <x-slot:body>



        <div class="flex w-full flex-wrap m-4">
            <div class="flex w-full">
                <div class=" w-full md:w-2/4">
                    <x-frk.components.title label="Nuevo Abono Anticipado" />
                </div>
                <div class=" w-full md:w-1/4">
                    <x-frk.components.label-input label="No abono"   wire:model.live="no_abono" />
                </div>
                <div class="flex w-full md:w-1/4    ">
                    <x-frk.components.date-picker error="fecha_abono" wire:model="fecha_abono" label="Fecha abono"/>
                </div>
            </div>
            <x-frk.components.divisor-line />


            <div class="flex w-full ">
                <x-frk.components.subtitle  label="CLIENTE" />
                <x-frk.components.button color="blue" label="Buscar" wire:click="buscarCliente()" />
            </div>


            <div class="flex w-full ">
                <div class="flex w-full md:w-1/4">
                    <x-frk.components.label-input  label="codigo interno" error="codigo" :disabled="$disabled" wire:model.live="codigo_interno" />
                </div>
                <div class="flex w-full md:w-3/4">
                    <x-frk.components.label-input  label="nombre_empresa" error="codigo" :disabled="$disabled" wire:model.live="nombre_empresa" />
                </div>

            </div>
            <div class="flex w-full ">
                <div class="flex w-full md:w-2/4">
                    <x-frk.components.label-input  label="nombre_cliente" error="codigo" :disabled="$disabled" wire:model.live="nombres_cliente" />
                </div>
                <div class="flex w-full md:w-2/4">
                    <x-frk.components.label-input  label="apellidos cliente" error="codigo" :disabled="$disabled" wire:model.live="apellidos_cliente" />
                </div>
            </div>


            <div class="flex w-full ">
                <div class=" w-full md:w-2/4">
                    <x-frk.components.select label="Tipo Pago" error="tipo_pago_id" :disabled="$disabled" wire:model.live="tipo_pago_id">
                        @foreach ($this->tipo_pago as $data)
                        <option value="{{ $data['valor'] }}" >{{ $data['nombre']}} </option>
                        @endforeach
                    </x-forms.select>
                </div>
                <div class=" w-full md:w-2/4">
                    <x-frk.components.label-input-moneyy  label="Total Abono" error="total_abono" :disabled="$disabled" wire:model.live="cantidad_abono"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
                </div>
            </div>
            <x-frk.components.divisor-line />
            <div class="flex w-full ">
                <x-frk.components.label-input label="Observaciones"   wire:model="observaciones" />
            </div>

            <div class="flex w-full ">
                <x-frk.components.label-input label="Detalle Pago"   wire:model="detalle_pago" />
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
        <x-frk.components.button color="blue" label="guardar" wire:click.prevent="storeAnticipado()" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>

