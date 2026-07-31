@props(['label'=>'','error'=>'','placeholder'=>'Ingrese aqui'])

@php
if ($error==='') {
    $error=$label;
}
@endphp


<div class="flex  w-full items-center my-1 px-1">
    <div class="md:w-1/4">
    <x-frk.components.label label="{{$label}}" class="w-full  text-sm font-bold capitalize" />
    @error("$error") <span class="text-s text-red-500 font-bold ">{{ $message }}</span>@enderror
</div>
<div class="md:w-3/4">
    <select {{$attributes}} class=" flex w-full form-select " >
            <option  value="null" disabled>{{ __('Seleccione una opcion') }}</option>
            {{ $slot}}
    </select>
</div>

</div>

