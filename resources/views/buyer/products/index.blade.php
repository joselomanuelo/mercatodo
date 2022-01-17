<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(trans('navigation.catalog')) }}
        </h2>
    </x-slot>
    <main class="my-8">
        <div class="container mx-auto px-6">
            <div class="m-4">
                {{ $products->links() }}
            </div>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">
                @foreach ($products as $product)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover">
                            <img src="{{ asset($product->product_image) }}" alt="{{ $product->name }}">
                        </div>
                        <div class="px-5 py-3" >
                            <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                            <span class="text-gray-500 mt-2">${{ $product->price }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="m-4">
                {{ $products->links() }}
            </div>
        </div>
    </main>
</x-app-layout>
