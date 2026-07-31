<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>


    </x-slot>
    <x-slot:body>


    <div class="flex w-full flex-wrap m-4">
        <div class="flex w-full ">
                    <div class=" w-full md:w-2/4">
            <x-frk.components.title label="Nuevo {{$title}}" />
        </div>
            <div class=" w-full md:w-1/4">
                <x-frk.components.label-input label="No abono"   wire:model.live="no_abono" />
            </div>
            <div class="flex w-full md:w-1/4">
                <x-frk.components.date-picker wire:model="fecha_abono" label="Fecha abono"/>
            </div>
        </div>


        <x-frk.components.divisor-line />


        <div class="flex w-full ">
            <div class="flex-none md:w-1/4">
                <x-frk.components.subtitle  label="DETALLE VENTA" />
            </div>
            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input  label="No venta" error="codigo" :disabled="$disabled" wire:model.live="no_venta" />
            </div>
            <div class=" flex w-full md:w-1/4">
                <x-frk.components.date-picker label="Fecha venta" :disabled="$disabled" wire:model.live="fecha_venta" />
            </div>
            <div class=" flex-none md:w-1/4">
                 <x-frk.components.button color="blue" label="Buscar" wire:click="buscarVenta()" />
            </div>
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
            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input-moneyy  label="total venta" error="total_venta" :disabled="$disabled" wire:model.live="total_venta"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
            </div>
                        <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input-moneyy  label="total Nota Credito" error="total_venta" :disabled="$disabled" wire:model.live="total_nota_credito"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
            </div>
            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input-moneyy  label="total Abono" error="total_venta" :disabled="$disabled" wire:model.live="total_abono"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
            </div>
            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input-moneyy label="Saldo credito " :disabled="$disabled" wire:model.live="saldo_credito"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
            </div>
        </div>

        <x-frk.components.divisor-line />

        <div class="flex w-full ">
            <div class=" w-full md:w-2/4">
                <x-frk.components.select label="Tipo Pago" error="tipo_pago_id" wire:model.live="tipo_pago_id">
                    @foreach ($this->tipo_pago as $data)
                    <option value="{{ $data['valor'] }}" >{{ $data['nombre']}} </option>
                    @endforeach
                </x-forms.select>
            </div>

            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input-moneyy  label="Cantidad Abono:" error="cantidad_abono"  wire:model.live="cantidad_abono"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
            </div>
            <div class="flex w-full md:w-1/4">
                <x-frk.components.label-input-moneyy label="Nuevo saldo:" error="nuevo_saldo" :disabled="$disabled" wire:model="nuevo_saldo"  @blur=" let v = parseFloat($event.target.value || 0); $event.target.value = v.toFixed(2);" />
            </div>
        </div>

        <div class="flex w-full ">
            <x-frk.components.label-input label="Observaciones:"   wire:model="observaciones" />
        </div>

        <div class="flex w-full ">
            <x-frk.components.label-input label="Detalle Pago"   wire:model="detalle_pago" />
        </div>
    </div>



    </x-slot>
    <x-slot:footer>
        <x-frk.components.button color="blue" label="guardar" wire:click.prevent="store()" />
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>

