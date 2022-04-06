<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProductsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping
{
    public function collection(): Collection
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'name',
            'description',
            'price',
            'stock',
            'reserved_stock',
            'product_image',
            'category_id',
        ];
    }

    public function map($product): array
    
    {
        return [
            $product->id,
            $product->name,
            $product->description,
            $product->price,
            $product->stock,
            $product->reserved_stock,
            $product->product_image,
            $product->category_id
        ];
    }
}
