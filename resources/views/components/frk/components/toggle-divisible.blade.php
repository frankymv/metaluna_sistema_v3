
<div >
    <label class="block uppercase tracking-wide text-black text-xs font-bold" for="grid-first-name">
        Divisible
       </label>
    <div class="flex items-center m-2 cursor-pointer cm-toggle-wrapper"   wire:click="divisibleToggle()"  x-data="{valueData: @entangle('divisible')}">
        <span class="font-semibold text-xs mr-1">No</span>

        <div class="rounded-full w-8 h-4 p-0.5"  :class="{'bg-red-500': valueData === 0,'bg-green-500': valueData === 1}">
            <div class="rounded-full w-3 h-3 bg-white transform mx-auto duration-300 ease-in-out" disabled :class="{'-translate-x-2': valueData === 0,'translate-x-2': valueData === 1}"></div>
        </div>
        <span class="font-semibold text-xs ml-1">Si</span>

    </div>
</div>
