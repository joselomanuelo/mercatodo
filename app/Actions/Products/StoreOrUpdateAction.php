<?php

namespace App\Actions\Products;

use App\Contracts\StoreOrUpdateAction as Action;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StoreOrUpdateAction extends Action
{
    public static function execute(Request $request, ?Model $model = null): Model
    {
        $product = $model ?? new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category_id = $request->input('category');

        if ($request->hasFile('product_image')) {
            $fileName = time().'.'.$request->file('product_image')->extension();
            $product->product_image = 'storage/'.$request->file('product_image')->storeAs(
                    'uploads/products',
                    $fileName,
                    'public'
                );
        }

        $product->save();

        return $product;
    }
}
