<div class="p-2">

    <p class=" text-gray-600 font-bold">
        Cancelado:
    </p>

    @if($venta->cancelado_total_venta == 0)
        <p class=" text-gray-600">
            No
        </p>
    @else
        <p class=" text-green-600 font-semibold">
            Sí
        </p>
    @endif


    <p class=" text-gray-600 font-bold mt-2">
        Anulado:
    </p>

    @if($venta->anulado == 0)
        <p class=" text-gray-600">
            No
        </p>
    @else
        <p class=" text-red-600 font-semibold">
            Sí
        </p>
    @endif

</div>
