<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
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
            'created_at',
            'updated_at'
        ];
    }
}
