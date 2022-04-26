<?php

namespace App\Exceptions;

use DivisionByZeroError;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

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
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                switch (true) {
                    case $e instanceof QueryException:
                        return response()->json([
                            'message' => 'Cau query sai',
                            'data' => null,
                        ], 500);

                    case $e instanceof DivisionByZeroError:
                        return response()->json([
                            'message' => 'Chia cho 0',
                            'data' => null,
                        ], 500);
                    
                    default:
                        return response()->json([
                            'message' => $e->getMessage(),
                            'data' => null,
                        ], 500);
                }
            } 
        });
    }
}
