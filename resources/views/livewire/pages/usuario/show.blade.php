<div>
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Detalle {{$title}}" />
        </x-slot>
        <x-slot:body>
            <div class="flex flex-wrap w-full">

    <div class="flex w-full ">
        <div class="w-full md:w-1/6 ">
            <x-frk.components.label-input label="codigo" :disabled="$disabled" wire:model="codigo" />
        </div>
        <div class="w-full md:w-1/6 ">
            <x-frk.components.label-input label="cui" :disabled="$disabled" wire:model="cui" />
        </div>

        <div class="w-full md:w-2/6 ">
            <x-frk.components.label-input label="nombres" :disabled="$disabled" wire:model="nombres" />
        </div>
        <div class="w-full md:w-2/6 ">
            <x-frk.components.label-input label="apellidos" :disabled="$disabled" wire:model="apellidos" />
        </div>
    </div>

    <div class="flex w-full ">
        <div class="w-full md:w-1/5 ">
            <x-frk.components.date-picker wire:model="fecha_nacimiento" :disabled="$disabled"  label="Fecha de nacimiento"/>
        </div>
        <div class="w-full md:w-1/5">
            <x-frk.components.label-input label="telefono_principal" :disabled="$disabled" wire:model="telefono_principal" />
        </div>
        <div class="w-full md:w-1/5">
            <x-frk.components.label-input label="telefono_secundario" :disabled="$disabled" wire:model="telefono_secundario" />
        </div>
        <div class="w-full md:w-1/5 ">
            <x-frk.components.label-input label="tipo_sangre" :disabled="$disabled" wire:model="tipo_sangre" />
        </div>
        <div class="w-full md:w-1/5 ">
            <x-frk.components.label-input label="no_licencia" :disabled="$disabled" wire:model="no_licencia" />
        </div>
    </div>

    <div class="flex w-full ">
        <div class="w-full md:w-2/4 ">
            <x-frk.components.label-input label="email" :disabled="$disabled" wire:model="email" />
        </div>
        <div class="flex w-full md:w-1/2  ">
            <x-frk.components.date-picker wire:model="inicio_labores" :disabled="$disabled"  label="Fecha Inicio de Labores"/>
        </div>
        <div class="flex w-full md:w-1/2   ">
            <x-frk.components.date-picker wire:model="fin_labores" :disabled="$disabled"  label="Fecha Fin de Labores"/>
        </div>
    </div>
    <div class="w-full ">
        <x-frk.components.subtitle-section label="direccion domiciliar"  />
    </div>


    <div class="flex w-full ">
  <div class="w-full md:w-2/4">
            <x-frk.components.label-input label="direccion" error="direccion_fisica" :disabled="$disabled" wire:model="direccion_fisica" />
        </div>

 <div class="w-full md:w-1/4">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="direccion_departamento" >
            @foreach ($this->departamentos as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
            @endforeach
            </x-frk.components.select>
        </div>
        <div class="w-full md:w-1/4">
            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model="direccion_municipio">
                @foreach ($this->municipios as $data)
                    <option value="{{ $data['id']}}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>
    </div>

    <div class="flex w-full ">
        <div class="w-full md:w-1/3 ">
            <x-frk.components.label-input label="usuario" :disabled="$disabled" wire:model="usuario" />
        </div>
        <div class="w-full md:w-1/3 ">
            <x-frk.components.label-input label="password" :disabled="$disabled" wire:model="password" />
        </div>


        <div class="w-full md:w-1/3">
            <x-frk.components.label-input label="rol" error="direccion_fisica" :disabled="$disabled" wire:model="role_id" />
        </div>


    </div>






    <div class="flex w-full">
        <div class="w-full md:w-3/4">
            <x-frk.components.label-input label="sucursal" error="direccion_fisica" :disabled="$disabled" wire:model="sucursal_id" />
          </div>

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
