<?php

namespace App\Http\Controllers\Api;

use App\Events\UserLoged;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.api-login');
    }

    public function store(LoginRequest $request): JsonResponse|RedirectResponse
    {
        $request->authenticate();

        event(new UserLoged($request->input('email')));

        $user = User::where('email', $request->input('email'))
            ->firstOrFail();

        $token = $user->createToken('api-token');

        return response()->json([
            'token' => $token->plainTextToken,
            'user_id' => $user->id,
        ]);
    }
}
