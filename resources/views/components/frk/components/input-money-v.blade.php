@props(['label'=>'','error'=>'','placeholder'=>'Ingrese aqui'])
@php
if ($error==='') {
    $error=$label;
}
@endphp

<div class="w-full flex-wrap items-center my-1 px-1 ">

        <x-frk.components.label label="{{$label}}" class=" text-sm font-bold capitalize" />
        @include('components.frk.components.error')


        <div class="relative rounded-md shadow-sm">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <span class="text-gray-500 sm:text-sm">Q</span>
            </div>
            <input type="text" {{$attributes}}  name="price" id="price" class="block w-full rounded-md border-0 py-1.5 pl-7 pr-20 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="0.00">
          </div>

</div>








