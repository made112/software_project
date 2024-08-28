<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiCall;
use App\Models\Clients;
use App\Models\Download;
use App\Models\License;
use App\Models\LicensesUse;
use App\Models\Notifications;
use App\Models\Payment;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function general(Request $request)
    {
        $request->validate([
            'date' => ['required'],
        ]);
        // Set Array To Send All Vars
        $data = [];

        // Date From Request
        $date = explode(' - ', $request->date);

        $from = Carbon::parse( $date[0]);
        $to = Carbon::parse($date[1]);
        $diff_in_days = $from->diffInDays($to);


        // All Products Between( $from, $to )
        $data['products'] = Products::query()->whereBetween('created_at', [$from, $to])->limit(8)->count();

        // Active Companies Only Between( $from, $to ) -> Daily
        $data['active_products'] = Products::query()->where('status', 1)->whereBetween('created_at', [$from, $to])->count();

        // Inactive Products Only Between( $from, $to )
        $data['inactive_products'] = Products::query()->where('status', 2)->whereBetween('created_at', [$from, $to])->count();

        // All Companies ( Clients ), Between( $from, $to ) => Total => 5
        $data['companies'] = Clients::query()->whereBetween('created_at', [$from, $to])->count();

        // Get Avg For Active Companies
        if( $data['companies'] > 0) {
            $data['avg'] = $data['companies'] / $diff_in_days;
        }else{
            $data['avg'] = null;
        }

        // Active Companies Only ( Clients ), Between( $from, $to )
        $data['active_companies'] = Clients::query()->where('status', 1)->whereBetween('created_at', [$from, $to])->count();

        // Inactive Companies Only ( Clients ), Between( $from, $to )
        $data['inactive_companies'] = Clients::query()->where('status', 0)->whereBetween('created_at', [$from, $to])->count();

        // Active Companies Only Between( $from, $to ) -> Weekly
        if( $data['companies'] > 0) {
            $data['w_active_companies'] = $data['avg'] * 7;
        }else{
            $data['w_active_companies'] = null;
        }

        // Active Companies Only Between( $from, $to ) -> Monthly
        if( $data['companies'] > 0) {
            $data['m_active_companies'] = $data['avg'] * 30;
        }else{
            $data['m_active_companies'] = null;
        }

        $data['chart_companies'] = Clients::query()
            ->whereBetween('updated_at', [$from, $to])
            ->groupByRaw('MONTHNAME(updated_at)')
            ->selectRaw('count(id) as companies, MONTHNAME(updated_at) as month' )
            ->get();


        // All Licenses Between( $from, $to )
        $data['licenses'] = License::query()->whereBetween('created_at', [$from, $to])->count();

        // Active Licenses Only, Between( $from, $to )
        $data['active_licenses'] = License::query()->where('usage', 1)->where('date', '>=', $to)->whereBetween('created_at', [$from, $to])->count();

        // Inactive Licenses Only, Between( $from, $to )
        $data['inactive_licenses'] = License::query()->where('usage', 0)->where('date', '>=', $to)->whereBetween('created_at', [$from, $to])->count();

        // Expired Licenses Only, Between( $from, $to )
        $data['expired_licenses'] = License::query()->where('date', '<', $to)->whereBetween('created_at', [$from, $to])->count();

        // Activations, Between( $from, $to )
        $data['activations'] = ApiCall::query()->whereIn('function', [\App\Models\ApiCall::ActivateLicense, \App\Models\ApiCall::DeactivateLicense])->whereBetween('created_at', [$from, $to])->count();

        $data['chart_activations'] = ApiCall::query()
            ->whereIn('function', [\App\Models\ApiCall::ActivateLicense, \App\Models\ApiCall::DeactivateLicense])
            ->whereBetween('updated_at', [$from, $to])
            ->groupByRaw('MONTHNAME(updated_at)')
            ->selectRaw('count(id) as activation, MONTHNAME(updated_at) as month' )
            ->get();

        // Last Add Licenses, Between( $from, $to )
        $data['last_add_licenses'] = License::query()->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->take(5)->get();

        // Top APIs
//        $data['top_api_calls'] = ApiCall::query()->whereBetween('created_at', [$from, $to])->whereRaw('`function` is not null')->whereNull('deleted_at')->take(5)->get();

        $data['top_api_calls'] = ApiCall::query()->whereBetween('created_at', [$from, $to])->whereRaw('`function` is not null')
            ->where('status', 1)
            ->selectRaw('id, count(id) as cnt,`function`, updated_at, api_key')
            ->groupByRaw('`function`')
            ->orderByRaw('`cnt` desc')
            ->limit(5)
            ->get();

        return view('admin.reports.general', $data, compact('to', 'from'));
    }

    public function detailed(Request $request)
    {
        // Type From Request
        $type = $request->type;

        // Data To Send
        $data = [];

        // Date ( From & To )
        $date = explode(' - ', $request->date);

        $from = Carbon::parse( $date[0]);
        $to = Carbon::parse($date[1]);
        $diff_in_days = $from->diffInDays($to);

        // All Data

            // Here Is Detailed Report For Products

            // All Products Between( $from, $to )
            $data['products'] = Products::query()->whereBetween('created_at', [$from, $to])->count();

            // Active Products Only Between( $from, $to ) -> Daily
            $data['active_products'] = Products::query()->where('status', 1)->whereBetween('created_at', [$from, $to])->count();

            // Inactive Products Only Between( $from, $to )
            $data['inactive_products'] = Products::query()->where('status', 2)->whereBetween('created_at', [$from, $to])->count();

            // Get Last Selled Products From payments Table
            $data['last_selled_products'] = Payment::query()->with(['client', 'product'])->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->limit(8)->get();

            // Total Income Every Month
            $income_array_product = array();

            $license_income_products = License::with('product')->whereYear('created_at',date('Y'))
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at),product_id')
                ->selectRaw('sum(price) as price,product_id, month(created_at) as month')
                ->orderBy('created_at','asc')
                ->get()
                ->groupBy('product_id');

            if($license_income_products){
                $i = 0;
                $color = \App\Http\Helpers\Helpers::getRandomColor();
                foreach($license_income_products as $income){

                    $income_array_product[$i]['data'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

                    foreach($income as $in){
                        $income_array_product[$i]['data'][$in->month-1] = $in->price;
                        if($in->product){
                            $income_array_product[$i]['product']= $in->product->name;
                            $color = $in->product->color;
                            $income_array_product[$i]['borderColor'] = $color;
                            $income_array_product[$i]['borderWidth'] = 1;
                            $income_array_product[$i]['backgroundColor'] = $color;
                        }
                    }
                    $i++;

                }
            }
            // Licenses Based On Products
            $data['licenses_products'] = License::with('product')->whereYear('created_at',date('Y'))
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at),product_id')
                ->selectRaw('sum(price) as price, sum(user_id) as users, product_id,month(created_at) as month, id')
                ->orderBy('created_at','desc')
                ->limit(6)
                ->get();


            // Here Is Detailed Report For Companies

            // All Companies ( Clients ), Between( $from, $to )
            $data['companies'] = Clients::query()->whereBetween('created_at', [$from, $to])->count();

            // Get AVG For Active Companies
            if($data['companies'] > 0) {
                $data['avg'] = $data['companies'] / $diff_in_days;
            }else{
                $data['avg'] = null;
            }

            // All Companies ( Clients ), Between( $from, $to ) -> weekly
            $data['w_companies'] = $data['avg'] * 7;

            // All Companies ( Clients ), Between( $from, $to ) -> monthly
            $data['m_companies'] = $data['avg'] * 30;

            // Active Companies Only ( Clients ), Between( $from, $to )
            $data['active_companies'] = Clients::query()->where('status', 1)->whereBetween('created_at', [$from, $to])->count();

            // Inactive Companies Only ( Clients ), Between( $from, $to )
            $data['inactive_companies'] = Clients::query()->where('status', 0)->whereBetween('created_at', [$from, $to])->count();

            // Get Last Selled Products Based On Companies
            $data['last_selled_products'] = Payment::query()->with(['client', 'product'])->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->limit(8)->get();

            // Get Last Active Company Based On ( updated_at )
            $data['last_active_companies'] = Clients::query()->where('status', 1)
                ->whereBetween('updated_at', [$from, $to])
                ->groupByRaw('month(updated_at)')
                ->selectRaw('count(id) as client, month(updated_at) as month' )
                ->get();

            // Get Month To Active Companies Chart
            $data['chart_active_companies'] = array();
            $i = 0;
            foreach ($data['last_active_companies'] as $last) {
                $data['chart_active_companies'][$i]['data'] = [0,0,0,0,0,0,0,0,0,0,0,0];

                $data['chart_active_companies'][$i]['data'][$last->month] = $last->client;

            }
            $i++;

            // Get Users Activities Sort By Month
            $data['user_activities'] = User::query()
                ->whereBetween('updated_at', [$from, $to])
                ->groupByRaw('month(updated_at)')
                ->selectRaw('sum(user_id) as user, month(updated_at) as month' )
                ->get();

            // Get Month To Active Companies Chart
            $data['income_active_companies'] = array();
            $i = 0;
            foreach ($data['user_activities'] as $user) {
                $data['income_active_companies'][$i]['data'] = [0,0,0,0,0,0,0,0,0,0,0,0];

                $data['income_active_companies'][$i]['data'][$user->month-1] = $user->user;

                $i++;
            }

            // Get Table Of Detailed For Companies Based On NO.Products
            $data['company_products'] = Clients::with(['products', 'licenses'])->whereBetween('created_at', [$from, $to])->get();




            // Here Is Detailed Report For Licenses

            // All Licenses Between( $from, $to )
            $data['licenses'] = License::query()->whereBetween('created_at', [$from, $to])->count();

            // Active Licenses Only, Between( $from, $to )
            $data['active_licenses'] = License::query()->where('usage', 1)->where('date', '>=', $to)->whereBetween('created_at', [$from, $to])->count();

            // Inactive Licenses Only, Between( $from, $to )
            $data['inactive_licenses'] = License::query()->where('usage', 0)->where('date', '>=', $to)->whereBetween('created_at', [$from, $to])->count();

            // Expired Licenses Only, Between( $from, $to )
            $data['expired_licenses'] = License::query()->where('date', '<', $to)->whereBetween('created_at', [$from, $to])->count();


            // Get Last Activate Licenses
            $data['last_activate_licenses'] = LicensesUse::query()->with('license')
                ->whereBetween('created_at', [$from, $to])
                ->where('is_activate', 1)
                ->orderBy('updated_at', 'desc')
                ->limit(7)
                ->get();

            // Income From Product_Licenses
            $data['income_array'] = array();
            $license_income = License::with('product')->whereYear('created_at',date('Y'))
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at),product_id')
                ->selectRaw('sum(price) as price,product_id,month(created_at) as month')
                ->orderBy('created_at','asc')
                ->get()
                ->groupBy('product_id');

            if($license_income){
                $i = 0;
                $color = \App\Http\Helpers\Helpers::getRandomColor();
                foreach($license_income as $income){
                    $data['income_array'] [$i]['data'] = [0, 0,0,0,0,0,0,0,0,0,0,0];
                    foreach($income as $in){

                        $data['income_array'] [$i]['data'][$in->month-1] = $in->price;

                        if($in->product){
                            $data['income_array'] [$i]['product']= $in->product->name;
                            $color = $in->product->color;
                            $data['income_array'] [$i]['borderColor'] = $color;
                            $data['income_array'] [$i]['borderWidth'] = 1;
                            $data['income_array'] [$i]['backgroundColor'] = $color;
                        }
                    }

                    $i++;
                }
            }



            // Last Add Licenses, Between( $from, $to )
            $data['last_add_licenses'] = License::query()->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->take(5)->get();

            // Get Table Of Licenses Based On ( Company - Product )
            $data['nearly_licenses'] = License::query()
                ->with(['client', 'product'])
                ->where('date', '<', $to)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->get();


            // Here Is Detailed Report For Activations & Notifications

            // Get All Activations ( ApiCall Model Where Function => Activation & Deactivation )
            $data['activations'] = ApiCall::query()->whereIn('function', [ApiCall::ActivateLicense,ApiCall::DeactivateLicense])->whereBetween('created_at', [$from, $to])->count();

            // Get Activations ( Activate => Success )
            $data['success_activate'] = ApiCall::query()->whereIn('function', [ApiCall::ActivateLicense])->whereNull('errors')->whereBetween('created_at', [$from, $to])->count();

            // Get Activations ( Activate => Failed )
            $data['failed_activate'] = ApiCall::query()->whereIn('function', [ApiCall::ActivateLicense])->whereNotNull('errors')->whereBetween('created_at', [$from, $to])->count();

            // Get Activations ( Deactivate => Success )
            $data['success_deactivate'] = ApiCall::query()->whereIn('function', [ApiCall::DeactivateLicense])->whereNull('errors')->whereBetween('created_at', [$from, $to])->count();

            // Get Activations ( Deactivate => Failed )
            $data['failed_deactivate'] = ApiCall::query()->whereIn('function', [ApiCall::DeactivateLicense])->whereNotNull('errors')->whereBetween('created_at', [$from, $to])->count();

            // Get All Activations Sort By Month
            $data['monthly_activations_chart'] = array();
            $data['monthly_activations'] = ApiCall::query()
                ->whereIn('function', [ApiCall::ActivateLicense,ApiCall::DeactivateLicense])
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at)')
                ->selectRaw('count(id) as activations, month(created_at) as month' )
                ->get();

            foreach ($data['monthly_activations'] as $activation) {
                $i = 0;
                $data['monthly_activations_chart'] [$i]['data'] = [0, 0,0,0,0,0,0,0,0,0,0,0];

                $data['monthly_activations_chart'] [$i]['data'][$activation->month-1] = $activation->activations;

                $i++;
            }

            // Get All Notifications Sort By Month
            $data['monthly_notifications_chart'] = array();
            $data['monthly_notifications'] = Notifications::query()
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at)')
                ->selectRaw('count(id) as notifications, month(created_at) as month' )
                ->get();

            foreach ($data['monthly_notifications'] as $notification) {
                $i = 0;
                $data['monthly_notifications_chart'] [$i]['data'] = [0, 0,0,0,0,0,0,0,0,0,0,0];

                $data['monthly_notifications_chart'] [$i]['data'][$notification->month-1] = $notification->notifications;

                $i++;
            }

            // Get All Notifications
            $data['notifications'] = Notifications::query()->whereBetween('created_at', [$from, $to])->count();

            // Get Today Notifications
            $data['todayNotificationsCount'] = Notifications::query()->whereRaw('date(date) = CURDATE()')->count();



            // Here Is Detailed Report For Downloads [ UpdateDownloads in ApiCall Model ]

            //Get All Downloads, Between ( $from, $to )
            $data['downloads'] = ApiCall::query()->whereIn('function', [ApiCall::UpdateDownloads])->whereBetween('created_at', [$from, $to])->count();

            // Get Success Downloads ( Status = 1 )
            $data['success_downloads'] = ApiCall::query()->whereIn('function', [ApiCall::UpdateDownloads])->whereBetween('created_at', [$from, $to])->where('status', 1)->count();

            // Get Failed Downloads ( Status = 0 )
            $data['failed_downloads'] = ApiCall::query()->whereIn('function', [ApiCall::UpdateDownloads])->whereBetween('created_at', [$from, $to])->where('status', 0)->count();

            // Get Last Downloads Sort By ( Created_at )
            $data['last_downloads'] = ApiCall::query()->with(['client', 'product', 'version'])
                ->whereIn('function', [ApiCall::UpdateDownloads])->whereBetween('created_at', [$from, $to])->where('status', 1)->limit(7)->get();

            // Get Chart Downloads Sort By Monthly
            $data['chart_downloads_array'] = array();
            $data['chart_monthly_downloads'] = ApiCall::query()
                ->whereIn('function', [ApiCall::UpdateDownloads])
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at)')
                ->selectRaw('count(id) as downloads, month(created_at) as month' )
                ->get();

            foreach ($data['chart_monthly_downloads'] as $downloads) {
                $i = 0;
                $data['chart_downloads_array'] [$i]['data'] = [0, 0,0,0,0,0,0,0,0,0,0,0];

                $data['chart_downloads_array'] [$i]['data'][$downloads->month-1] = $downloads->downloads;

                $i++;
            }


            // Downloads Based On Products
            $data['product_downloads'] = ApiCall::with('product')->whereYear('created_at',date('Y'))
                ->whereIn('function', [ApiCall::UpdateDownloads])
                ->whereBetween('created_at', [$from, $to])
                ->whereNotNull('product_id')
                ->groupByRaw('month(created_at), product_id')
                ->selectRaw('count(id) as downloads,product_id, count(product_id) as products,month(created_at) as month')
                ->orderBy('created_at','desc')
                ->limit(4)
                ->get();

            $data['download_products_array'] = array();
            if($data['product_downloads']) {
                $i = 0;
                foreach ($data['product_downloads'] as $income) {
                    $data['download_products_array'] [$i]['data'] = [0, 0, 0, 0,];

                    $color = \App\Http\Helpers\Helpers::getRandomColor();

                    $data['download_products_array'] [$i]['data'][$income->month-1] = $income->downloads;
                    $data['download_products_array'] [$i]['product']= $income->product->name;
                    $data['download_products_array'] [$i]['products']= $income->products;
                    $data['download_products_array'] [$i]['backgroundColor'] = $color;

                    $i++;
                }
            }

            // Here Is Detailed Report For API Call

            // Get All Api Call
            $data['api_calls'] = ApiCall::query()->whereBetween('created_at', [$from, $to])->count();

            // Get Success API Calls ( status = 1 )
            $data['success_api_calls'] = ApiCall::query()->whereBetween('created_at', [$from, $to])->where('status', 1)->count();

            // Get Success API Calls ( status = 1 )
            $data['failed_api_calls'] = ApiCall::query()->whereBetween('created_at', [$from, $to])->where('status', 0)->count();

            // Last API Call
            $data['last_api_calls'] = ApiCall::query()->with(['client', 'product', 'version'])
                ->whereBetween('created_at', [$from, $to])
                ->where('status', 0)
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();

            // Get API Call Sort By Monthly
            $data['chart_api_calls'] = array();
            $data['monthly_api_calls'] = ApiCall::query()
                ->whereBetween('created_at', [$from, $to])
                ->groupByRaw('month(created_at)')
                ->selectRaw('count(id) as api_calls, month(created_at) as month' )
                ->get();

            foreach ($data['monthly_api_calls'] as $api){
                $i = 0;

                $data['chart_api_calls'] [$i]['data'] = [0, 0,0,0,0,0,0,0,0,0,0,0];

                $data['chart_api_calls'] [$i]['data'][$api->month-1] = $api->api_calls;

                $i++;

            }


        // Top APIs
        $data['top_api_calls'] = ApiCall::query()->with(['product', 'version'])->whereBetween('created_at', [$from, $to])->whereRaw('`function` is not null')
            ->whereNull('deleted_at')
            ->whereNotNull('version_id')
            ->where('status', 1)
            ->selectRaw('id, count(id) as cnt,`function`, created_at, product_id, version_id')
            ->groupByRaw('`function`')
            ->orderByRaw('`cnt` desc')
            ->limit(5)
            ->get();


        return view('admin.reports.detailed', $data, [
            'type' => $type,
            'from' => $from,
            'to' => $to,
            'income_array_product' => $income_array_product,
        ]);
    }
}
