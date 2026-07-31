


<div class="p-2 bg-white border border-slate-200">
    <div>SKU: {{ $row->sku }}</div>
    <div>Existencia: {{ $row->existencia }}</div>
    <div>Precio Mayorista: Q. {{ $row->precio_venta_mayorista }}  Precio Minorista: Q. {{ $row->precio_venta_minorista }}</div>

    <div>Presentación {{ $row->cantidad_presentacion }} {{ $row->unidadmedida->nombre }}</div>
    <div>Descripcion: {{ $row->descripcion }}</div>
    <div class="flex justify-end">
        <button wire:click.prevent="toggleDetail('{{ $id }}')" class="p-1 text-xs bg-red-600 text-white rounded-lg">Cerrar</button>
    </div>
</div>
