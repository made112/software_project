<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\StaticPage;
use App\Models\Setting;

class HomeController extends BaseController

{

    public function __construct(){

        parent::__construct();

    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function index($lang){
        return view('welcome');
    }

    public function page($slug){
        $page = StaticPage::where('slug',$slug)->where('status',1)->first();
        if(!$page){
            abort(404);
        }
        $setting = Setting::first();
        return view('site.page',compact(['page','setting']));
    }
}   