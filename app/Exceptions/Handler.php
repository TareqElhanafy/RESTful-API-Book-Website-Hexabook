<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Foundation\Testing\HttpException;
use Illuminate\Validation\ValidationException as ValidationValidationException;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if ($exception instanceof ValidationException) {
            return $this->convertValidationExceptionToResponse($request,$exception);
        }
        if ($exception instanceof  ModelNotFoundException) {
            $modelName = class_basename($exception->getModel());
        return response()->json(['error'=>"There is no {$modelName} with that id",'code'=>404]);
        }  
        if ($exception instanceof  AuthenticationException) {
            $modelName = class_basename($exception->getModel());
         return $this->unauthenticated($request,$exception);
        }  
        if ($exception instanceof  AuthorizationException) {
         return response()->json(['error'=>'Unauthorized','code'=>403]);
        }  
        if ($exception instanceof  NotFoundHttpException) {
            return response()->json(['error'=>'This url is not found','code'=>404]);
           }  
           if ($exception instanceof  MethodNotFoundException) {
            return response()->json(['error'=>'This method is not found','code'=>405]);
           }  
           if ($exception instanceof  HttpException) {
            return response()->json(['error'=>$exception->getMessage(),'code'=>$exception->getStatusCode()]);
           }  
           if ($exception instanceof  QueryException) {
               $errorCode=$exception->errorInfo[1];
               if ($errorCode==1451) {
                return response()->json(['error'=>'Cannot remove this resource permenantly because it is related to another resource','code'=>404]);

               }
           }
           
           return response()->json(['error'=>'UnExcpected Error',500]);
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json(['error'=>"Unauthenticated",'code'=>401]);
    }  
    
    protected function convertValidationExceptionToResponse(ValidationValidationException $e, $request)
    {
        $errors = $e->validator->errors()->getMessages();
            return response()->json($errors, 422);
   

    }
}
