<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $exception): void
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof TokenExpiredException) {
            return response()->json(['error' => 'El token ha expirado'], 401);
        }

        if ($exception instanceof TokenInvalidException) {
            return response()->json(['error' => 'El token no es válido'], 401);
        }

        if ($exception instanceof JWTException) {
            return response()->json(['error' => 'Token no encontrado'], 401);
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->json(['error' => 'No autorizado. Token requerido'], 401);
        }

        return parent::render($request, $exception);
    }
}
