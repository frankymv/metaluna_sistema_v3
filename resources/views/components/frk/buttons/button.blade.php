@props(['label'=>'','color'=>'gray'])

<div class="flex">
    <button {{  $attributes->merge(['type' => 'submit', 'class' => "bg-$color-500 hover:bg-$color-800 text-white text-base capitalize  mx-2 px-2 rounded "]) }} >
        {{ $label }}
    </button>
</div>



