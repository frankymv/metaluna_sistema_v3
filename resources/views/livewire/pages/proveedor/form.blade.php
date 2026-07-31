<div class="flex flex-wrap w-full">
    <div class="w-full md:w-1/6 ">
        <x-frk.components.label-input label="nit" :disabled="$disabled" wire:model="nit" />
    </div>
    <div class="w-full md:w-2/6 ">
        <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
    </div>
    <div class="w-full md:w-3/6">
        <x-frk.components.label-input label="descripcion" :disabled="$disabled" wire:model="descripcion" />
    </div>

    <div class="w-full md:w-1/2">
        <x-frk.components.label-input label="nombre representante" error="nombre_representante" :disabled="$disabled" wire:model="nombre_representante" />
    </div>
    <div class="w-full md:w-1/4">
        <x-frk.components.label-input label="telefono principal" error="telefono_principal" :disabled="$disabled" wire:model="telefono_principal" />
    </div>
    <div class="w-full md:w-1/4">
        <x-frk.components.label-input label="telefono secundario" :disabled="$disabled" wire:model="telefono_secundario" />
    </div>

    <div class="w-full md:w-1/6">
        <x-frk.components.label-input label="correo electronico" :disabled="$disabled" wire:model="correo_electronico" />
    </div>

    <div class="w-full md:w-3/6">
        <x-frk.components.label-input label="direccion" error="direccion_fisica" :disabled="$disabled" wire:model="direccion_fisica" />
    </div>

    <div class="w-full md:w-1/6">
        <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model="direccion_departamento" >
        @foreach ($this->departamentos as $data)
            <option value="{{ $data['id'] }}" wire:key="departmento-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
        @endforeach
        </x-frk.components.select>
    </div>
    <div class="w-full md:w-1/6">
        <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model="direccion_municipio">
            @foreach ($this->municipios as $data)
                <option value="{{ $data['id']}}" wire:key="municipio-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
        </x-frk.components.select>
    </div>
        <x-frk.components.toggle :disabled="$disabled" label="estado"  />
</div>












