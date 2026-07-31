<div class="flex flex-wrap w-full">

    <div class="flex w-full ">
        <div class="w-full md:w-1/5 ">
            <x-frk.components.select label="Tipo Cliente" :disabled="$disabled"  error="tipo_cliente_id" wire:model.live="tipo_cliente_id">
                @foreach ($this->tipo_clientes as $data)
                <option value="{{ $data['valor'] }}" wire:key="producto-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-forms.select>
        </div>

        <div class="w-full md:w-1/5 ">
            <x-frk.components.label-input label="codigo_interno" :disabled="$disabled_codigo_interno" wire:model.live="codigo_interno" />
        </div>


        <div class="w-full md:w-1/5 ">
            <x-frk.components.label-input label="nit" :disabled="$disabled" wire:model="nit" />
        </div>
        @if (!$isDisabledMinorista)
            <div class="w-full md:w-1/5">
                <x-frk.components.label-input label="numero_patente" :disabled="$disabled" wire:model="numero_patente" />
            </div>
            <div class="w-full md:w-1/5 ">
                <x-frk.components.label-input label="codigo_mayorista" :disabled="$disabledCodigo"  wire:model="codigo_mayorista" placeholder="Código generado automaticamente"/>
            </div>
        @endif
    </div>



    <div class="flex flex-wrap w-full">
        <div class="w-full md:w-2/5 ">
            <x-frk.components.label-input label="nombres cliente" error="nombres_cliente" :disabled="$disabled" wire:model="nombres_cliente" />
        </div>
        <div class="w-full md:w-2/5">
            <x-frk.components.label-input label="apellidos_cliente" :disabled="$disabled" wire:model="apellidos_cliente" />
        </div>


        <div class="w-full md:w-1/5">

            <x-frk.components.label-input label="telefono_principal" :disabled="$disabled" wire:model="telefono_principal" />
        </div>




    </div>


    <div class="w-full md:w-4/5 ">
        <x-frk.components.label-input label="nombre_empresa" :disabled="$disabled" wire:model="nombre_empresa" />
    </div>

    <div class="w-full md:w-1/5">
        <x-frk.components.label-input label="telefono_secundario" :disabled="$disabled" wire:model="telefono_secundario" />
    </div>



 <div class="flex w-full">
    <div class="w-full md:w-3/4">
        <x-frk.components.label-input label="correo_electronico" :disabled="$disabled" wire:model="correo_electronico" />
    </div>

    @if(!$isDisabledMinorista)
    <div class="w-full md:w-1/4">

        <x-frk.components.label-input label="cui" :disabled="$disabled" wire:model="cui" />

    </div>
    @endif
 </div>




    <div class=" w-full flex-wrap ">

        <div class="w-full ">
            <x-frk.components.label label="direccion domiciliar"  />
        </div>
        <div class="flex w-full flex-wrap  ">
            <div class="w-full md:w-2/4">
                <x-frk.components.label-input label="direccion" error="direccion_fisica" :disabled="$disabled" wire:model="direccion_fisica" />
            </div>

        @if (!$isShow)

            <div class="w-full md:w-1/4">
                <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="direccion_departamento" >
                    @foreach ($this->departamentos as $data)
                        <option value="{{ $data->id }}" wire:key="department-{{ $data->id }}">{{ $data->nombre }}</option>
                    @endforeach
                </x-frk.components.select>
            </div>
            <div class="w-full md:w-1/4">
                <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model="direccion_municipio">
                    @foreach ($this->municipios as $data)
                        <option value="{{ $data->id }}" wire:key="department-{{ $data->id }}">{{ $data->nombre }}</option>
                    @endforeach
                </x-frk.components.select>
            </div>


        @else

                <div class="w-full md:w-1/4">
                    <x-frk.components.label-input label="departamento" :disabled="$disabled" wire:model="departamento" />
                </div>
                <div class="w-full md:w-1/4">
                    <x-frk.components.label-input label="municipio" :disabled="$disabled" wire:model="municipio" />
                </div>

        @endif
        </div>
    </div>

    @if (!$isDisabledMinorista)
        <div class="flex w-full">
            <div class="w-full md:w-1/4">
                <x-frk.components.label-input label="latitud:" :disabled="$disabled" wire:model="ubicacion_latitud" />
            </div>
            <div class="w-full md:w-1/4">
                <x-frk.components.label-input label="longitud:" :disabled="$disabled" wire:model="ubicacion_longitud" />
            </div>
            <div class="w-full md:w-1/4">
                <x-frk.components.label-input label="limite_credito: Q" :disabled="$disabled" error="limite_credito" wire:model="limite_credito" />
            </div>
            <div class="w-full md:w-1/4">
                <x-frk.components.label-input label="dias_limite_credito:" :disabled="$disabled" wire:model="dias_limite_credito" />
            </div>
        </div>
    @endif

    <div class="flex w-full">

            <x-frk.components.toggle :disabled="$disabled" label="estado"  />


    </div>










    @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
    @endif


</div>
