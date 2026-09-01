
    <x-frk.components.template-crud>
        <x-slot:title>
            <x-frk.components.title label="Detalle {{$title}}" />
        </x-slot>
        <x-slot:body>





            <div class="w-full p-2">

                <table class="w-full border-collapse border border-black text-sm">
                    {{-- Encabezado --}}
                    <tr>
                        <th colspan="2"
                            class="bg-orange-500 text-white font-bold text-center py-2 border border-black">
                            Estado Cuenta Cliente
                        </th>
                    </tr>

                    {{-- Datos Cliente --}}
                    <tr>
                        <td class="w-1/4 font-bold bg-gray-100 border border-black p-2">
                            Código Interno
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->id }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Código Mayorista
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->codigo_mayorista }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Tipo de Cliente
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->tipo_cliente }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Empresa
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->nombre_empresa }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Nombre Completo
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->nombres_cliente }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Teléfono Principal
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->telefono_principal }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Dirección
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->cliente?->direccion_fisica }}
                        </td>
                    </tr>

                    {{-- Encabezado Venta --}}
                    <tr>
                        <th colspan="2"
                            class="bg-orange-500 text-white font-bold text-center py-2 border border-black">
                            Venta
                        </th>
                    </tr>

                    {{-- Datos Venta --}}
                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            No_venta
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->no_venta }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Fecha Venta
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->fecha_venta }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Fecha Limite Crédito
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->fecha_limite_credito }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Vencimiento
                        </td>
                        <td class="border border-black p-2">
                            @if($venta->cancelado)
                                <span class="font-semibold text-gray-600">
                                    Cancelado
                                </span>
                            @else
                                {{ $venta->dias_vencimiento }} días
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Forma de pago
                        </td>
                        <td class="border border-black p-2">
                            {{ $venta->forma_pago_venta }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Total Venta
                        </td>
                        <td class="border border-black p-2">
                            Q. {{ number_format($venta->total_venta, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Total Crédito
                        </td>
                        <td class="border border-black p-2">
                            Q. {{ number_format($total_credito, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Total Abono
                        </td>
                        <td class="border border-black p-2">
                            Q. {{ number_format($total_abono, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Total Nota Crédito
                        </td>
                        <td class="border border-black p-2">
                            Q. {{ number_format($total_nota_credito, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td class="font-bold bg-gray-100 border border-black p-2">
                            Saldo Actual
                        </td>
                        <td class="border border-black p-2 font-bold">
                            Q. {{ number_format($saldo_actual, 2) }}
                        </td>
                    </tr>
                </table>

            </div>


        </x-slot>
        <x-slot:footer>
            <x-frk.components.button label="cancelar" wire:click.prevent="cancel()" />
        </x-slot>
   </x-frk.components.template-crud>
