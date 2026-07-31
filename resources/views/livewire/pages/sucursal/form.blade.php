<div class="flex w-full flex-wrap m-4">

    <div class="flex w-full">
        <div class="w-full md:w-1/6">
            <x-frk.components.label-input label="codigo" :disabled="$disabled" wire:model="codigo" />
        </div>

        <div class="w-full md:w-2/6">
            <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
        </div>
        <div class="w-full md:w-3/6">
            <x-frk.components.label-input label="direccion_fisica" :disabled="$disabled" wire:model="direccion_fisica" />
        </div>
    </div>
    <div class="flex w-full">

        <div class="w-full md:w-1/4">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="direccion_departamento" >
            @foreach ($this->departamentos as $data)
                <option value="{{ $data['id'] }}" wire:key="departmento-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model="direccion_municipio">
                @foreach ($this->municipios as $data)
                    <option value="{{ $data['id']}}" wire:key="municipio-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.label-input label="telefono_principal" :disabled="$disabled" wire:model="telefono_principal" />
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.label-input label="telefono_secundario" :disabled="$disabled" wire:model="telefono_secundario" />
        </div>
    </div>


    <div class="flex w-full ">

        <div class="flex w-full md:w-1/3"  x-data="{open: @entangle('bodega')}"  >
            <x-frk.components.toggle :disabled="$disabled" label="bodega" left="SI" right="NO"   />
        </div>
        <div class="flex w-full md:w-1/3"  x-data="{open: @entangle('visible')}"  >
            <x-frk.components.toggle :disabled="$disabled" label="visible" left="SI" right="NO"   />
        </div>
        <div class="flex w-full md:w-1/3"  x-data="{open: @entangle('estado')}"  >
            <x-frk.components.toggle :disabled="$disabled" label="estado" left="SI" right="NO"   />
        </div>
    </div>





    @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
    @endif
</div>
