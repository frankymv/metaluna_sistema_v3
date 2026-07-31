@props(['label'=>'','error'=>'','placeholder'=>'Ingrese aqui'])
@php
if ($error==='') {
    $error=$label;
}
@endphp

<div class="w-full flex-wrap items-center my-1 px-1 ">
    <x-frk.components.label label="{{$label}}" class="font-semibold capitalize"  />
    @include('components.frk.components.error')
</div>
