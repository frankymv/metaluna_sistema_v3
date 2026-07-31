@props(['label'=>'','error'=>null,'placeholder'=>'Ingrese aqui','moneda'=>''])
@php
if ($error==null) {
    $error=$label;
}
@endphp

<div class="flex items-center pt-2">
    <label  class='font-semibold text-sm mr-2 capitalize text-center'>{{$label}}</label>
    <!--<input class="w-full border border-gray-400 text-sm shadow  text-gray-900 rounded-md mx-1 placeholder-gray-400 " {{$attributes}}  placeholder="{{$placeholder}}" >-->
    <x-frk.components.input   {{$attributes}}  placeholder="{{$placeholder}}" moneda="{{$moneda}}" />
    @error("$error") <span class="text-xs text-red-500 font-bold ">{{ $message }}</span>@enderror
</div>


