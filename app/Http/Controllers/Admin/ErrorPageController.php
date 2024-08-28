<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ErrorPageController extends Controller
{
    /**
     * @return View
     */
    public function notFound(): View
    {
        return view('errors.404');
    }
}
