<div class="flex flex-wrap w-full">


    <x-frk.components.select label="Envio" error="envio_id" wire:model="envio_id" >
        @foreach ($this->envios as $data)
          <option value="{{ $data->id }}" wire:key="data-{{ $data->id }}">{{ $data->id }}</option>
        @endforeach
    </x-forms.select>

    <x-frk.components.select label="Estado" error="envio_id" wire:model="estado_id" >
        @foreach ($this->estados as $data)
          <option value="{{ $data['id']}}" wire:key="data-{{ $data['id'] }}">{{ $data['nombre'] }}</option>
        @endforeach
    </x-forms.select>

      <x-frk.components.label-input label="observacion" :disabled="$disabled" wire:model="observacion" />




  </div>
