<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'description',
        'price',
        'stock',
        'product_image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $query->where('name', 'like', '%' . $search .'%')
            ->orWhere('description', 'like', '%' . $search .'%');
    }

    public function scopePrice(Builder $query, ?string $from, ?string $to): Builder
    {
        return $query->where('name', 'like', '%' . $search .'%')
            ->orWhere('description', 'like', '%' . $search .'%');
    }

    public function scopeCategory(Builder $query, ?string $category): Builder
    {
        return $category ? $query->where('category', $category) : $query;
    }
}
