<?php

namespace App\Providers;

use App\Models\Clients;
use App\Models\ClientUser;
use App\Models\License;
use App\Models\Products;
use App\Models\Setting;
use App\Models\Versions;
use App\Observers\ClientsObserver;
use App\Observers\ClientUserObserver;
use App\Observers\LicenseObserver;
use App\Observers\ProductObserver;
use App\Observers\VersionObserver;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Console\ServeCommand;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Paginate a standard Laravel Collection.
         *
         * @param int $perPage
         * @param int $total
         * @param int $page
         * @param string $pageName
         * @return array
         */
        Collection::macro('paginate', function ($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);
            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Clients::observe(ClientsObserver::class);
        ClientUser::observe(ClientUserObserver::class);
        Products::observe(ProductObserver::class);
        Versions::observe(VersionObserver::class);
        License::observe(LicenseObserver::class);

//        Schema::defaultStringLength(255);

        Paginator::useBootstrap();
        View::composer('admin.layout.master_layout', function ($view) {
            $view->with('site_setting', \App\Models\Setting::first(['name', 'image', 'email', 'mobile']));
        });

        View::composer('email.layouts.master', function ($view) {
            $view->with('site_setting', \App\Models\Setting::first(['name', 'image', 'email', 'mobile','instagram','twitter','linkedin']));
        });

        View::composer('site.layout', function ($view) {
            $view->with('setting', \App\Models\Setting::first());
        });


    }
}
