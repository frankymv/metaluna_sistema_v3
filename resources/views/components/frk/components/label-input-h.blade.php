@props(['label'=>'','error'=>'','placeholder'=>'Ingrese aqui'])
@php
if ($error==='') {
    $error=$label;
}
@endphp

<div class="flex my-1 px-1 ">
    <div class="md:w-2/4">
        <x-frk.components.label label="{{$label}}"  />
        @include('components.frk.components.error')
    </div>
    <div class="md:w-2/4">
        <x-frk.components.input {{$attributes}}  placeholder="{{$placeholder}}" />
    </div>

</div>


