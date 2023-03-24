<?php

namespace App\Http\Middleware;

use App\Models\MyUser;
use App\Models\Token;
use Closure;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userToken = Token::find(preg_match('/[0-9]+/', $request->getRequestUri()));
        if (!$request->header('token') || $userToken->token !== $request->header('token')) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
