<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserDeleted;
use App\Events\UserUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(50);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $userLogs = UserLog::where('user_id', $user->id)->get();

        return view('admin.users.show', compact('user', 'userLogs'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        $user->syncRoles($request->input('role'));

        event(new UserUpdated($user));

        return redirect($user->indexRoute());
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        event(new UserDeleted($user));

        return redirect($user->indexRoute());
    }

    public function toggle(User $user): RedirectResponse
    {
        $user->disabled_at = $user->disabled_at ? null : now();
        $user->save();

        return redirect($user->indexRoute());
    }
}
