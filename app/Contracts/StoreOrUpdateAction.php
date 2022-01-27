<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class StoreOrUpdateAction
{
    public abstract static function execute(Request $request, ?Model $model = null): Model;
}
