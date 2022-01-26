<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="grid grid-cols-2 bg-white shadow">
            <div class="flex justify-start items-center py-2 pl-16">
                {{ $header }}
            </div>
            <div class="flex justify-end items-center py-2 pr-10">
                @if (request()->routeIs(App\Constants\RouteNames::INDEX_PRODUCTS))
                    <form action="{{ App\Models\Product::indexRoute() }}" method="GET" class="ml-4">
                        <x-input id="search" type="text" name="search" />
                        <x-button class="ml-2">
                            {{ __(trans('buttons.search')) }}
                        </x-button>
                    </form>
                    <div class="mr-4">
                        <x-button-link class="ml-4" href="{{ App\Models\Product::createRoute() }}">
                            {{ __(trans('products.new')) }}
                        </x-button-link>
                    </div>
                @endif
                
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
