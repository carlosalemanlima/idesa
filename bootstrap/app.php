<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Inexistent item.'
            ], Response::HTTP_NOT_FOUND);
        });


        $exceptions->render(function (MethodNotAllowedHttpException $e, Request $request) {
            return response()->json([
                'message' => 'Route not found.'
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        });

        if (!config('app.debug')) {
            $exceptions->render(function (Throwable $e, Request $request) {
                return response()->json([
                    'message' => 'Internal Server Error.'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            });
        }
    })->create();
