@props(['icon'=>'','bg-color'=>'','data'=>'',])

<div
    class="flex-1 bg-quintoColor rounded-lg flex flex-col items-center justify-center p-4 space-y-2 border border-gray-200 m-2">
    <i class="fas fa-hand-holding-usd text-white text-4xl"></i>
    <p class="text-white">{{$slot}}</p>
</div>
