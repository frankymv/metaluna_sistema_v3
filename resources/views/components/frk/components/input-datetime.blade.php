@props(['label'=>'','placeholder'=>'Seleccione aqui'])
<div class="w-full flex-wrap items-center my-1 px-1 ">



        <x-frk.components.label label="{{$label}}" class="w-full text-base font-bold capitalize" />
        <div class="flex align-middle align-content-center">
            <input
            {{$attributes}}
                x-ref="datetime"
                type="text"
                id="datetime"
                data-input
                placeholder="{{$placeholder}}"
                class="border rounded border-gray-400 text-gray-900 text-base  focus:ring-blue-500 focus:border-blue-500 block w-full p-2 "
            >
    </div>
</div>
