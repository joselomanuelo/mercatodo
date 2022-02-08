<template>
    <div class="my-8">
        <div class="container mx-auto px-6">
            <form action="{{ App\Models\Product::buyerIndexRoute() }}" method="GET" class="grid grid-cols-7 gap-3">
                <x-input id="search" type="text" name="search" class="col-span-6"/>
                <x-button class="row-span-2">
                    {{ __(trans('buttons.search')) }}
                </x-button>
                <div class="flex justify-center items-center col-span-2 ">
                    <x-label for="category" :value="__(trans('products.category'))" class="mx-4" />
                    <x-select name="category" id="category" class="w-full">
                        <option value={{ null }}>
                            {{ trans('buttons.choose') }}
                        </option>
                        @foreach ($categories as $category)
                        <option value={{ $category->id }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </x-select>
                </div>
                <div class="flex justify-center items-center col-span-2">
                    <x-label for="priceFrom" :value="__(trans('products.priceFrom'))" class="mr-4"/>
                    <x-input id="priceFrom" type="text" name="priceFrom"/>
                </div>
                <div class="flex justify-center items-center col-span-2">
                    <x-label for="priceTo" :value="__(trans('products.priceTo'))" class="mr-4"/>
                    <x-input id="priceTo" type="text" name="priceTo"/>
                </div>
            </form>
            <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 mt-6">

                @foreach ($products as $product)
                    <div class="w-full max-w-sm mx-auto rounded-md shadow-md overflow-hidden">
                        <div class="flex items-end justify-end h-56 w-full bg-cover">
                            <a href="{{ route('buyer.products.show', $product) }}">
                                <img src="{{ asset('storage/'.$product->product_image) }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="px-5 py-3" >
                            <h3 class="text-gray-700 uppercase">{{ $product->name }}</h3>
                            <span class="text-gray-500 mt-2">{{ money($product->price.'00') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="m-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    
</template>