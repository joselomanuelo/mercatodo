<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(trans('buttons.show') . ' ' . $product->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <ul>
                        <li>
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="Image" width="200px"
                                height="200px">
                        </li>
                        <li>
                            <h3>Id: {{ $product->id }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('products.name') . ': ' . $product->name }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('products.description') . ': ' . $product->description }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('products.price') . ': ' . money($product->price.'00') }}
                            </h3>
                        </li>
                        <li>
                            <h3>Stock: {{ number_format($product->stock, 0, ',','.') }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.createdAt') . ': ' . $product->created_at }}</h3>
                        </li>
                        <li>
                            <h3>{{ trans('auth.updatedAt') . ': ' . $product->updated_at }}</h3>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
