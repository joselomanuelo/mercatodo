<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Users\StoreOrUpdateAction;
use App\Events\UserDeletedEvent;
use App\Events\UserUpdatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\SearchRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Models\User;
use App\Models\UserLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(SearchRequest $request): View
    {
        $users = User::search($request->query('search'))
            ->orderBy('name')
            ->paginate(20);

        $users->appends(['search' => $request->query('search')]);

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
        $user = StoreOrUpdateAction::execute($request, $user);

        event(new UserUpdatedEvent($user));

        return redirect(User::indexRoute());
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        event(new UserDeletedEvent($user));

        return redirect(User::indexRoute());
    }

    public function toggle(User $user): RedirectResponse
    {
        $user->disabled_at = $user->disabled_at ? null : now();
        $user->save();

        return redirect(User::indexRoute());
    }
}
