<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception))
        {
            return $this->renderHttpException($exception);
        }
        else
        {
            return parent::render($request, $exception);
        }
    }

    /**
     * Render the given HttpException.
     *
     * @param  \Symfony\Component\HttpKernel\Exception\HttpException  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function renderHttpException(HttpException $e)
    {
        // if (view()->exists('errors.'.$e->getStatusCode()))
        // {
        //     return response()->view('errors.'.$e->getStatusCode(), [], $e->getStatusCode());
        // }
        // else
        // {
        //     return (new SymfonyDisplayer(config('app.debug')))->createResponse($e);
        // }
        return response()->view('errors.404', ['status_code' => $e->getStatusCode()], $e->getStatusCode());
    }

}
