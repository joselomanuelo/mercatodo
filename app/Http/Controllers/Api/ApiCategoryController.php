<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApiCategoryController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return CategoriesResource::collection(Category::all());
    }
}
