@props(['name'=>'texto','show'=>'true','maxWidth'=>'3xl'])
<x-frk.components.modal name="{{$name}}" show="{{$show}}" maxWidth="{{$maxWidth}}">
        <x-slot:title>
            {{$title}}
        </x-slot>
        <x-slot:body>
            {{$body}}
        </x-slot>

        <x-slot:footer>
            {{$footer}}
        </x-slot>
</x-frk.components.modal>

