<div class="flex w-full flex-wrap m-4">
    <x-frk.components.label-input label="nombre" :disabled="$disabled" wire:model="nombre" />

 <x-frk.components.label label="Permisos:"/>
    @foreach ($permisson as $item)
        <x-frk.components.checkbox  wire:model.live="role_selected" :disabled="$disabled" value="{{$item->id}}" label="{{$item->name}}"   >
        </x-frk.components.checkbox >
    @endforeach
</div>
