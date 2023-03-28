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
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $userID = preg_match('/[0-9]+/', $request->getRequestUri());
        $headerToken = $request->header('token');
        if (!$userID) {
            $userToken = Token::where('token', $headerToken)->first();
        } else {
            $userToken = Token::find();
        }
        $now = new \DateTime();
        $now->setTimezone(new \DateTimeZone("UTC"));
        if (!$headerToken || $userToken->token !== $headerToken || $userToken->expired_date < $now->format('Y-m-d h:m:s')) {
            return response('Unauthorized', 401);
        }

        return $next($request);
    }
}
