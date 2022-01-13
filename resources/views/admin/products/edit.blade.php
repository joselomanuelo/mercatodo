<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans('buttons.edit').' '.__($product->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('admin.products.update', $product) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <x-label for="name" :value="__(trans('auth.name'))" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->name }}" required autofocus />
                        </div>
                        <div class="mt-4">
                            <x-label for="description" :value="__(trans('products.description'))" />
                            <x-textarea id="description" class="block mt-1 w-full" name="description" required>
                                {{ __($product->description) }}
                            </x-textarea>
                        </div>
                        <div class="mt-4">
                            <x-label for="price" :value="__(trans('products.price'))" />
                            <x-input id="price" class="block mt-1 w-full" type="text" name="price" value="{{ $product->price }}" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="stock" :value="__('Stock')" />
                            <x-input id="stock" class="block mt-1 w-full" type="text" name="stock" value="{{ $product->stock }}" required />
                        </div>
                        <div class="mt-4">
                            <x-label for="category" :value="__(trans('products.category'))" />
                            <select name="category" id="category" class="block mt-1 w-full" required>
                                @foreach ($categories as $category)
                                    <option @if($product->category == $category) selected @endif value={{ $category->id }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __(trans('buttons.save')) }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
