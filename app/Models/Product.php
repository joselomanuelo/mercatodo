<?php

namespace App\Models;

use App\Models\Concerns\ProductRoutes;
use App\Models\Concerns\ProductViews;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    use ProductRoutes;
    use ProductViews;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'reserved_stock',
        'product_image',
    ];

    public function orderProducts(): BelongsToMany
    {
        return $this->belongsToMany(OrderProduct::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch(Builder $query, ?string $search = null): Builder
    {
        return $search ? $query->where('name', 'like', '%' . trim($search) . '%')
            ->orWhere('description', 'like', '%' . trim($search) . '%') : $query;
    }

    public function scopeCategoryFilter(Builder $query, ?string $category = null): Builder
    {
        return $category ? $query->where('category_id', $category) : $query;
    }

    public function scopePriceFilter(Builder $query, ?string $priceFrom = null, ?string $priceTo = null): Builder
    {
        $query = $priceFrom ? $query->where('price', '>=', $priceFrom) : $query;

        return $priceTo ? $query->where('price', '<=', $priceTo) : $query;
    }
}
