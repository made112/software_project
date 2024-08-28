<?php

namespace App\Exceptions;

use Freshdesk\Exceptions\AuthenticationException as FreshDesk;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Freshdesk\Exceptions\InvalidConfigurationException as NoData;
use Freshdesk\Exceptions\AccessDeniedException as AccessDenied;
use GuzzleHttp\Exception\ConnectException as FreshDeskDomain;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException as StatusCode;
use InvalidArgumentException as ViewNotFound;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function(Throwable $e){
            if($e instanceof FreshDesk) {
                return redirect()->route('admin.tickets.no_data');
            }
        });

        $this->renderable(function(Throwable $e){
            if($e instanceof FreshDeskDomain) {
                return redirect()->route('admin.tickets.no_data');
            }
        });

        $this->renderable(function(Throwable $e){
            if($e instanceof NoData) {
                return redirect()->route('admin.tickets.no_data');
            }
        });

        $this->renderable(function(Throwable $e){
            if($e instanceof AccessDenied) {
                return redirect()->route('admin.tickets.no_data');
            }
        });
//
//        $this->renderable(function(Throwable $e){
//            if($e instanceof StatusCode && $e->getStatusCode() == 404 ) {
//                return redirect()->route('notFound');
//            }
//        });

    }
}
