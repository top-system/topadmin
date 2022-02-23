<?php

namespace TopSystem\TopAdmin\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        auth()->setDefaultDriver(app('AdminGuard'));

        if (!Auth::guest()) {
            $user = Auth::user();
            app()->setLocale($user->locale ?? app()->getLocale());
            return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');
        }

        $urlLogin = route('admin.login');
        return redirect()->guest($urlLogin);
    }

}