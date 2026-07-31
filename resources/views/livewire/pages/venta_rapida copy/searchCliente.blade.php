<x-frk.components.template-crud maxWidth="3xl">
    <x-slot:title>
        <x-frk.components.title label="Buscar Cliente" />
    </x-slot>

        <x-slot:body>
            <div class="flex flex-wrap w-full">
                    <div class="    flex-wrap w-full">
                        <div class="flex-wrap w-full">
                            <div class="flex w-full ">
                                <x-frk.components.label-input label="codigo_cliente" :disabled="$disabled" wire:model.live="search_codigo_cliente" />
                                <x-frk.components.label-input label="nombres_cliente" :disabled="$disabled" wire:model.live="search_nombres_cliente" />
                                <x-frk.components.label-input label="nit_cliente" :disabled="$disabled" wire:model.live="search_nit_cliente" />
                                <x-frk.components.button label="cancelar" wire:click="cancelarBuscarCliente()" />
                            </div>

                        </div>

                        @if ($clientes)

                    <section class="container mx-auto ">
                        <div class="w-full  rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-200 uppercase border-gray-900">
                                        <th class="px-2 py-1 w-2/12">
                                            Codigo
                                        </th>
                                        <th class="px-2 py-1 w-4/12">
                                            Nombre completo
                                        </th>
                                        <th class="px-2 py-1 w-4/12">
                                            Empresa
                                        </th>
                                        <th class="px-2 py-1 w-1/12">
                                            Tipo
                                        </th>
                                        <th class="px-2 py-1 w-1/12">
                                            Accion
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($clientes as $key => $value)
                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                        <th class="px-2 py-1 text-sm whitespace-prewrap dark:text-white">
                                            Int. {{$value->codigo_interno}}</br>
                                            May: {{$value->codigo_mayorista}}
                                        </th>
                                        <th class="px-4 py-3 text-sm border">
                                            {{$value->nombres_cliente}}
                                        </th>

                                        <th class="px-4 py-3 text-sm border">
                                            {{$value->nombre_empresa}}
                                        </th>
                                        <th class="px-4 py-3 text-sm border">
                                            {{$value->tipo_cliente}}
                                        </th>

                                        <th class="px-2 py-1">
                                            <x-frk.buttons.plus-button color="blue" label="+" wire:click="agregarCliente({{$value['id']}})" />
                                        </th>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @endif

                    </div>
                </div>
        </x-slot>

    <x-slot:footer>
    </x-slot>


</x-frk.modal>

