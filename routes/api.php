<?php

use App\Http\Controllers\Api\ReplyController;
use App\Http\Controllers\Api\TicketsSystemController;
use App\Http\Controllers\ApiCall\Product\AccessDataController;
use App\Http\Controllers\FreshDeskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCall\Product\GetLatestVersionContoller;
use App\Http\Controllers\ApiCall\Product\CheckUpdateVersionContoller;
use App\Http\Controllers\ApiCall\Product\UpdateDownloadContoller;
use App\Http\Controllers\ApiCall\Product\SendEmailWithNewVersion;
use App\Http\Controllers\ApiCall\License\CheckAvailabilityLicenseController;
use App\Http\Controllers\ApiCall\License\ActivateLicenseContoller;
use App\Http\Controllers\ApiCall\License\DeactivateLicenseContoller;
use App\Http\Controllers\ApiCall\License\SignInController;
use App\Http\Controllers\ApiCall\License\SignOutController;
use App\Http\Controllers\ApiCall\Package\ViewPackageContoller;
use App\Http\Controllers\ApiCall\Payment\PaymentController;
use App\Http\Controllers\ApiCall\Hashing\HashingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => ['api']], function () {
    Route::post('payments',  [PaymentController::class, 'payments'])->name('api.payments');
    Route::get('payments/success',  [PaymentController::class, 'success'])->name('api.payments.success');
    Route::get('payments/faild',  [PaymentController::class, 'faild'])->name('api.payments.faild');

    Route::get('versions/send-email',  [SendEmailWithNewVersion::class, 'SendEmailWithNewVersion'])->name('api.version.sendEmail');
    Route::post('decryption', [HashingController::class, 'decryption']);

});

Route::group(['middleware' => ['api','ValidationApiRequest']], function () {
    Route::post('products/get-last-version',  [GetLatestVersionContoller::class, 'GetLastVersion'])->name('api.products.get-last-version');
    Route::post('products/check-update',  [CheckUpdateVersionContoller::class, 'CheckUpdate'])->name('api.products.check-update');
    Route::post('products/update-download',  [UpdateDownloadContoller::class, 'UpdateDownload'])->name('apicall.products.update-download');
    Route::post('packages/view-package',  [ViewPackageContoller::class, 'ViewPackage'])->name('apicall.products.view-package');
    Route::post('access-data', [AccessDataController::class, 'accessData'])->name('apicall.access-data');

    Route::post('license/check-availability-license',  [CheckAvailabilityLicenseController::class, 'CheckAvailabilityLicense'])->name('api.license.check-availability-license');
    Route::post('license/activate-license',  [ActivateLicenseContoller::class, 'ActivateLicense'])->name('api.license.activate-license');
    Route::post('license/activate-offline-license',  [ActivateLicenseContoller::class, 'ActivateOfflineLicense'])->name('api.license.activate-offline-license');
    Route::post('license/deactivate-license',  [DeactivateLicenseContoller::class, 'DeactivateLicense'])->name('api.license.deactivate-license');
    Route::post('license/sign-in',  [SignInController::class, 'signIn'])->name('api.sign-in');
    Route::post('license/sign-out',  [SignOutController::class, 'signOut'])->name('api.sign-out');


});

Route::group(['middleware' => ['api', 'TicketSystem']], function () {
    Route::post('/tickets/create', [TicketsSystemController::class, 'store'])->name('ticket.store');
    Route::get('/tickets', [TicketsSystemController::class, 'show'])->name('ticket.show');
    Route::put('/tickets/{id}', [TicketsSystemController::class, 'update'])->name('ticket.update');
    Route::delete('/tickets/{id}', [TicketsSystemController::class, 'destroy'])->name('ticket.delete');
    Route::put('/tickets/restore/{id}', [TicketsSystemController::class, 'restore'])->name('ticket.restore');
    Route::get('/tickets/setting', [TicketsSystemController::class, 'ticketSetting'])->name('ticket.setting');

});
Route::group(['middleware' => ['api', 'Reply']], function () {
    Route::post('/reply', [ReplyController::class, 'store'])->name('ticket.store');
    Route::get('/getTicketsDetails/{id}', [ReplyController::class, 'showAll'])->name('ticket.showAll');
});

