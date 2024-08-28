<?php

namespace App\Http\Controllers\Admin;

use App\Http\Helpers\Helpers;
use App\Models\ApiCall;
use App\Models\Clients;
use App\Models\Country;
use App\Models\License;
use App\Models\User;
use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MobileNotification;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as Notifiy;
use Kreait\Firebase\Messaging\AndroidConfig;

class DashboardController extends AdminController

{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {

        $products = Products::orderBy('id', 'desc')->get();
        $licenses = License::orderBy('id', 'desc')->get();
        $clients = Clients::orderBy('id', 'desc')->get();

        // Online Companies
        $online_clients = Clients::whereNotNull('last_seen_at')->orderBy('last_seen_at', 'desc')->limit(8)->get();

        // Top Company
        $top_companies = License::with(['client', 'product'])
            ->groupBy(['client_id', 'product_id'])
            ->selectRaw('*, count(client_id) as client')
            ->orderBy('client', 'desc')
            ->get();
//        $top_products = Products::with('client')->groupBy('client_id')->get()->dd();


        $licenses_product = License::with('product')->where('usage',1)->where(function ($q) {
                                $q->where('date','>',date('Y-m-d'))->orWhereNull('date');
                            })->groupBy('product_id')->selectRaw('count(id) as cnt,product_id')->orderByRaw('`cnt` desc')->get();

        $income_array = array();
        $license_income = License::with('product')->whereYear('created_at',date('Y'))
            ->groupByRaw('month(created_at),product_id')
            ->selectRaw('sum(price) as price,product_id,month(created_at) as month')
            ->orderBy('created_at','asc')
            ->get()
            ->groupBy('product_id');

        if($license_income){
            $i = 0;
            $color = \App\Http\Helpers\Helpers::getRandomColor();
            foreach($license_income as $income){

                $income_array[$i]['data'] = [0,0,0,0,0,0,0,0,0,0,0,0];
                foreach($income as $in){
                    $income_array[$i]['data'][$in->month-1] = $in->price;
                    if($in->product){
                        $income_array[$i]['product']= $in->product->name;
                        $color = $in->product->color;
                        $income_array[$i]['borderColor'] = $color;
                        $income_array[$i]['borderWidth'] = 1;
                        $income_array[$i]['backgroundColor'] = $color;
                    }
                }
                // $color = \App\Http\Helpers\Helpers::getRandomColor();
                // $color = $income->product->color;

                $i++;
            }
        }

        $clients_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $clients_data = Clients::where('status',1)->groupByRaw('month(created_at)')->selectRaw('count(id) as cnt,month(created_at) as month')->orderBy('created_at','asc')->get();
        if($clients_data){
            foreach($clients_data as $cl){
                $clients_array[$cl->month-1] = $cl->cnt;
            }
        }

        $update_download_array = array(0,0);

        $update_download = ApiCall::where('function',ApiCall::UpdateDownloads)->groupBy('status')->selectRaw('count(id) as cnt,status')->orderBy('status','desc')->get();
        if($update_download){
            foreach($update_download as $key=>$u_download){
                $update_download_array[$key] = $u_download->cnt;
            }
        }
//        dd( $update_download_array );

        $notificationsCount = Notifications::count();
        $todayNotificationsCount = Notifications::whereRaw('date(created_at) = CURDATE()')->count();
        $yesterdayNotificationsCount = Notifications::whereRaw('date(date) = (CURDATE() - INTERVAL 1 DAY)')->count();
        $data['notifications_pct_today'] = ($todayNotificationsCount-$yesterdayNotificationsCount);
        $data['notifications_pct_today'] = ($data['notifications_pct_today'] / ($todayNotificationsCount ? $todayNotificationsCount : 1))*100;


        $update_download = ApiCall::with(['client','version','product'])->whereBetween('created_at',array(date('Y-m-d',strtotime("-1 days")),date('Y-m-d H:i:s')))->where('function',ApiCall::UpdateDownloads)->select('id','client_id','version_id','product_id','created_at')->orderBy('created_at','desc')->get();
        $update_download_all = ApiCall::where('function',ApiCall::UpdateDownloads)->count();
        $update_download_today = ApiCall::where('function',ApiCall::UpdateDownloads)->where('status', 1)->whereRaw('date(created_at) = CURDATE()')->count();
        $update_download_yesterday = ApiCall::where('function',ApiCall::UpdateDownloads)->where('status', 1)->whereRaw('date(created_at) = (CURDATE() - INTERVAL 1 DAY)')->count();
        $data['update_download_pct_today'] = ($update_download_today-$update_download_yesterday);
        $data['update_download_pct_today'] = ($data['update_download_pct_today'] / ($update_download_today ? $update_download_today : 1))*100;

        $api_call_all = ApiCall::count();
        $api_call_today = ApiCall::where('status', 1)->whereRaw('date(created_at) = CURDATE()')->count(); // CURDATE() => Current Date

        $api_call_yesterday = ApiCall::whereRaw('date(created_at) = (CURDATE() - INTERVAL 1 DAY)')->count();

        $data['api_call_pct_today'] = ($api_call_today-$api_call_yesterday);

        $data['api_call_pct_today'] = ($data['api_call_pct_today'] / ($api_call_today ? $api_call_today : 1))*100;

        $data['clients_today'] = Clients::where('status',1)->whereRaw('date(created_at) = CURDATE()')->count();
        $data['clients_yesterday'] = Clients::where('status',1)->whereRaw('date(created_at) = (CURDATE() - INTERVAL 1 DAY)')->count();

        $data['clients_today_pct'] = ($data['clients_today']-$data['clients_yesterday']);
        $data['clients_today_pct'] = ($data['clients_today_pct'] / ($data['clients_today'] ? $data['clients_today'] : 1))*100;

        $data['clients_weekly'] = Clients::where('status',1)->whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 1 WEEK) and CURDATE()')->count();
        $data['clients_prev_last_weekly'] = Clients::where('status',1)->whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 2 WEEK) and date_sub(CURDATE(),INTERVAL 1 WEEK)')->count();

        $data['clients_week_pct'] =  ($data['clients_weekly']-$data['clients_prev_last_weekly']);
        $data['clients_week_pct'] = ($data['clients_week_pct'] / ($data['clients_weekly'] ? $data['clients_weekly'] : 1))*100;

        $data['clients_month'] = Clients::where('status',1)->whereRaw('MONTH(created_at) = MONTH(CURDATE()) and YEAR(created_at) = YEAR(CURDATE())')->count();
        $data['clients_prev_month'] = Clients::where('status',1)->whereRaw('MONTH(created_at) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) and YEAR(created_at) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))')->count();

        $data['clients_month_pct'] = ($data['clients_month']-$data['clients_prev_month']);
        $data['clients_month_pct'] = ($data['clients_month_pct'] / ($data['clients_month'] ? $data['clients_month'] : 1))*100;

        $data['activations_today'] = ApiCall::activations()->where('status',1)->whereRaw('date(created_at) = CURDATE()')->count();
        $data['activations_yesterday'] = ApiCall::activations()->where('status',1)->whereRaw('date(created_at) = (CURDATE() - INTERVAL 1 DAY)')->count();

        $data['activations_today_pct'] = ($data['activations_today']-$data['activations_yesterday']);
        $data['activations_today_pct'] = ($data['activations_today_pct'] / ($data['activations_today'] ? $data['activations_today'] : 1))*100;

        $data['activations_weekly'] = ApiCall::activations()->where('status',1)->whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 1 WEEK) and CURDATE()')->count();
        $data['activations_prev_last_weekly'] = ApiCall::activations()->where('status',1)->whereRaw('date(created_at) between date_sub(CURDATE(),INTERVAL 2 WEEK) and date_sub(CURDATE(),INTERVAL 1 WEEK)')->count();

        $data['activations_week_pct'] =  ($data['activations_weekly']-$data['activations_prev_last_weekly']);
        $data['activations_week_pct'] = ($data['activations_week_pct'] / ($data['activations_weekly'] ? $data['activations_weekly'] : 1))*100;


        $data['activations_month'] = ApiCall::activations()->where('status',1)->whereRaw('MONTH(created_at) = MONTH(CURDATE())')->count();
        $data['activations_prev_month'] = ApiCall::activations()->where('status',1)->whereRaw('MONTH(created_at) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH)) and YEAR(created_at) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))')->count();

        $data['activations_month_month_pct'] =  ($data['activations_month']-$data['activations_prev_month']);
        $data['activations_month_month_pct'] = ($data['activations_month_month_pct'] / ($data['activations_month'] ? $data['activations_month'] : 1))*100;

        $api_call_all_success = ApiCall::where('status',1)->count();
        $api_call_all_faild = ApiCall::where('status',0)->count();

        $top_api_call = \DB::table('api_calls')->whereRaw('`function` is not null')->whereNull('deleted_at')->selectRaw('count(id) as cnt,`function`')->groupByRaw('`function`')->orderByRaw('`cnt` desc')->take(5)->get();
        // return $update_download_array;
        // {
        //     data: [12, 19, 33, 25, 42, 23],
        //     borderWidth: 1,
        //     borderColor: "#EC6666",
        //     backgroundColor: "#EC6666",
        // }

        $data['licenses_clients'] = License::with('client.products')->where('usage',1)->where(function ($q) {
                                        $q->where('date','>',date('Y-m-d'))->orWhereNull('date');
                                    })->groupBy('client_id')->selectRaw('count(*) as cnt,client_id')->orderByRaw('`cnt` desc')->get();

        $notification_daily = Notifications::query()
            // ->whereBetween(DB::raw('DATE(created_at)') , [\Carbon\Carbon::now()->subDays(5) , \Carbon\Carbon::now()->subDays(2)])
            ->groupBy(DB::raw('day(created_at)'))
            ->select( DB::raw('day(created_at) as day'), DB::raw('count(*) as cat_count'));

        $notification_daily2 = DB::table( DB::raw("({$notification_daily->toSql()}) as sub") )
            ->select('day','cat_count',DB::raw('@rownum as prev') ,
                DB::raw('(CASE WHEN @rownum = "0" THEN 100 ELSE (cat_count-@rownum)/@rownum*100 END) AS new_result'),
                DB::raw('((cat_count-@rownum)/@rownum*100) as res '),DB::raw('@rownum := cat_count'))
            ->mergeBindings($notification_daily->getQuery());

        $data['notification_daily'] =  DB::table( DB::raw("({$notification_daily2->toSql()}) as sub") )->mergeBindings($notification_daily->getQuery())
                 ->avg('new_result');

        $apicall_daily = ApiCall::query()
        // ->whereBetween(DB::raw('DATE(created_at)') , [\Carbon\Carbon::now()->subDays(5) , \Carbon\Carbon::now()->subDays(2)])
        ->groupBy(DB::raw('day(created_at)'))
        ->select( DB::raw('day(created_at) as day'), DB::raw('count(*) as cat_count'));

        $apicall_daily2 = DB::table( DB::raw("({$apicall_daily->toSql()}) as sub") )
        ->select('day','cat_count',DB::raw('@rownum as prev') ,
            DB::raw('(CASE WHEN @rownum = "0" THEN 100 ELSE (cat_count-@rownum)/@rownum*100 END) AS new_result'),
            DB::raw('((cat_count-@rownum)/@rownum*100) as res '),DB::raw('@rownum := cat_count'))
        ->mergeBindings($apicall_daily->getQuery());

        $data['apicall_daily'] =  DB::table( DB::raw("({$apicall_daily2->toSql()}) as sub") )->mergeBindings($apicall_daily->getQuery())
            ->avg('new_result');

        $data['client_group'] = Clients::with('country')->groupBy('country_id')
                            ->orderBy(DB::raw('COUNT(id)','desc'))
                            ->get(array(DB::raw('COUNT(id) as count'),'country_id'));

        $country_stat = array();
        $country_color = array();
        if($data['client_group']){
            foreach($data['client_group'] as $cl){
                if($cl->country){
                    $country_stat[$cl->country->iso2] = $cl->count;
                    $country_color[strtolower($cl->country->iso2)] = '#1d1d1b';
                }
            }
        }
        $data['country_stat'] = $country_stat;
        $data['country_color'] = $country_color;
        // return $sub3;

        $products_data = Products::get(['id','name']);
        return view('admin.dashboard.index')
            ->with('clients', $clients)
            ->with('licenses', $licenses)
            ->with('online_clients', $online_clients)
            ->with('countries', $this->getCountries())
            ->with('products_data',$products_data)
            ->with('clientsChart', $this->getClientsChardData())
            ->with('products', $products)
            ->with('income_array',$income_array)
            ->with('clients_array',$clients_array)
            ->with('update_download_array',$update_download_array)
            ->with('notificationsCount',$notificationsCount)
            ->with('todayNotificationsCount',$todayNotificationsCount)
            ->with('update_download',$update_download)->with('update_download_all',$update_download_all)
            ->with('update_download_today',$update_download_today)
            ->with('api_call_all',$api_call_all)->with('api_call_today',$api_call_today)
            ->with('api_call_all_success',$api_call_all_success)->with('api_call_all_faild',$api_call_all_faild)
            ->with('top_api_call',$top_api_call)
            ->with('licenses_product',$licenses_product)
            ->with('data',$data);
    }


    public function getCountries()
    {
        $clients = Clients::orderBy('id', 'desc')->get();
        $countries = [];
        foreach (Country::whereHas('clients')->withCount('clients')->get() as $country) {
            if (count($clients)) {
                $percentage = round(($country->clients_count / count($clients)) * 100, 2);
            } else {
                $percentage = 0;
            }
            $countries = array_merge($countries, [$country->iso2 => [
                'clients_count' => $country->clients_count,
                'percentage' =>  $percentage
            ]]);
        }
        return  json_encode($countries);
    }

    public function getActiveClients(Request $request){
        // $clients_array = array(0,0,0,0,0,0,0,0,0,0,0,0);
        $duration = $request->get('duration');
        $now = date('Y-m-d H:i:s');
        $month = array();
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }

        $api_activity_array = array();
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);
        if($month){
            foreach($month as $m){
                $clients_array[$m] = 0;
            }
        }

        $clients_data = Clients::where('status',1)->where('created_at','>=',$prev)->where('created_at','<=',$now)
                        ->groupByRaw('month(created_at)')->selectRaw('count(id) as cnt,month(created_at) as month,year(created_at) as year')->orderBy('created_at','asc')->get();
        if($clients_data){
            foreach($clients_data as $cl){
                $key = $cl->year.'-'.date('M',strtotime($cl->year.'-'.$cl->month));
                $clients_array[$key] = $cl->cnt;
            }
        }
        return response()->json(['status' => true , 'data' =>$clients_array,'month'=>$month]);

    }
    public function getActivationsChardData(Request $request)
    {
        $groupByFormat = Helpers::getChartFilter();
        $duration = 1;
        $now = date('Y-m-d H:i:s');
        $month = array();
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }


        $activation_array = array();
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);

        if($month){
            foreach($month as $m){
                $activation_array[$m] = 0;
            }
        }
        //  $activation_array;

        $activation_data = ApiCall::whereIn('function',[ApiCall::ActivateLicense,ApiCall::DeactivateLicense])->where('created_at','>=',$prev)->where('created_at','<=',$now);
        $activation_data = $activation_data->groupByRaw('month(created_at),year(created_at)')->selectRaw('count(id) as cnt,month(created_at) as month,year(created_at) as year')->orderBy('created_at','asc')->get();
        if($activation_data){
            foreach($activation_data as $ac){
                // return intVal($ac->month);
                $key = $ac->year.'-'.date('M',strtotime($ac->year.'-'.$ac->month));
                $activation_array[$key] = $ac->cnt;
            }
        }

        return response()->json(['status' => true , 'data' =>$activation_array,'month'=>$month]);
    }


    public function getApiActivity(Request $request){
        $duration = $request->get('duration');
        $now = date('Y-m-d H:i:s');
        $month = array();
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }

        $api_activity_array = array();
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);
        if($month){
            foreach($month as $m){
                $api_activity_array[$m] = 0;
            }
        }

        $top_api_call = ApiCall::where('created_at','>=',$prev)->where('created_at','<=',$now)
                    ->groupByRaw('month(created_at),year(created_at)')->selectRaw('count(id) as cnt,month(created_at) as month,year(created_at) as year')->orderBy('created_at','asc')->get();
        if($top_api_call){
            foreach($top_api_call as $a_call){
                // return intVal($ac->month);
                $key = $a_call->year.'-'.date('M',strtotime($a_call->year.'-'.$a_call->month));
                $api_activity_array[$key] = $a_call->cnt;
            }
        }
        return response()->json(['status' => true , 'data' =>$api_activity_array,'month'=>$month]);
    }

    public function getActivationActivity(Request $request){
        $duration = $request->get('duration');
        $now = date('Y-m-d H:i:s');
        $month = array();
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }

        $api_activity_array = array();
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);
        if($month){
            foreach($month as $m){
                $api_activity_array[$m] = 0;
            }
        }

        $top_api_call = ApiCall::activations()->where('created_at','>=',$prev)->where('created_at','<=',$now)
                    ->groupByRaw('month(created_at),year(created_at)')->selectRaw('count(id) as cnt,month(created_at) as month,year(created_at) as year')->orderBy('created_at','asc')->get();
        if($top_api_call){
            foreach($top_api_call as $a_call){
                // return intVal($ac->month);
                $key = $a_call->year.'-'.date('M',strtotime($a_call->year.'-'.$a_call->month));
                $api_activity_array[$key] = $a_call->cnt;
            }
        }
        return response()->json(['status' => true , 'data' =>$api_activity_array,'month'=>$month]);
    }

    public function getTopApiCall(Request $request){
        $duration = $request->get('duration');
        $now = date('Y-m-d H:i:s');
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }
        $top_api_call = \DB::table('api_calls')->where('created_at','>=',$prev)->where('created_at','<=',$now)->whereRaw('`function` is not null')->whereNull('deleted_at')->selectRaw('count(id) as cnt,`function`')->groupByRaw('`function`')->orderByRaw('`cnt` desc')->take(5)->get();
        $table = '';
        if($top_api_call){
            foreach($top_api_call as $api){
                    if ($api->function == 1) {
                        $function_name = 'Get Last Version';
                    } else if ($api->function == 2) {
                        $function_name = 'Check Availability License';
                    } else if ($api->function == 3) {
                        $function_name = 'Activate License';
                    } else if ($api->function == 4) {
                        $function_name = 'Deactivate License';
                    } else if ($api->function == 5) {
                        $function_name = 'Check Update';
                    }else if ($api->function == 6) {
                        $function_name = 'Update Downloads';
                    }else if ($api->function == 7) {
                        $function_name = 'View Package';
                    }else if ($api->function == 8) {
                        $function_name = 'Sign In';
                    }else if ($api->function == 9) {
                        $function_name = 'Sign Out';
                    }
                $table .= '<tr>
                                <td>'.$function_name.'</td>
                                <td class="text-end">'.$api->cnt.'</td>
                            </tr>';
            }
        }
        return response()->json(['status' => true , 'data' =>$table]);
    }

    public function getNotificationHistory(Request $request){
        $duration = $request->get('duration');
        $now = date('Y-m-d H:i:s');
        $month = array();
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }

        $notification_array = array();
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);
        if($month){
            foreach($month as $m){
                $notification_array[$m] = 0;
            }
        }

        $notification_data = Notifications::where('date','>=',$prev)->where('date','<=',$now)->groupByRaw('year(date),month(date)')->selectRaw('count(id) as cnt,month(date) as month,year(date) as year')->orderBy('date','asc')->get();
        if($notification_data){
            foreach($notification_data as $notify){
                $key = $notify->year.'-'.date('M',strtotime($notify->year.'-'.$notify->month));
                $notification_array[$key] = $notify->cnt;
            }
        }
        return response()->json(['status' => true , 'data' =>$notification_array,'month'=>$month]);

    }

    public function getDownloadHistory(Request $request){
        $now = date('Y-m-d H:i:s');
        $month = array();
        $duration = $request->get('duration');
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }

        $download_array = array();
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);

        $update_download = ApiCall::where('created_at','>=',$prev)->where('created_at','<=',$now)->where('function',ApiCall::UpdateDownloads)
                            ->groupByRaw('status,year(created_at),month(created_at)')->selectRaw('count(id) as cnt,year(created_at) as year,month(created_at) as month,status')->orderBy('status','desc')->orderBy('created_at','asc')->get()->groupBy('status');

        $i=0;
        foreach($update_download as $download){
            if($month){
                foreach($month as $m){
                    $download_array[$i]['data'][$m] = 0;
                }
            }
            foreach($download as $d){
                $key = $d->year.'-'.date('M',strtotime($d->year.'-'.$d->month));
                $download_array[$i]['data'][$key] = $d->cnt;
            }
            if($i==0){
                $color = '#147AD6';
            }else{
                $color = '#EC6666';
            }
            $download_array[$i]['borderColor'] = $color;
            $download_array[$i]['borderWidth'] = 1;
            $download_array[$i]['backgroundColor'] = $color;
            $i++;
        }

        return response()->json(['status' => true , 'data' =>$download_array,'month'=>$month]);
    }

    public function getProductLicenses(Request $request){
        $now = date('Y-m-d H:i:s');
        $month = array();
        $duration = $request->get('duration');
        $product_id = $request->get('product_id');
        if($duration == 1){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 5 month"));
        }else if($duration == 2){
            $prev = date("Y-m-d H:i:s", strtotime($now." - 11 month"));
        }
        $month = \App\Http\Helpers\Helpers::getMonths($prev,$now);

        $licenses =  License::where('created_at','>=',$prev)->where('created_at','<=',$now)
                    ->selectRaw('sum(price) as price,year(created_at) as year,month(created_at) as month,product_id');
        if($product_id){
            $licenses =  $licenses->where('product_id',$product_id);
        }
        $licenses =  $licenses->groupByRaw('product_id,year(created_at),month(created_at)')->orderBy('created_at','asc')->get()->groupBy('product_id');
        $license_array = array();
        $i=0;
        $products = array();
        foreach($licenses as $index=>$license){
            if($month){
                foreach($month as $m){
                    $license_array[$i]['data'][$m] = 0;
                }
            }
            foreach($license as $li){
                $key = $li->year.'-'.date('M',strtotime($li->year.'-'.$li->month));
                $license_array[$i]['data'][$key] = $li->price;
            }

            $color = \App\Http\Helpers\Helpers::getRandomColor();

            $product = Products::where('id',$index)->first(['id','name','product_id','color']);
            if($product){
                $color = $product['color'];
                $products[] = $product;
                $license_array[$i]['borderColor'] = $color;
                $license_array[$i]['borderWidth'] = 1;
                $license_array[$i]['backgroundColor'] = $color;
            }
            $i++;
        }
        return response()->json(['status' => true , 'data' =>$license_array,'month'=>$month,'products'=>$products]);
    }
    /**
     * get data for clients chart
     *
     * @return array
     *
     */
    public function getClientsChardData(): array
    {

        $groupByFormat = Helpers::getChartFilter();
        if( $groupByFormat == '%b' || $groupByFormat == '%Y') {
            $clients = Clients::dashboardChartFilter()->groupBy('date')->get([
                DB::raw("DATE_FORMAT(created_at , '$groupByFormat') as date"),
                DB::raw('count(*) as count')
            ])->toArray();
        }else if($groupByFormat == '%e') {
            $clients = Clients::query()->whereMonth('created_at', '=', \Carbon\Carbon::now()->subMonth())->groupBy('date')->get([
                DB::raw("DATE_FORMAT(created_at , '$groupByFormat') as date"),
                DB::raw('count(*) as count')
            ])->toArray();

        }
//        dd($clients);
        return ['dates' => array_column($clients, 'date'), 'data' => array_column($clients, 'count')];
    }

    public function getLicenseChartData()
    {
        $groupByFormat = Helpers::getChartFilter();
        $products = Products::with('licenses');
        $daa = [];
        foreach (License::groupBy('date')->get() as $index => $l) {
            dd(License::groupBy('datee')->get([DB::raw("DATE_FORMAT(date , '$groupByFormat') as datee")]));
        }
        $licenseDates = License::join('products', 'licenses.product_id', '=', 'products.id')->groupBy(['dateformat', 'products.id'])->get([
            DB::raw("sum(price) as price"),
            DB::raw("DATE_FORMAT(licenses.date , '$groupByFormat') as dateformat"),
            'products.name'
        ]);

        dd($licenseDates, $products);
    }

    // public function getNotification(Request $request){
    //     $notifications = Notifications::with('client')->whereNull('notifications.read_at')
    //                     ->where('notifications.user_id',\Auth::user()->id)->get();
    //     if($notifications){
    //         foreach($notifications as $n){
    //             $n->read_at = date('Y-m-d H:i:s');
    //             $n->save();
    //         }
    //     }
    //     return response()->json(['status' => true, 'data' => $notifications]);
    // }
}
