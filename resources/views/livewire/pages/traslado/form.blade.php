<div class="flex flex-wrap">
    <div class="flex w-full ">
        <div class="flex w-full md:w-1/6">
            <x-frk.components.label-input label="No Traslado" error="traslado_no" :disabled="$disabled" wire:model="traslado_no" />
        </div>
        <div class="flex w-full md:w-1/6">
            <x-frk.components.date-picker wire:model="traslado_fecha" error="traslado_fecha" label="Traslado Fecha"/>
        </div>

    </div>
    <div class="flex w-full">
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="origen" error="sucursal_origen_id"  wire:model.live="sucursal_origen_id" >
                @foreach ($this->sucursals_origen as $data)
                <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="flex w-full md:w-1/2">
            <x-frk.components.select label="destino" error="sucursal_destino" :disabled="$disabledSucursalDestino" wire:model.live="sucursal_destino_id" >
                @foreach ($this->sucursals_destino as $data)
                <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-forms.select>
        </div>
    </div>
    @if (!$isShow)
    <div class="flex w-full ">
        <div class="flex w-full md:w-4/6">
            <x-frk.components.select label="producto" error="producto_id" :disabled="$disabled" wire:model.live="producto_id" id="producto_id">
                @foreach ($this->productos as $data)
                <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-forms.select>
        </div>
        <div class="flex w-full md:w-1/6">
            <x-frk.components.label-input label="existencia" error="cantidad_existencia" :disabled="$disabled_existencia" wire:model="cantidad_existencia" />
        </div>
        <div class="flex w-full md:w-1/6">
            <x-frk.components.label-input label="trasladar" error="trasladar" error="cantidad_transferir" :disabled="$disabled" wire:model.live="cantidad_transferir" />
        </div>
        <div class="flex w-full  flex-wrap md:w-1/6">
            <x-frk.components.label label="Accion"  />
            <x-frk.components.button color="blue" label="agregar" wire:click.prevent="addDetalle()" />
        </div>
    </div>

     <section class="container mx-auto ">
        <div class="w-full  rounded-lg shadow-lg">
          <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                        <th class="px-4 py-2">Productos</th>
                        <th class="px-4 py-2">Cantidad</th>
                        <th class="px-4 py-2">Accion</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($inputs!=null)
                        @foreach($inputs as $key => $value)
                            <tr class="text-gray-700">
                                <td class="px-4 py-1 text-sm border">
                                    {{$nombresDetalle[$value]}}
                                </td>
                                <td class="px-4 py-1 text-sm border">
                                     {{$cantidadesDetalle[$value]}}
                                </td>
                                <td class="px-4 py-1 text-sm border">
                                    @if (!$isShow)
                                        <x-frk.components.button label="-" color="red" wire:click.prevent="removeDetalle({{$key}})" />
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-gray-700">
                            <td class="px-4 py-1 text-sm border">
                                Sin productos
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

          </div>
        </div>
    </section>


    @endif







    <div class="flex w-full flex-col my-2">
        @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
        @endif
    </div>
    <!-- ///////////////////////////////////// -->
    <!-- //////////vehiculos/////////////-->
<!-- //////////vehiculos/////////////-->
<!-- //////////vehiculos/////////////-->
<!-- //////////vehiculos/////////////-->
</div>
