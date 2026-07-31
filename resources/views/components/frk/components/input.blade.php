@props(['placeholder'=>'Ingrese aqui','type'=>'text'])

<input type="{{$type}}" {!! $attributes->merge(['class' => "flex w-full  border border-gray-400 text-sm py-0.5 px-2  shadow  text-gray-900 rounded-md placeholder-gray-400"]) !!} {{$attributes}} placeholder="{{$placeholder}}" >
