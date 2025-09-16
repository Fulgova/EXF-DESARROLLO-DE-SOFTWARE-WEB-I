<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth; // 👈 usa Tymon aquí
use Tymon\JWTAuth\Exceptions\JWTException;

class JwtAuthWeb
{
public function handle(Request $request, Closure $next): Response
{
    try {
        $token = session('jwt_token'); // 👈 lo que guardaste en login

        if (!$token) {
            return redirect('/loginweb');
        }

        $user = JWTAuth::setToken($token)->authenticate();

        if (!$user) {
            return redirect('/loginweb');
        }
    } catch (JWTException $e) {
        return redirect('/loginweb');
    }

    return $next($request);
}

}
