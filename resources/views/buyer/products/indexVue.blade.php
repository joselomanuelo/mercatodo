<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(trans('navigation.catalog')) }}
        </h2>
    </x-slot>
    
    <div id="app">
        <index-page></index-page>
    </div>
    
</x-app-layout>
