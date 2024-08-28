<?php
namespace App\Http\Controllers\Admin;
session_start();
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use App\Models\Log;
use App\Models\Tenant;
use App\Models\LoginLog;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use DB;
use Spatie\Activitylog\Models\Activity;
use Stevebauman\Location\Facades\Location;

class LoginAdminController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
    }
    ///////////////////////////////////////////
    public function getIndex()
    {
        $data['setting'] = Setting::where('id',1)->first(['image','name']);
        return view('admin.login.index',compact('data'));
    }
    ///////////////////////////////////////////
    public function postIndex(Request $request)
    {

        $field = 'username';
        $username = $request->get('username');
        $password = $request->get('password');
        $remember_token = $request->get('remember_token');

        $user = User::where('username',$username);
        $user = $user->first();
        if($user != ''){
            if($user->status != 1){
                return redirect('/admin/login')->with(['danger' =>__('lang.sorry_the_account_is_disabled_Please_see_administration') ]);
            }
        }else{
            return redirect('/admin/login')->with(['danger' => __('lang.sorry_an_error_in_the_data_entered')]);
        }

        $admin[$field] = $username;
        $admin['password'] = $password;

        if (Auth::guard('web')->attempt($admin, $remember_token))
        {
            Activity::create([
                'description' => 'Has Been Login',
                'subject_type' => 'App\Models\User',
                'subject_id' => Auth::user()->id,
                'causer_type' => 'App\Models\User',
                'causer_id' => Auth::user()->id,
                'ip_address' => $request->ip(),
            ]);

            return redirect('/admin/dashboard');


        }
        else
        {
            return redirect('/admin/login')->with(['danger' => __('lang.sorry_an_error_in_the_data_entered')]);
        }
    }
    ///////////////////////////////////////////
    public function getLogout(Request $request)
    {
        // Activity Logs For Logout
        Activity::create([
            'description' => 'Has Been Logout',
            'subject_type' => 'App\Models\User',
            'subject_id' => Auth::user()->id,
            'causer_type' => 'App\Models\User',
            'causer_id' => Auth::user()->id,
            'ip_address' => $request->ip(),
        ]);

        Auth::logout();
        return redirect('/admin/login');
    }
    ///////////////////////////////////////////
    public function forgetPassword(Request $request){
        $data['setting'] = Setting::where('id',1)->first(['image','name']);
        return view('admin.login.forget-password',compact('data'));
    }
    //////////////////////////////////////////
    public function ForgetPasswordPost(Request $request){
        $setting = \App\Models\Setting::Where('id',1)->first();
        $site = $setting->name;

        $email = $request->get('email');
        if($email == ''){
            return redirect('/admin/forget-password')->with(['danger' => trans('lang.email_required')]);
        }
        $user = User::where('email',$email)->first();
        if($user != ''){
            $random = \Str::random(15);
            $user->code = $random;
            $user->date_code = date('Y-m-d H:i:s');
            $saved = $user->save();
            if(!$saved){
                return redirect('/admin/forget-password')->with(['danger' => trans('lang.error')]);
            }

            $url = \URL::to('/').'/admin/reset-password/'.$random;
            $data = array('url'=>$url);
            \Mail::send('email.reset-password', $data, function($message) use($email,$user,$setting,$site){
                $message->to($email,$user->name)->subject(trans('lang.reset-password'));
                $message->from(env('MAIL_FROM_ADDRESS', 'hello@example.com'),$site);
            });

            return redirect('/admin/forget-password')->with(['success' => trans('lang.check_email')]);
        }else{
            return redirect('/admin/forget-password')->with(['danger' => trans('lang.email_not_found')]);
        }
    }
    ////////////////////////////////////////////////////////////
    public function resetPassword($random){
        $user = User::where('code',$random)->first();
        if(!$user){
            abort(404);
        }
        $setting = \App\Models\Setting::Where('id',1)->first();
        $hour1 = 0; $hour2 = 0;
        $date1 = $user->date_code;
        $date2 = date('Y-m-d H:i:s');
        $datetimeObj1 = new \DateTime($date1);
        $datetimeObj2 = new \DateTime($date2);
        $interval = $datetimeObj1->diff($datetimeObj2);
        if($interval->format('%a') > 0){
            $hour1 = $interval->format('%a')*24;
        }
        if($interval->format('%h') > 0){
            $hour2 = $interval->format('%h');
        }
        $hour = $hour1 + $hour2;
        if($hour <= 24){
            return view('admin.login.reset-password',compact(['random','user','setting']));
        }else{
            return redirect('/admin/login')->with(['danger' => trans('lang.link_expired')]);
        }
    }
    ////////////////////////////////////////////////////////////
    public function ResetPasswordPost(Request $request){
        $id = $request->get('id');
        $random = $request->get('random');
        $confirm_password = $request->get('confirm_password');
        $password = $request->get('password');
        $user = User::where('code',$random)->first();
        if(!$user){
            return redirect()->back()->with('danger', trans('lang.error'));
        }
        if($password != $confirm_password){
            return redirect()->back()->with('danger', trans('lang.password_not_match'));
        }
        $user->password = \Hash::make($password);
        $user->code = '';
        $saved = $user->save();
        if(!$saved){
            return redirect()->back()->with('danger', trans('lang.error'));
        }
         return redirect('/admin/login')->with('success', trans('lang.password_changed_succesfully'));
    }
}
