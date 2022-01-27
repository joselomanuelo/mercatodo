<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\SearchRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(SearchRequest $request): View
    {
        $users = User::search($request->query('search'))
            ->paginate(20);

        return view(User::indexView(), compact('users'));
    }

    public function show(User $user)
    {
        $userLogs = UserLog::where('user_id', $user->id)->get();

        return view(User::showView(), compact('user', 'userLogs'));
    }

    public function edit(User $user)
    {
        return view(User::editView(), compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        $user->syncRoles($request->input('role'));

        event(new UserUpdated($user));

        return redirect(User::indexRoute());
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        event(new UserDeleted($user));

        return redirect(User::indexRoute());
    }

    public function toggle(User $user): RedirectResponse
    {
        $user->disabled_at = $user->disabled_at ? null : now();
        $user->save();

        return redirect(User::indexRoute());
    }
}
