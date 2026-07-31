

    <x-frk.components.template-crud maxWidth="3xl">

        <x-slot:title>

            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center">

                    <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>

                </div>

                <div>

                    <h2 class="text-xl font-bold text-gray-800">
                        Venta Completada
                    </h2>

                    <p class="text-sm text-gray-500">
                        La venta fue registrada exitosamente
                    </p>

                </div>

            </div>

        </x-slot:title>

        <x-slot:body>

            <div class="flex flex-col w-full space-y-5">

                {{-- RESUMEN PRINCIPAL --}}
                <div class="bg-orange-400 rounded-2xl p-6 text-white shadow-lg">

                    <div class="flex justify-between items-center">

                        <div>

                            <p class="text-orange-100 text-sm">
                                Venta Registrada
                            </p>

                            <p class="text-3xl font-bold">
                                #{{ $no_venta_detalle }}
                            </p>

                        </div>

                        <div class="text-right">

                            <p class="text-orange-100 text-sm">
                                Total Venta
                            </p>

                            <p class="text-3xl font-bold">
                                Q {{ number_format((float)$total_venta_detalle,2) }}
                            </p>

                        </div>

                    </div>

                </div>

                {{-- DATOS DE VENTA --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

                    <div class="flex items-center gap-2 mb-4">

                        <i class="fa-solid fa-receipt text-orange-500"></i>

                        <h3 class="font-semibold text-gray-700">
                            Información de la Venta
                        </h3>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <x-frk.components.label-input
                            label="No. Venta"
                            wire:model="no_venta_detalle"
                            disabled />

                        <x-frk.components.label-input-money
                            label="Total Venta"
                            wire:model="total_venta_detalle"
                            disabled />

                        <x-frk.components.label-input
                            label="No. Crédito"
                            wire:model="no_credito_detalle"
                            disabled />

                    </div>

                </div>

                {{-- CLIENTE --}}
                <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5">

                    <div class="flex items-center gap-2 mb-4">

                        <i class="fa-solid fa-user text-orange-500"></i>

                        <h3 class="font-semibold text-gray-700">
                            Cliente
                        </h3>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <x-frk.components.label-input
                            label="Nombres"
                            wire:model="nombres_cliente_detalle"
                            disabled />

                        <x-frk.components.label-input
                            label="Apellidos"
                            wire:model="apellidos_cliente_detalle"
                            disabled />

                    </div>

                </div>

            </div>

        </x-slot:body>

        <x-slot:footer>

            <div class="flex flex-col md:flex-row justify-center gap-3 w-full">

                    <a href="{{ route("pdfVentaRapida",$no_venta_detalle) }}" target="_blank">

                                            <button
                        class="inline-flex items-center gap-2 px-5 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl shadow-sm transition-all">

                        <i class="fa-solid fa-file-pdf"></i>

                        <span>
                            Imprimir PDF
                        </span>

                    </button>
                    </a>

                <button
                    wire:click.prevent="cancel()"
                    class="inline-flex items-center gap-2 px-5 py-3 bg-orange-400 hover:bg-orange-500 text-white rounded-xl shadow-sm transition-all">

                    <i class="fa-solid fa-arrow-right"></i>

                    <span>
                        Continuar
                    </span>

                </button>

            </div>

        </x-slot:footer>

    </x-frk.components.template-crud>

