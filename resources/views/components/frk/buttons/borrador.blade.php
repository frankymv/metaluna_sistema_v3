@props(['label'=>''])

<div class="px-3 mb-3">
    <x-frk.buttons.button class="bg-yellow-500 hover:bg-yellow-700" {{  $attributes->merge([]) }} >
        {{ $label }}
    </x-button>
</div>







