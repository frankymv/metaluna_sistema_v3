@props(['label'=>'','error'=>null,'placeholder'=>'Ingrese aqui','moneda'=>''])
@php
if ($error==null) {
    $error=$label;
}
@endphp

<div class="w-full flex items-center px-1">
    <div class="flex items-center ">
        <x-frk.components.label label="{{$label}}" class="font-semibold text-sm capitalize text-center" />
    </div>
    <div class="w-full flex">

        <input type="" class = "flex w-full  text-sm shadow  text-gray-900 rounded-md  pt-1 pb-1 px-2 placeholder-gray-400 focus:outline-none focus:shadow-outline" {{$attributes}} " >

    </div>
</div>


