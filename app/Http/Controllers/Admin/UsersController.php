<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function index(): View
    {
        $users = User::paginate(50);

        return view('admin.users', [
            'users' => $users,
        ]);
    }

    public function show(User $user)
    {
        return view('admin.show', [
            'user' => $user,
        ]);
    }

    public function edit(User $user)
    {
        return view('admin.edit', [
            'user' => $user,
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        $user->syncRoles($request->input('role'));

        return redirect()->route('admin.users');
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users');
    }

    public function toggle(User $user): RedirectResponse
    {
        if (!$user->disabled_at) {
            $user->disabled_at = now();
            $user->save();
        } else {
            $user->disabled_at = null;
            $user->save();
        }

        return redirect()->route('admin.users');
    }
}
