@props(['name'=>'texto','show'=>'true','maxWidth'=>'4xl'])
<x-frk.components.modal name="{{$name}}" show="{{$show}}" maxWidth="{{$maxWidth}}">
        <x-slot:title>


           <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                    <i class="fa-solid fa-pencil text-orange-500"></i>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">
                    {{$title}}
                    </h2>
                </div>
            </div>


        </x-slot>
        <x-slot:body>
            {{$body}}
        </x-slot>

        <x-slot:footer>
            {{$footer}}
        </x-slot>
</x-frk.components.modal>

