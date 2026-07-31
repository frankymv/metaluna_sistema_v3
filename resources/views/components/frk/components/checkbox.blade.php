@props(['label'=>''])

<div class="flex w-full items-center border border-gray-200 mx-4 my-1 px-2  sm:p-2 sm:pb-2 rounded dark:border-gray-700">
    <input id="bordered-checkbox-1" type="checkbox"  name="bordered-checkbox" class="w-4 h-4 mr-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"  {{$attributes}} >
    <label for="bordered-checkbox-1" class="w-full text-sm font-medium text-gray-900 dark:text-gray-300">{{$label}}</label>
</div>




