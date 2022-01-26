<x-app-layout>
    <x-slot name="header">
        <h2 class="ml-4 font-semibold text-xl text-gray-800 leading-tight">
            {{ __($product->name) }}
        </h2>
    </x-slot>
    <main class="my-8">
        <div class="container mx-auto px-6">
            <div class="w-full max-w-lg mx-auto rounded-md shadow-md overflow-hidden">
                <div class="flex items-end justify-end h-72 w-full bg-cover">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->name }}">
                </div>
                <div class="px-5 py-3">
                    <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                    <span
                        class="text-gray-500 mt-2">{{ trans('products.price') . ': ' . Cknow\Money\Money::COP($product->price . '00') }}</span><br>
                    <span class="text-gray-500 mt-2">Stock: {{ number_format($product->stock) }}</span><br>
                    <span
                        class="text-gray-500 mt-2">{{ trans('products.category') . ': ' . $product->category->name }}</span><br>
                    <span
                        class="text-gray-500 mt-2">{{ trans('products.description') . ': ' . $product->description }}</span>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
