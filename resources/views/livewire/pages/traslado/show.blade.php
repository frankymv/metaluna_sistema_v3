<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Detalle {{$title}}" />
    </x-slot>
    <x-slot:body>
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
    <section class="container mx-auto ">
        <div class="w-full  rounded-lg shadow-lg">
          <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                        <th class="px-4 py-2">Productos</th>
                        <th class="px-4 py-2">Cantidad</th>
                    </tr>
                </thead>
                <tbody class="bg-white">

                        @foreach($inputs as $key => $value)
                            <tr class="text-gray-700">
                                <td class="px-4 py-1 text-sm border">
                                    {{$nombresDetalle[$value]}}
                                </td>
                                <td class="px-4 py-1 text-sm border">
                                     {{$cantidadesDetalle[$value]}}
                                </td>
                                <td class="px-4 py-1 text-sm border">

                                </td>
                            </tr>
                        @endforeach

                </tbody>
            </table>

          </div>
        </div>
    </section>










    <div class="flex w-full flex-col my-2">

        <div class="flex w-full ">
            <x-frk.components.label-input label="Fecha creacion" :disabled="$disabled" wire:model="created_at" />
            <x-frk.components.label-input label="Fecha Modificación" :disabled="$disabled" wire:model="updated_at" />
        </div>

    </div>
    <!-- ///////////////////////////////////// -->
    <!-- //////////vehiculos/////////////-->
<!-- //////////vehiculos/////////////-->
<!-- //////////vehiculos/////////////-->
<!-- //////////vehiculos/////////////-->
</div>


    </x-slot>
    <x-slot:footer>
        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>

