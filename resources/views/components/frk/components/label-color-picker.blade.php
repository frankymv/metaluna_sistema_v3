
@props(['label'=>'','error'=>''])
@php
if ($error==='') {
    $error=$label;
}
@endphp

<div class="flex  my-1 px-1 ">
    <div class="md:w-2/4">
        <x-frk.components.label label="{{$label}}" class=" text-sm font-bold capitalize" />
        @include('components.frk.components.error')
    </div>
    <div class="md:w-2/4">
        <input class="flex w-full" type="color" {{$attributes}}   />
    </div>
</div>



