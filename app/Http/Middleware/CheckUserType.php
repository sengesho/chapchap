<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            if ($user->usertype == 1) {
                return redirect('/admin.adminhome');
            } else {
                return redirect('/home');
            }
        }

        return $next($request);
    }
}

