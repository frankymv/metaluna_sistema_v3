


<div class="mh-10 p-2 bg-white border border-slate-200">
    <div>DESCRIPCION:</div>
    @foreach ($row->sucursales as $suc )

        <li>SUCURSAL: {{$suc->nombre }} CANTIDAD: {{$suc->pivot->cantidad}}</li>
    @endforeach
    <div class="flex justify-star">
        <button wire:click.prevent="toggleDetail('{{ $id }}')" class="p-1 m-2 text-xs bg-red-600 text-white rounded-lg">Cerrar</button>
    </div>
</div>
