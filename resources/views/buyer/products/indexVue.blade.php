<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(trans('navigation.catalog')) }}
        </h2>
    </x-slot>
    
    <div id="app">
        <catalog-page></catalog-page>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</x-app-layout>
