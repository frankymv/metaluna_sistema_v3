<div class="flex flex-wrap w-full">
    <div class="flex flex-wrap w-full">
        <div class="w-full md:w-1/4 ">
            <x-frk.components.label-input label="codigo" :disabled="$disabled" wire:model="codigo" />
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.select label="Tipo Vehiculo" error="tipo_vehiculo_id" :disabled="$disabled" wire:model="tipo_vehiculo_id" >
            @foreach ($this->tipos as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.select label="Tipo Placa" error="tipo_placa_id" :disabled="$disabled" wire:model="tipo_placa_id" >
            @foreach ($this->placas as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>
        </div>

        <div class="w-full md:w-1/4 ">
            <x-frk.components.label-input label="numero_placa" :disabled="$disabled" wire:model="numero_placa" />
        </div>
    </div>


    <div class="flex flex-wrap w-full">

        <div class="w-full md:w-1/4">
            <x-frk.components.select label="Marca" error="marca_vehiculo_id" :disabled="$disabled" wire:model="marca_vehiculo_id" >
            @foreach ($this->marcas as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.select label="Modelo" error="modelo_vehiculo" :disabled="$disabled" wire:model="modelo_vehiculo_id" >
            @foreach ($this->modelos as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>
        </div>
        <div class="w-full md:w-1/4 ">
            <x-frk.components.label-input label="linea" :disabled="$disabled" wire:model="linea" />
        </div>
        <div class="w-full md:w-1/4 ">

            <x-frk.components.label-input label="alias" :disabled="$disabled" wire:model="alias" />
        </div>
    </div>



        <x-frk.components.toggle :disabled="$disabled" label="estado"  />


    @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
    @endif
</div>
