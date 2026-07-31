<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Detalle {{$title}}" />
    </x-slot>
    <x-slot:body>
        <div class="flex flex-wrap">
    <!-- //////////Base/////////////-->
    <div class="flex w-full">
        <div class="flex w-full md:w-1/6">
            <x-frk.components.label-input label="no envio" error="envio_no" :disabled="$disabled_envio_no" wire:model="envio_no" />
        </div>
        <div class="flex w-full md:w-1/6">
            <x-frk.components.date-picker wire:model="envio_fecha" error="envio_fecha" label="envio_fecha"/>
        </div>

    </div>

    <div class="flex w-full">
                <x-frk.components.select label="ruta_id" error="ruta_id" :disabled="$disabled" wire:model="ruta_id" >
            @foreach ($this->rutas as $data)
                <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
            @endforeach
        </x-frk.components.select>
    </div>

    <div class="flex w-full">
        <!-- //////////Ventas/////////////-->
        <div class=" flex-row w-full p-2 md:w-3/9 max-w-sm rounded overflow-hidden shadow-lg ">
            <section class="container mx-auto mt-2 ">
                <div class="w-full shadow-md sm:rounded-lg">
                    <table class="w-full">
                        <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                                <th class="px-2 py-1 w-5/6">
                                    Venta Asignada
                                </th>

                            </tr>
                        </thead>
                        <div class="flex w-full md:w-1/3">

                            <x-frk.components.error error="i" />
                        </div>
                        <tbody>

                            @foreach($inputsVenta as $key => $value)
                                <tr class="text-gray-700">
                                    <td class="px-4 py-1 text-sm border">
                                        <p>No:.  {{$noVenta[$key]}}, Total: {{$totalVenta[$key]}}</p>
                                        <p>Cliente:  {{$nombreCliente[$key]}}</p>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="flex w-full md:w-1/3">
                        <x-frk.components.error error="i" />
                    </div>
                </div>
            </section>
        </div>

        <!-- //////////Usuarios/////////////-->
        <div class=" flex-row w-full p-2 md:w-3/9 max-w-sm rounded overflow-hidden shadow-lg">

            <section class="container mx-auto mt-2 ">
                <div class="w-full  rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                                    <th class="px-2 py-1 w-5/6">
                                        Usuario
                                    </th>

                                </tr>
                            </thead>
                            <div class="flex w-full md:w-1/3">
                                <x-frk.components.error error="j" />
                            </div>
                            <tbody>
                                @foreach($inputsUsuario as $key => $value)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-1 text-sm border">
                                            <p>{{$usuarioDetalle[$value]}}</p>
                                        </th>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>


        <!-- //////////vehiculos/////////////-->
        <div class=" flex-row w-full p-2 md:w-3/9 max-w-sm rounded overflow-hidden shadow-lg">

            <section class="container mx-auto mt-2 ">
                <div class="w-full  rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                               <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                                    <th class="px-2 py-1 w-5/6">
                                        Vehiculo Asignado
                                    </th>

                                </tr>
                            </thead>
                            <div class="flex w-full md:w-1/3">
                                <x-frk.components.error error="k" />
                            </div>

                            <tbody>
                                @foreach($inputsVehiculo as $key => $value)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-1 text-sm border">
                                            <p>Codigo:.  {{$codigoVehiculo[$value]}}
                                            <p>Alias:  {{$aliasVehiculo[$value]}}</p>
                                        </th>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="flex w-full ">
        <x-frk.components.text-area label="observacion"  :disabled="$disabled"  wire:model="observaciones_inicio_envio" />
    </div>
</div>




    </x-slot>
    <x-slot:footer>

        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.components.template-create>

