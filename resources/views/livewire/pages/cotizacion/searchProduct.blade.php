<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>
        <x-frk.components.title label="Buscar Producto" />
    </x-slot>

    <x-slot:body>
        <div class="flex flex-wrap w-full">
                <div class="    flex-wrap w-full">
                    <div class="flex-wrap w-full">
                        <div class="flex w-full ">
                            <x-frk.components.label-input label="buscar_producto" :disabled="$disabled" wire:model.live="buscar_producto" />
                            <x-frk.components.button label="cancelar" wire:click="cancelarBuscarProducto()" />
                        </div>
                        <div class="flex w-full">
                            <div class="flex w-full md:w-1/3 ">
                                <x-frk.components.select label="tipo" :disabled="$disabled" wire:model.live="id_tipo">
                                    @foreach ($this->tipos as $data)
                                    <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                                    @endforeach
                                </x-forms.select>
                            </div>
                            <div class="flex w-full md:w-1/3 ">
                                <x-frk.components.select label="marca" :disabled="$disabled" wire:model.live="id_marca">
                                    @foreach ($this->marcas as $data)
                                    <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                                    @endforeach
                                </x-forms.select>
                            </div>
                            <div class="flex w-full md:w-1/3 ">
                                <x-frk.components.select label="material" :disabled="$disabled" wire:model.live="id_material">
                                    @foreach ($this->materiales as $data)
                                    <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->nombre }}</option>
                                    @endforeach
                                </x-forms.select>
                            </div>
                        </div>
                    </div>


                    <section class="container mx-auto ">
                        <div class="w-full  rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-md  tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                                            <th class="px-2 py-1 w-1/9">
                                                Codigo
                                            </th>
                                            <th class="px-2 py-1 w-5/9">
                                                Producto
                                            </th>
                                            <th scope="col" class="px-2 py-1 w-2/9">
                                                Existencia
                                            </th>
                                            <th scope="col" class="px-2 py-1 w-1/9">
                                                Accion
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($productos)
                                            @foreach($productos as $key => $value)
                                                <tr class="bg-white  border-b dark:bg-gray-900 dark:border-gray-700">
                                                    <th class="px-4 py-3 text-sm border font-normal">
                                                        {{$value->codigo}}
                                                    </th>
                                                    <th class="px-2 py-1  text-sm whitespace-prewrap text-start  font-normal">
                                                        <p>-/ {{$value->nombre_venta}} /-</p>
                                                        
                                                        <p>{{$value->nombre}}</p>
                                                    </th>
                                                    <th class="px-4 py-3 text-sm border font-normal">
                                                        {{$value->existencia}}
                                                    </th>
                                                    <th class="px-2 py-1 font-normal">
                                                        @if (count($productosDetalle)===0)
                                                            <x-frk.buttons.plus-button label="+"  color="blue" wire:click="agregarCantidadProducto({{$value['id']}})" />
                                                        @else
                                                            @foreach ($productosDetalle as $item)
                                                                @if ($item['id']===$value['id'])
                                                                    <h1>---</h1>
                                                                @else
                                                                    <x-frk.buttons.plus-button label="Agregar" color="blue" wire:click="agregarCantidadProducto({{$value['id']}})" />
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </th>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <th class="px-2 py-1 font-normal text-sm whitespace-prewrap text-start ">
                                                    Seleccione una opcion..
                                                </th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
    </x-slot>

    <x-slot:footer>
    </x-slot>


</x-frk.modal>

