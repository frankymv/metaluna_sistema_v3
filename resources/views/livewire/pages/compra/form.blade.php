<div class="flex flex-wrap">

    <div class="flex w-full ">
        <div class="flex w-full md:w-2/6">
            <x-frk.components.label-input label="compra no" error="compra_no" :disabled="$disabled" wire:model="compra_no" />
        </div>

        <div class="flex w-full md:w-2/6">
            <x-frk.components.label-input label="no recibo compra" error="no_recibo_compra" :disabled="$disabled" wire:model="no_recibo_compra" />
        </div>
        <div class="flex w-full md:w-2/6">
            <x-frk.components.date-picker wire:model="compra_fecha" error="compra_fecha" label="Fecha de Compra"/>
        </div>
    </div>
    <div class="flex w-full ">
        <div class="flex w-full md:w-3/6">
            <x-frk.components.select label="proveedor" error="proveedor_id" :disabled="$disabled" wire:model="proveedor_id" id="marca_id">
                @foreach ($this->proveedores as $data)
                <option value="{{ $data->id }} " wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-forms.select>
    </div>
    <div class="flex w-full md:w-3/6">
            <x-frk.components.select label="Sucursal" error="sucursal_id" :disabled="$disabled" wire:model="sucursal_id" >
                @foreach ($this->sucursals as $data)
                <option value="{{ $data->id }} " wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-forms.select>
        </div>
    </div>


    @if (!$isShow)
    <div class="flex w-full ">
        <div class="flex w-full md:w-4/6">
            <x-frk.components.select label="producto" error="producto_id" :disabled="$disabled" wire:model="producto_id" >
                @foreach ($this->productos as $data)
                <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                @endforeach
            </x-forms.select>
        </div>

        <div class="flex w-full md:w-1/6">
            <x-frk.components.label-input label="cantidad" :disabled="$disabled" wire:model="cantidad" />
        </div>


        <div class="flex flex-wrap md:w-1/6">
            <x-frk.components.label  label="Agregar" class="font-semibold capitalize"/>
            <x-frk.components.button color="blue" label="+" wire:click.prevent="addDetalle()" />
        </div>
    </div>
    @endif


    <div class="flex w-full ">
            <x-frk.components.subtitle label="Detalle compra" />

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




    <div class="flex w-full flex-col my-2">
        @if ($isShow)
        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>
        @endif
    </div>

</div>
