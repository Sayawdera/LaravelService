<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;

class SpatieRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $guard = null): Response
    {
        $authGuard = Auth::guard($guard);

        if ($authGuard->guest())
        {
            throw UnauthorizedException::notLoggedIn();
        }
        $action = $request->route()->getAction('as');
        /**
         * @var $user User
         */
        $user = $authGuard->user();
        if ($user->getActiveRoles()->hasPermissionTo($action))
        {
            return $next($request);
        }
        throw UnauthorizedException::forPermissions($action);

        return $next($request);

    }
}
