<div class="flex w-full flex-wrap m-4">
    <div class="flex w-full ">
        <div class=" w-full  md:w-3/6">
            <x-frk.components.select label="Venta Numero" :disabled="$disabled" error="venta_id" wire:model="venta_id" id="venta_id">
                @foreach ($this->ventas_credito as $data)
                <option value="{{ $data->id }}" wire:key="tipo-{{ $data->id }}">No. Venta: {{ $data->no_venta }} Saldo:{{ $data->saldo_venta }}</option>
                @endforeach
            </x-forms.select>
        </div>

        <div class=" w-full md:w-1/6">
            <x-frk.components.input-money  label="Credito Actual" error="cantidad_credito_actual" :disabled="$disabled" wire:model="cantidad_credito_actual" />

        </div>
        <div class=" w-full md:w-1/6">
            <x-frk.components.input-money  label="Abono" error="cantidad_abono" :disabled="$disabled" wire:model="cantidad_abono" />
        </div>
        <div class=" w-full md:w-1/6">
            <x-frk.components.input-money label="Saldo" error="saldo_credito" :disabled="$disabled" wire:model="saldo_credito" />
        </div>
    </div>
    @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
    @endif
</div>
