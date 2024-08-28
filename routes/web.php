<?php
use App\Http\Controllers\Admin\AccountSettingsController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ErrorPageController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\ReplyController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\TicketsController;
use App\Http\Controllers\FreshDeskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\LoginAdminController;
use \App\Http\Controllers\Admin\DashboardController;
use \App\Http\Controllers\Admin\SettingController;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\ClientsController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\VersionController;
use \App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientUserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\EmailSettingsController;
use App\Http\Controllers\Admin\LicenseController;
use \App\Http\Controllers\Admin\NotificationController;
use \App\Http\Controllers\Admin\HashingController;
use \App\Http\Controllers\Admin\ActivationController;
use App\Http\Controllers\Admin\ProductPackageController;
use App\Http\Controllers\Admin\ApiCallController;
use App\Http\Controllers\Admin\DownloadContoller;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RenewalTeamController;
use App\Http\Controllers\Admin\TicketStatusController;
use App\Http\Controllers\Admin\TicketPrriotaryController;
use App\Http\Controllers\Admin\TicketTypeController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Site\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('decryption', [HashingController::class, 'decryption']);
Route::get('page/{slug}', [HomeController::class, 'page']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return redirect('/admin/dashboard');
})->name('home');

Route::get('/admin', function () {
    return redirect('/admin/login');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware'  => ['web', 'guest']], function () {
    Route::get('login', [LoginAdminController::class, 'getIndex'])->name('admin.login');
    Route::get('forget-password', ['as' => 'admin.dashboard.forget', 'uses' => 'LoginAdminController@forgetPassword']);
    Route::post('forget-password', ['as' => 'admin.dashboard.forget', 'uses' => 'LoginAdminController@ForgetPasswordPost']);
    Route::get('reset-password/{random}', ['as' => 'admin.reset-password.random', 'uses' => 'LoginAdminController@resetPassword']);
    Route::post('reset-password', ['as' => 'admin.reset-password', 'uses' => 'LoginAdminController@ResetPasswordPost']);
    Route::post('adminlogin', [LoginAdminController::class, 'postIndex'])->name('adminlogin');
});


Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {

    // DASHBOARD ROUTE
    Route::get('dashboard',  [DashboardController::class, 'index'])->name('admin.dashboard.view');
    Route::get('/dashboard/clients-chart', [DashboardController::class, 'getClientsChardData']);
    Route::get('/dashboard/activation-chart', [DashboardController::class, 'getActivationsChardData'])->name('admin.dashboard.activation-chart');
    Route::get('/dashboard/download-history', [DashboardController::class, 'getDownloadHistory'])->name('admin.dashboard.download-history');
    Route::get('/dashboard/notification-history', [DashboardController::class, 'getNotificationHistory'])->name('admin.dashboard.notification-history');
    Route::get('/dashboard/api-activity', [DashboardController::class, 'getApiActivity'])->name('admin.dashboard.api-activity');
    Route::get('/dashboard/product-licenses', [DashboardController::class, 'getProductLicenses'])->name('admin.dashboard.product-licenses');
    Route::get('/dashboard/active-clients', [DashboardController::class, 'getActiveClients'])->name('admin.dashboard.active-clients');
    Route::get('/dashboard/top-apicall', [DashboardController::class, 'getTopApiCall'])->name('admin.dashboard.top-apicall');
    Route::get('/dashboard/activation-activity', [DashboardController::class, 'getActivationActivity'])->name('admin.dashboard.activation-activity');

    // Report Route
    Route::post('/general-report', [ReportController::class, 'general'])->name('report.general');
    Route::post('/detailed-report', [ReportController::class, 'detailed'])->name('report.detailed');

    // SETTING ROUTRE
    Route::get('setting',  [SettingController::class, 'index'])->name('admin.setting.index')->middleware('permission:setting');
    Route::post('setting/update',  [SettingController::class, 'update'])->name('admin.setting.update')->middleware('permission:update_setting');
    Route::get('api-setting',  [SettingController::class, 'api_setting'])->name('admin.setting.api_setting')->middleware('permission:setting');
    Route::post('api-setting/update_api_setting',  [SettingController::class, 'update_api_setting'])->name('admin.setting.update_api_setting')->middleware('permission:update_api_setting');

    // Route::get('email-settings', [EmailSettingsController::class, 'index'])->name("admin.setting.email_setting")->middleware('permission:email_setings');
    Route::post('update-email-settings', [EmailSettingsController::class, 'update'])->name("admin.setting.update_email_setting")->middleware('permission:update_email_setings');
    Route::get('account-setting', [AccountSettingsController::class, 'index'])->name('admin.setting.account');
    Route::post('account-setting', [AccountSettingsController::class, 'update'])->name('admin.setting.update_account');

    Route::post('change-password', [AccountSettingsController::class, 'changePassword'])->name('admin.setting.change_appsword');

    Route::get('get-api-key',  [SettingController::class, 'get_api_key'])->name('admin.setting.get_api_key')->middleware('permission:get_api_key');
    Route::post('add-api-key',  [SettingController::class, 'add_api_key'])->name('admin.setting.add_api_key')->middleware('permission:add_api_key');
    Route::post('delete-api-key',  [SettingController::class, 'delete_api_key'])->name('admin.setting.delete_api_key')->middleware('permission:delete_api_key');

    // NOTIFICATIONS ROUTRE
    Route::get('notifications',  [NotificationController::class, 'index'])->name('admin.notifications.index')->middleware('permission:notifications');
    Route::get('notifications/edit/{id}',  [NotificationController::class, 'edit'])->name('admin.notifications.edit')->middleware('permission:update_notifications');
    Route::get('notifications/view/{id}',  [NotificationController::class, 'view'])->name('admin.notifications.view')->middleware('permission:view_notifications');
    Route::get('notifications/create',  [NotificationController::class, 'create'])->name('admin.notifications.create')->middleware('permission:add_notifications');
    Route::post('notifications/add',  [NotificationController::class, 'add'])->name('admin.notifications.add')->middleware('permission:add_notifications');
    Route::post('notifications/update',  [NotificationController::class, 'update'])->name('admin.notifications.update')->middleware('permission:update_notifications');
    Route::post('notifications/delete',  [NotificationController::class, 'delete'])->name('admin.notifications.delete')->middleware('permission:delete_notifications');

    // PRODUCTS ROUTRE
    Route::get('products',  [ProductController::class, 'index'])->name('admin.products.index')->middleware('permission:products');
    Route::get('products/edit/{id}',  [ProductController::class, 'edit'])->name('admin.products.edit')->middleware('permission:update_products');
    Route::get('products/create',  [ProductController::class, 'create'])->name('admin.products.create')->middleware('permission:add_products');
    Route::post('products/add',  [ProductController::class, 'add'])->name('admin.products.add')->middleware('permission:add_products');
    Route::post('products/update',  [ProductController::class, 'update'])->name('admin.products.update')->middleware('permission:update_products');
    Route::post('products/delete',  [ProductController::class, 'delete'])->name('admin.products.delete')->middleware('permission:delete_products');
    Route::get('products/select',  [ProductController::class, 'select'])->name('admin.products.select');
    Route::get('products/checkClients',  [ProductController::class, 'checkClients'])->name('admin.products.checkClients');
    Route::get('products/getClients',  [ProductController::class, 'getClients'])->name('admin.products.getClients');
    Route::post('products/add_to_client',  [ProductController::class, 'add_to_client'])->name('admin.products.add_to_client');
    Route::post('products/update-status', [ProductController::class, 'updateStatus'])->name('admin.products.update_status');

    // Ajax To Get Contact By User
    Route::post('products/get-contact', [ProductController::class, 'getContact'])->name('getContact');

    // STATIC ROUTE
    Route::get('static_page', ['as' => 'admin.static_page.index', 'uses' => '\App\Http\Controllers\Admin\StaticPageController@index']);
    Route::get('static_page/edit', ['as' => 'admin.static_page.edit', 'uses' => '\App\Http\Controllers\Admin\StaticPageController@edit']);
    Route::post('static_page/add', ['as' => 'admin.static_page.add', 'uses' => '\App\Http\Controllers\Admin\StaticPageController@add']);
    Route::post('static_page/update', ['as' => 'admin.static_page.update', 'uses' => '\App\Http\Controllers\Admin\StaticPageController@update']);
    Route::post('static_page/UpdateStats', ['as' => 'admin.static_page.UpdateStats', 'uses' => '\App\Http\Controllers\Admin\StaticPageController@UpdateStats']);
    Route::post('static_page/delete', ['as' => 'admin.static_page.delete', 'uses' => '\App\Http\Controllers\Admin\StaticPageController@delete']);

    // Start Ticket Route
    Route::get('/tickets', [TicketsController::class, 'index'])->name('ticket.index');
    Route::get('/tickets/{id}', [TicketsController::class, 'show'])->name('ticket.show');
    Route::put('/tickets/{id}', [TicketsController::class, 'update'])->name('ticket.update');
    Route::delete('/tickets/{id}', [TicketsController::class, 'destroy'])->name('ticket.delete');

    // Close & Restore Ticket & Forward
    Route::put('/tickets/{id}/close', [TicketsController::class, 'close'])->name('ticket.close');
    Route::put('/tickets/{id}/restore', [TicketsController::class, 'restore'])->name('ticket.restore');
    Route::post('/tickets/{id}/forward', [TicketsController::class, 'restore'])->name('ticket.forward');
    Route::get('/ticket/select/', [TicketsController::class, 'select'])->name('ticket.select');
    Route::get('tickets/{id}/company', [TicketsController::class, 'companyFilter'])->name('ticket.companyFilter');
    // End Ticket Route

    // Start Ticket Reply
    Route::post('/reply/{id}', [ReplyController::class, 'store'])->name('reply.store');
    // End Ticket Reply

    // Start Group Route
    Route::get('/groups', [GroupController::class, 'index'])->name('group.index');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('group.create');
    Route::post('/groups/add', [GroupController::class, 'store'])->name('group.store');
    Route::get('groups/edit', [GroupController::class, 'edit'])->name('group.edit');
    Route::post('groups/update', [GroupController::class, 'update'])->name('group.update');
    Route::post('groups/delete', [GroupController::class, 'destroy'])->name('group.delete');
    // End Group Route



    // Start Tags Route
    Route::get('/tags', [TagsController::class, 'index'])->name('tag.index');
    Route::get('/tags/create', [TagsController::class, 'create'])->name('tag.create');
    Route::post('/tags/add', [TagsController::class, 'store'])->name('tag.store');
    Route::get('tags/edit', [TagsController::class, 'edit'])->name('tag.edit');
    Route::post('tags/update', [TagsController::class, 'update'])->name('tag.update');
    Route::post('tags/delete', [TagsController::class, 'destroy'])->name('tag.delete');
    // End Tags Route




    // Start status Route
    Route::get('/status', [TicketStatusController::class, 'index'])->name('status.index');
    Route::get('/status/create', [TicketStatusController::class, 'create'])->name('status.create');
    Route::post('/status/add', [TicketStatusController::class, 'store'])->name('status.store');
    Route::get('status/edit', [TicketStatusController::class, 'edit'])->name('status.edit');
    Route::post('status/update', [TicketStatusController::class, 'update'])->name('status.update');
    Route::post('status/delete', [TicketStatusController::class, 'destroy'])->name('status.delete');
    // End status Route


    // Start  priotary
    Route::get('/priotary', [TicketPrriotaryController::class, 'index'])->name('priotary.index');
    Route::get('/priotary/create', [TicketPrriotaryController::class, 'create'])->name('priotary.create');
    Route::post('/priotary/add', [TicketPrriotaryController::class, 'store'])->name('priotary.store');
    Route::get('priotary/edit', [TicketPrriotaryController::class, 'edit'])->name('priotary.edit');
    Route::post('priotary/update', [TicketPrriotaryController::class, 'update'])->name('priotary.update');
    Route::post('priotary/delete', [TicketPrriotaryController::class, 'destroy'])->name('priotary.delete');
    // End priotary Route


    // Start Type Route
    Route::get('/type', [TicketTypeController::class, 'index'])->name('type.index');
    Route::get('/type/create', [TicketTypeController::class, 'create'])->name('type.create');
    Route::post('/type/add', [TicketTypeController::class, 'store'])->name('type.store');
    Route::get('type/edit', [TicketTypeController::class, 'edit'])->name('type.edit');
    Route::post('type/update', [TicketTypeController::class, 'update'])->name('type.update');
    Route::post('type/delete', [TicketTypeController::class, 'destroy'])->name('type.delete');
    // End Type Route


    // Product Package ROUTES
    Route::name('admin.products.')->group(function () {
        Route::get('products/{product}/product-packages', [ProductPackageController::class, 'index'])->name('packages.index')->middleware('permission:packages');;
        Route::post('products/{product}/product-packages/update-status', [ProductPackageController::class, 'triggerStatus'])->name('packages.update-status')->middleware('permission:update_status_packages');
        Route::post('products/{product}/packages/update/{package}', [ProductPackageController::class, 'update'])->name('packages.update')->middleware('permission:edit_packages');
        Route::resource('products/{product}/packages', 'ProductPackageController')->except('index', 'update');
    });

    // VERSIONS ROUTRE
    Route::get('versions/{product_id}',  [VersionController::class, 'index'])->name('admin.versions.index')->middleware('permission:versions');
    Route::get('versions/{product_id}/edit/{id}',  [VersionController::class, 'edit'])->name('admin.versions.edit')->middleware('permission:update_versions');
    Route::get('versions/{product_id}/create',  [VersionController::class, 'create'])->name('admin.versions.create')->middleware('permission:add_versions');
    Route::post('versions/add',  [VersionController::class, 'add'])->name('admin.versions.add')->middleware('permission:add_versions');
    Route::post('versions/update',  [VersionController::class, 'update'])->name('admin.versions.update')->middleware('permission:update_versions');
    Route::post('versions/delete',  [VersionController::class, 'delete'])->name('admin.versions.delete')->middleware('permission:delete_versions');
    Route::get('versions/downloads/{id}',  [VersionController::class, 'downloads'])->name('admin.versions.downloads')->middleware('permission:download_files');
    Route::post('versions/update_status',  [VersionController::class, 'update_status'])->name('admin.versions.update_status')->middleware('permission:status_version');

    // CLIENTS ROUTRE
    Route::get('clients',  [ClientController::class, 'index'])->name('admin.clients.index')->middleware('permission:clients');
    Route::get('clients/edit/{id}',  [ClientController::class, 'edit'])->name('admin.clients.edit')->middleware('permission:update_clients');
    Route::get('clients/create',  [ClientController::class, 'create'])->name('admin.clients.create')->middleware('permission:add_clients');
    Route::post('clients/add',  [ClientController::class, 'add'])->name('admin.clients.add')->middleware('permission:add_clients');
    Route::post('clients/update',  [ClientController::class, 'update'])->name('admin.clients.update')->middleware('permission:update_clients');
    Route::post('clients/delete',  [ClientController::class, 'delete'])->name('admin.clients.delete')->middleware('permission:delete_clients');
    Route::post('clients/update-status', [ClientController::class, 'updateStatus'])->name('admin.clients.update_status');
    Route::get('clients/select',  [ClientController::class, 'select'])->name('admin.clients.select');
    Route::get('clients/products-licenses',  [ClientController::class, 'productsLicenses'])->name('admin.clients.products.licenses');
    Route::get('clients/product-mange/{client_id}/{product_id}',  [ClientController::class, 'productMange'])->name('admin.clients.products.manage');
    //Ajax For Clients

    Route::post('clients/get-email', [ClientController::class, 'getEmail'])->name('getEmail');
    // Gitlab Update
    Route::get('clients/gitlab/{client_id}/{product_id}', [ClientController::class, 'gitlab'])->name('gitlab');
    Route::post('clients/gitlab/{id}/update', [ClientController::class, 'updateGitLab'])->name('updateGitlab');


    Route::get('clients/{id}', [ClientController::class, 'show'])->name("admin.clients.show");
    Route::get('clients/{client}/get-chart-data', [ClientController::class, 'getChartData'])->name('admin.clients.get_chart_data');

    // clients users ROUTE
    Route::get('clients/{clientId}/users', [ClientUserController::class, 'index'])->name('admin.clients.users.index')/*->middleware('permission:show_client_users')*/;
    Route::get('clients/{clientId}/users/create', [ClientUserController::class, 'create'])->name('admin.clients.users.create')->middleware('permission:add_client_user');
    Route::post('clients/{clientId}/users/create', [ClientUserController::class, 'store'])->name('admin.clients.users.store')->middleware('permission:add_client_user');
    Route::delete('clients/{clientId}/users/{userId}/delete', [ClientUserController::class, 'delete'])->name('admin.clients.users.delete')->middleware('permission:delete_client_user');
    Route::get('clients/{clientId}/users/{userId}/edit', [ClientUserController::class, 'edit'])->name('admin.clients.users.edit')->middleware('permission:edit_client_user');
    Route::post('clients/{clientId}/users/{userId}/update', [ClientUserController::class, 'update'])->name('admin.clients.users.update')->middleware('permission:edit_client_user');
    Route::post('clients/{clientId}/users/{userId}/update_status', [ClientUserController::class, 'updateStatus'])->name('admin.clients.users.update_status');



    Route::get('renewal-team',  [RenewalTeamController::class, 'index'])->name('admin.renewal-team.index')->middleware('permission:renewal_team');


    // Licenses ROUTRE
    Route::get('licenses',  [LicenseController::class, 'index'])->name('admin.licenses.index')->middleware('permission:licenses');
    Route::get('licenses/edit/{id}',  [LicenseController::class, 'edit'])->name('admin.licenses.edit')->middleware('permission:update_licenses');
    Route::get('licenses/create',  [LicenseController::class, 'create'])->name('admin.licenses.create')->middleware('permission:add_licenses');
    Route::get('licenses/download/{id}',  [LicenseController::class, 'download'])->name('admin.licenses.download')->middleware('permission:download_licenses');
    Route::get('licenses/ip_details',  [LicenseController::class, 'ipDetails'])->name('admin.licenses.ip-details');
    Route::post('licenses/add',  [LicenseController::class, 'add'])->name('admin.licenses.add')->middleware('permission:add_licenses');
    Route::post('licenses/update',  [LicenseController::class, 'update'])->name('admin.licenses.update')->middleware('permission:update_licenses');
    // Route::post('licenses/delete',  [LicenseController::class, 'delete'])->name('admin.licenses.delete')->middleware('permission:delete_licenses');
    Route::post('licenses/send_mail',  [LicenseController::class, 'send_mail'])->name('admin.licenses.send_mail')->middleware('permission:send_mail_licenses');
    Route::post('licenses/update_status',  [LicenseController::class, 'update_status'])->name('admin.licenses.update_status')->middleware('permission:block_licenses');

    // Ajax For Packages
    Route::get('licenses/package',  [LicenseController::class, 'getPackage'])->name('admin.licenses.getPackage');

    // Get Duration
    Route::get('licenses/get-duration',  [LicenseController::class, 'getDuration'])->name('admin.licenses.getDuration');

    // Ajax For Total Packages Price
    Route::get('licenses/price',  [LicenseController::class, 'getPrice'])->name('admin.licenses.getPrice');

    // Get Total price
    Route::get('licenses/total-price',  [LicenseController::class, 'getTotalPrice'])->name('admin.licenses.getTotalPrice');

    Route::get('users',  [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/edit',  [UserController::class, 'edit'])->name('admin.users.edit')->middleware('permission:update_users');
    Route::get('users/getpermission',  [UserController::class, 'getpermission'])->name('admin.users.getpermission')->middleware('permission:permission_users');
    Route::post('users/add',  [UserController::class, 'add'])->name('admin.users.add')->middleware('permission:add_users');
    Route::post('users/update',  [UserController::class, 'update'])->name('admin.users.update')->middleware('permission:update_users');
    Route::post('users/UpdateStats',  [UserController::class, 'UpdateStats'])->name('admin.users.UpdateStats')->middleware('permission:change_status_users');
    Route::post('users/delete',  [UserController::class, 'delete'])->name('admin.users.delete')->middleware('permission:delete_users');
    Route::post('users/changepassword',  [UserController::class, 'changepassword'])->name('admin.users.changepassword')->middleware('permission:change_password_user');
    Route::post('users/permission',  [UserController::class, 'permission'])->name('admin.users.permission'); //->middleware('permission:permission_users');
    Route::post('users/userpermission',  [UserController::class, 'userpermission'])->name('admin.users.userpermission'); //->middleware('permission:permission_users');

    Route::get('countries', [CountryController::class, 'index'])->name('admin.countries.index');
    Route::post('countries/update-status', [CountryController::class, 'updateStatus'])->name('admin.countries.update_status');
    Route::get('country-select', [CountryController::class, 'select'])->name('admin.country.select');
    Route::get('city-select', [CityController::class, 'select'])->name('admin.city.select');

    // ROLES ROUTRE
    Route::get('roles',  [RoleController::class, 'index'])->name('admin.roles.index')->middleware('permission:roles');
    Route::post('roles/add',  [RoleController::class, 'add'])->name('admin.roles.add')->middleware('permission:add_roles');
    Route::post('roles/update',  [RoleController::class, 'update'])->name('admin.roles.update')->middleware('permission:update_roles');
    Route::get('roles/edit',  [RoleController::class, 'edit'])->name('admin.roles.edit')->middleware('permission:update_roles');
    Route::post('roles/delete',  [RoleController::class, 'delete'])->name('admin.roles.delete')->middleware('permission:delete_roles');
    Route::get('roles/permission',  [RoleController::class, 'permissionRole'])->name('admin.roles.permission_role')->middleware('permission:permission_roles');
    Route::post('roles/permission',  [RoleController::class, 'permission'])->name('admin.roles.permission')->middleware('permission:permission_roles');

    // activiy logs ROUTES
    Route::get('activiy-logs', [ActivityLogController::class, 'index'])->name('admin.activity_logs.index')->middleware('permission:activity_logs');
    Route::get('activiy-logs-table', [ActivityLogController::class, 'getTable'])->name('admin.activity_logs.getTable')->middleware('permission:activity_logs');
    Route::delete('activiy-logs/delete', [ActivityLogController::class, 'destroy'])->name('admin.activity_logs.delete')->middleware('permission:delete_activity_log');

    Route::get('activations', [ActivationController::class, 'index'])->name('admin.activations.index')->middleware('permission:activations');
    Route::post('activations/delete', [ActivationController::class, 'delete'])->name('admin.activations.delete')->middleware('permission:delete_activations');

    Route::get('downloads', [DownloadContoller::class, 'index'])->name('admin.downloads.index')->middleware('permission:downloads');
    Route::post('downloads/delete', [DownloadContoller::class, 'delete'])->name('admin.downloads.delete')->middleware('permission:delete_downloads');

    Route::get('api-calls', [ApiCallController::class, 'index'])->name('admin.api-calls.index')->middleware('permission:api_calls');
    Route::get('api-calls/view-error', [ApiCallController::class, 'view_error'])->name('admin.api-calls.view-error');
    Route::post('api-calls/delete', [ApiCallController::class, 'delete'])->name('admin.api-calls.delete')->middleware('permission:delete_api_calls');

    // cities ROUTES
    Route::name('admin.')->group(function () {
        Route::resource('cities', 'CityController');
        Route::post('cities/update-status', [CityController::class, 'updateStatus'])->name('cities.update_status');
        Route::post('cities/delete', [CityController::class, 'delete'])->name('cities.delete')->middleware('permission:delete_cities');
    });


    Route::get('logout', [LoginAdminController::class, 'getLogout'])->name('admin.dashboard.logout');
    Route::get('/clear', function () {

        Cache::forget('spatie.permission.cache');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('config:cache');
        return 'cleared';
    });

    Route::get('/product-license-statistic/{license_id}', [\App\Http\Controllers\Admin\ProductLicenseStatisticController::class, 'index'])->name('product-license-statistic');

});
Route::group(['namespace' => 'Admin', 'prefix' => 'error', 'middleware' => ['web', 'guest']], function () {
    Route::get('/not_found', [ErrorPageController::class, 'notFound'])->name('notFound');
});
// 22;
