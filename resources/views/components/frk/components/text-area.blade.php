@props(['label'=>'','error'=>'','placeholder'=>'Ingrese aqui','row'=>'2'])
@php
if ($error==='') {
    $error=$label;
}
@endphp


<div class="w-full flex-wrap items-center my-1 px-1 ">
    <x-frk.components.label label="{{$label}}" class="font-semibold text-sm capitalize"  />
    <!--<input class=" flex w-full rounded border border-gray-400 text-s px-2  py-1 leading-tight text-gray-700 focus:bg-white focus:outline-none" type="text" {{$attributes}} placeholder="{{$placeholder}}">-->
    <textarea id="message" rows="{{$row}}" class="flex w-full form-textarea border border-gray-400 text-sm shadow  text-gray-900  rounded-lg "  type="textarea" {{$attributes}} placeholder="{{$placeholder}}"></textarea>


    @include('components.frk.components.error')
</div>
