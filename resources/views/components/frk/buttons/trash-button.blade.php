@props(['label'=>'','icon'=>'fa-solid fa-question'])
<x-frk.buttons.button label="{{$label}}" class="bg-red-500 hover:bg-red-700" {{  $attributes->merge([]) }} >
    <i class="{{$icon}}"></i>
</x-frk.buttons.button>








