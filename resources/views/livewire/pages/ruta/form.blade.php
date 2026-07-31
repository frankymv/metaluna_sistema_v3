<div class="flex flex-wrap">
    <div class="w-full md:w-1/2">
        <x-frk.components.label-input label="codigo" :disabled="$disabled" wire:model="codigo" />
    </div>

    <div class="w-full md:w-1/2">
        <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />
    </div>
        <div class="w-full">
        <x-frk.components.text-area label="descripcion" row=¨2¨ :disabled="$disabled" wire:model="descripcion" />

    </div>


    <div class="flex w-full">
        <div class="flex w-full md:w-2/9">
            <x-frk.components.select label="departamento" error="direccion_departamento" :disabled="$disabled" wire:model.live="departamento_id" >
              @foreach ($this->departamentos as $data)
              <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
              @endforeach
            </x-frk.components.select>

        </div>
        <div class="flex w-full md:w-2/9">
            <x-frk.components.select label="municipio" error="direccion_municipio" :disabled="$disabled" wire:model.live="municipio_id">
                @foreach ($this->municipios as $data)
                <option value="{{ $data['id'] }}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
                @endforeach
            </x-frk.components.select>
        </div>

        <div class="flex w-full md:w-4/9">
            <x-frk.components.label-input label="Observaciones" :disabled="$disabled" wire:model="observaciones" />
        </div>


        <div class="flex flex-wrap md:w-1/9">
            <x-frk.components.label label="Agregar" class="font-semibold capitalize"/>
            <x-frk.components.button color="blue" label="+" wire:click.prevent="addDetalle()" />
        </div>
        </div>



        <div class="flex w-full ">
                <x-frk.components.subtitle label="Detalle Ruta" />
        </div>

        <div class="flex w-full">
            <section class="container mx-auto ">
                <div class="w-full  rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                                <th class="px-4 py-2 text-ms font-semibold border w-3/12 ">
                                    Departamento
                                </th>
                                <th class="px-4 py-2 w-3/12">
                                    Municipio
                                </th>

                                <th class="px-4 py-2 w-5/12">
                                    Observacion
                                </th>
                                <th class="px-4 py-2 w-1/12">
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        @if ($inputs!=null)
                            <tbody>
                                @foreach($inputs as $key => $value)
                                    <tr class="text-gray-700">
                                    <td class="px-4 py-1 text-sm font-semibold border">
                                            {{$nombreDepartamento[$value]}}
                                        </th>
                                        <td class="px-4 py-1 text-sm border">
                                            {{$nombreMunicipio[$value]}}
                                        </th>
                                        <td class="px-4 py-1 text-sm border">
                                            {{$observacionDetalle[$value]}}
                                        </th>
                                        <td class="px-4 py-1 text-sm border">
                                            <x-frk.components.button label="-" color="red" wire:click.prevent="removeDetalle({{$value}})" />
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        @else
                            <tbody>
                                <tr class="text-gray-700">
                                    <td class="px-4 py-1 text-sm font-semibold border">
                                                                        <x-frk.components.label-error label="Sin Departamentos" error="inputs"/>
                                    </th>
                                </tr>
                            </tbody>
                        @endif
                    </table>
                </div>
                </div>
            </section>
        </div>
    </div>









</div>
