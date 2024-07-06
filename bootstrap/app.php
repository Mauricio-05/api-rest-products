<?php


use App\Http\Middleware\ForceJsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            ForceJsonResponse::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ValidationException $err, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'status' => 422,
                    'error' => $err->errors(),
                    'message' => 'Validation error',
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        });

        $exceptions->render(function (NotFoundHttpException $err, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'status' => 404,
                    'error' => $err->getMessage(),
                    'message' => 'Not found',
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $exceptions->render(function (ModelNotFoundException $err, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'status' => 404,
                    'error' => $err->getMessage(),
                    'message' => 'Not found',
                ], Response::HTTP_NOT_FOUND);
            }
        });

        $exceptions->render(function (\Error $err, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'ok' => false,
                    'status' => 500,
                    'error' => $err->getMessage(),
                    'message' => 'Internal Server Error',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        });
    })->create();
