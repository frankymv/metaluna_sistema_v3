@props([
    'label' => '',
    'error' => null,
    'placeholder' => 'Ingrese aquí',
    'moneda' => 'Q',
    'decimales' => 2,
    'step' => '0.01',
    'min' => 0,
])

@php
    $error ??= $label;
@endphp

<div class="w-full px-1">
    <x-frk.components.label
        :label="$label"
        class="font-semibold text-sm capitalize"
    />

    <div class="relative">
        @if($moneda)
            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
                {{ $moneda }}
            </span>
        @endif

        <x-frk.components.input
            {{ $attributes }}
            type="number"
            :placeholder="$placeholder"
            :step="$step"
            :min="$min"
            class="{{ $moneda ? 'pl-8' : '' }}"
        />
    </div>

    @include('components.frk.components.error')
</div>
