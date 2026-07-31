<x-frk.components.template-crud>
    <x-slot:title>
        <x-frk.components.title label="Detalle {{$title}}" />
    </x-slot>
    <x-slot:body>
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




    </x-slot>
    <x-slot:footer>

        <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
    </x-slot>
</x-frk.modal>

