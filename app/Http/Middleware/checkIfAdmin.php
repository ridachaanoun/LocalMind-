<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

$user = User::find(1);
Auth::login($user);

class CheckIfAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->name == "rida") {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
