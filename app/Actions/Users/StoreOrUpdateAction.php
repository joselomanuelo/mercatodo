<?php

namespace App\Actions\Users;

use App\Constants\Roles;
use App\Contracts\StoreOrUpdateAction as Action;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreOrUpdateAction extends Action
{
    public static function execute(Request $request, ?Model $model = null): Model
    {
        $user = $model ?? new User();
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles($request->role ?? Roles::BUYER);

        return $user;
    }
}
