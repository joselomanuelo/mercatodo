<?php

namespace App\Http\Middleware;

use App\Constants\RouteNames;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckBanned
{
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (auth()->check() && (auth()->user()->disabled_at !== null)) {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return redirect()
                ->route(RouteNames::LOGIN)
                ->withErrors(trans('validation.disabled'));
        }

        return $next($request);
    }
}
