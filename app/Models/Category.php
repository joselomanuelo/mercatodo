<?php

namespace App\Models;

use App\Models\Concerns\CategoriesRoutes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{
    use HasFactory;
    use CategoriesRoutes;

    protected $fillable = [
        'name',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public static function categoriesFromCache()
    {
        return Cache::rememberForever('categories', function () {
            return self::all();
        });
    }
}
