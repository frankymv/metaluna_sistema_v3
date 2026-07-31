


<div class="p-2 bg-white border border-slate-200">
    <div>Total Venta: Q. {{ $row->total_venta}} Abono: Q. {{ $row->abono_venta}} Saldo: Q. {{ $row->saldo_venta }} </div>
    <div>Nombre cliente: {{$row->cliente->nombres_cliente}} {{$row->cliente->apellidos_cliente}} </div>
    <div>Empresa: {{$row->cliente->nombre_empresa}}  </div>

    <div>Tipo Cliente: {{$row->cliente->tipo_cliente}}  </div>
    <div>Detalle:</div>
    @foreach ($row->productos as $item)

        <div>CODIGO: {{$item->codigo}} NOMBRE PRODUCTO:{{$item->nombre}} NOMBRE PRODUCTO:{{$item->precio_venta_mayorista}}</div>

    @endforeach

    <div class="flex justify-end">
        <button wire:click.prevent="toggleDetail('{{ $id }}')" class="p-1 m-4 text-xs bg-red-600 text-white rounded-lg">Cerrar</button>
    </div>
</div>
