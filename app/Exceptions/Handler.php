<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    /**
     * Handle response from exception.
     *
     * @param Request $request
     * @param \Exception $exception
     * @return JsonResponse|null
     */
    private function handleException($request, Exception $exception)
    {
        switch (true) {
            case $exception instanceof NotFoundHttpException:
                return response()->json([
                    'message' => 'Http not found.'
                ], 404);
            case $exception instanceof MethodNotAllowedHttpException:
                return response()->json([
                    'message' => 'Method not allowed.'
                ], 405);
            case $exception instanceof UnauthorizedHttpException:
                return response()->json([
                    'message' => 'Unauthorized.'
                ], 401);
        }

        return null;
    }
}
