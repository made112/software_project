<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreProductPackageRequest;
use App\Http\Requests\Admin\Products\UpdateProductPackageRequest;
use App\Models\ProductPackage;
use App\Models\ProductPackagePrice;
use App\Models\Products;
use App\Models\Setting;
use App\Notifications\AddNewPackageToProductNotification;
use App\Notifications\AddNewVersionToProductNotification;
use App\Notifications\EditPackageNotification;
use App\Notifications\EditPackageToAdminNotification;
use App\Notifications\NewPackageToAdminNotification;
use Exception;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductPackageController extends Controller
{

    /**
     * @var ProductPackage;
     */
    protected $model;


    public function __construct(ProductPackage $model)
    {
        $this->model = $model;
    }

    /**
     * return packages for specific product
     *
     * @param Request $request
     * @param Products $product
     *
     * @return string
     */
    public function index(Request $request, Products $product)
    {
        $packages = $this->model->filter( $request->all() );


        $packages = $packages->with('product')->select('id', 'name', 'description', 'type', 'duration', 'time', 'duration_days', 'type_price', 'support_type', 'support_price', 'prime_type', 'prime_price', 'status', 'product_id', 'created_at', 'updated_at')
            ->where('product_id', $product->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        if (request()->ajax()) {
            return view('admin.products.packages.table', compact('packages', 'product'))->render();
        }
        return view('admin.products.packages.index')
            ->with('packages', $packages)
            ->with('product', $product);
    }

    /**
     * show craete new package form
     *
     * @param Products $product
     *
     * @return View
     *
     */
    public function create(Products $product): View
    {
        $types = ProductPackage::TYPES;
        $duration_types = ProductPackage::DURATION_TYPES;
        return view('admin.products.packages.create')
            ->with('types', $types)
            ->with('duration_types', $duration_types)
            ->with('product', $product);
    }

    /**
     * store new package by prices
     *
     * @param Products $product
     * @param StoreProductPackageRequest $request
     *
     * @return JsonResponse
     *
     */
    // public function store(Products $product, StoreProductPackageRequest $request): JsonResponse
    // {
    //     $data = $request->validated();

    //     $data['remotly_support_type'] = isset($data['remotly_support_type']);
    //     $data['prime_support_type'] = isset($data['prime_support_type']);

    //     // Validation
    //     if (!$data['remotly_support_type'] and !$data['prime_support_type']) {
    //         return response()->json(['status' => false, 'data' => __('lang.support_type_required')]);
    //     }

    //     $data['product_id'] = $product->id;
    //     try {
    //         DB::beginTransaction();
    //         $package = ProductPackage::create($data);

    //         if (isset($data['duration_prices'])) {
    //             foreach ($data['duration_prices'] as $durationPrice) {
    //                 $this->assignPricesToPackage($product, $package, $durationPrice, ProductPackagePrice::PRICES_TYPES[0]['id']);
    //             }
    //         }

    //         if (isset($data['remotly_support_type_durations'])) {
    //             foreach ($data['remotly_support_type_durations'] as $durationPrice) {
    //                 $this->assignPricesToPackage($product, $package, $durationPrice, ProductPackagePrice::PRICES_TYPES[1]['id']);
    //             }
    //         }

    //         if (isset($data['prime_support_type_durations'])) {
    //             foreach ($data['prime_support_type_durations'] as $durationPrice) {
    //                 $this->assignPricesToPackage($product, $package, $durationPrice, ProductPackagePrice::PRICES_TYPES[2]['id']);
    //             }
    //         }

    //         DB::commit();

    //         // Send Email After Created
    //         $product = Products::where('id', $product->id)->first();
    //         $product->user->notify(new AddNewPackageToProductNotification($product));
    //     } catch (Exception $exception) {
    //         DB::rollBack();
    //         return response()->json(['status' => false, 'data' => __('lang.error')]);
    //     }

    //     return response()->json(['status' => true, 'data' => __('lang.success')]);
    // }
    public function store(Products $product, StoreProductPackageRequest $request): JsonResponse
    {

        $duration = null;
        if ($request->duration_free) {
            $duration = 1;
        } elseif ($request->duration_paid) {
            $duration = $request->duration_paid;
        }

        $time = null;
        if ($request->duration_paid == 3) {
            $time = 1;
        } else {
            $time = $request->time;
        }

        $support_type = null;
        if ($request->support_type_free) {
            $support_type = 1;
        } elseif ($request->support_type_paid) {
            $support_type = 2;
        } else {
            $support_type = null;
        }

//        $prime_support_type = null;
//
//        if ($request->prime_support_type_free) {
//            $prime_support_type = 1;
//        } else {
//            $prime_support_type = 2;
//        }

        $prime_type = null;
        if (!$request->prime_support_type && !$request->prime_support_type_free && !$request->prime_support_type_paid) {
            $prime_type = null;
        } elseif( $request->prime_support_type_free ) {
            $prime_type = 1;
        }elseif( $request->prime_support_type_paid ){
            $prime_type = 2;
        }

        $type_price = null;
        if ($request->price) {
            $type_price = $request->price;
        } else {
            $type_price = 0;
        }

        $package = new ProductPackage();

        $package_exists = $package->checkPackage(1, $request->name, $product->id);

        if ( $package_exists > 0 ) {
            return response()->json(['status' => false, 'data' => __('lang.package_exists')]);
        }

        ProductPackage::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'duration' => $duration,
            'time' => $time,
            'duration_days' => $request->days,
            'type_price' => $type_price,
            'support_type' => $support_type,
            'support_price' => $request->remotely_price,
            'prime_type' => $prime_type,
            'prime_price' => $request->prim_price,
            'status' => 1,
            'product_id' => $product->id,

        ]);

        $admin = Setting::where('id', 1)->first();
        $package = ProductPackage::latest('id')->first();

        $admin->notify(new NewPackageToAdminNotification($admin, $package));

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }

    public function assignPricesToPackage($product, $package, $price, $type)
    {
        $price['product_id'] = $product->id;
        $price['package_id'] = $package->id;
        $price['related_to'] = $type;
        if (isset($price['id'])) {
            $packagePrice =  $package->prices()->find($price['id']);
            $packagePrice->update($price);
            return $packagePrice;
        }
        return ProductPackagePrice::create($price);
    }
    /**
     * toggle status of package ( active or inactive)
     *
     * @param Products $product
     *
     * @return JsonResponse
     *
     */
    public function triggerStatus(Products $product): JsonResponse
    {
        $package = $product->packages()->findOrFail(request()->input('id'));

        $package->update([
            'status' => !$package->status
        ]);

        return response()->json(['status' => true, 'data' => __('lang.success'), 'package' => $package]);
    }

    /**
     * destroy specific package from database
     *
     * @param Products $product
     * @param ProductPackage $package
     *
     * @return JsonResponse
     *
     */
    public function destroy(Products $product, ProductPackage $package): JsonResponse
    {
        $package->delete();

        return response()->json(['status' => true, 'data' => __('lang.success')]);
    }


    public function edit(Products $product, ProductPackage $package)
    {
        return view('admin.products.packages.edit')
            ->with('product',  $product)
            ->with('package', $package);
    }

    //    public function update(Products $product, ProductPackage $package, StoreProductPackageRequest $request)
    //    {
    //        $data = $request->validated();
    //        $data['remotly_support_type'] = isset($data['remotly_support_type']);
    //        $data['prime_support_type'] = isset($data['prime_support_type']);
    //        if (!$data['remotly_support_type'] and !$data['prime_support_type']) {
    //            return response()->json(['status' => false, 'data' => __('lang.support_type_required')]);
    //        }
    //        $data['product_id'] = $product->id;
    //
    //        try {
    //            DB::beginTransaction();
    //            $package->update($data);
    //            $assignedPackagePrices = [];
    //            if (isset($data['duration_prices'])) {
    //                foreach ($data['duration_prices'] as $durationPrice) {
    //                    $packagePrice = $this->assignPricesToPackage($product, $package, $durationPrice, ProductPackagePrice::PRICES_TYPES[0]['id']);
    //                    array_push($assignedPackagePrices, $packagePrice->id);
    //                }
    //            }
    //            if (isset($data['remotly_support_type_durations'])) {
    //                foreach ($data['remotly_support_type_durations'] as $durationPrice) {
    //                    $packagePrice = $this->assignPricesToPackage($product, $package, $durationPrice, ProductPackagePrice::PRICES_TYPES[1]['id']);
    //                    array_push($assignedPackagePrices, $packagePrice->id);
    //                }
    //            }
    //
    //            if (isset($data['prime_support_type_durations'])) {
    //                foreach ($data['prime_support_type_durations'] as $durationPrice) {
    //                    $packagePrice = $this->assignPricesToPackage($product, $package, $durationPrice, ProductPackagePrice::PRICES_TYPES[2]['id']);
    //                    array_push($assignedPackagePrices, $packagePrice->id);
    //                }
    //            }
    //            ProductPackagePrice::query()->where('package_id', $package->id)->whereNotIn('id', $assignedPackagePrices)->delete();
    //
    //            DB::commit();
    //            $product_id = Products::where('id', $product->id)->first();
    //            $product_id->user->notify(new EditPackageNotification($product_id));
    //        } catch (Exception $exception) {
    //            DB::rollBack();
    //            return response()->json(['status' => false, 'data' => __('lang.error')]);
    //        }
    //
    //        return response()->json(['status' => true, 'data' => __('lang.success')]);
    //    }

    public function update(Products $product, ProductPackage $package, UpdateProductPackageRequest $request)
    {



//        if ( $request->support_type_paid ) {
//            if ( !$request->remotely_price ) {
//                return response()->json(['status' => false, 'data' => ' Remotely Price Required ']);
//            }
//        }

        $duration = $package->duration;
        if ($request->duration_free) {
            $duration = 1;
        } elseif ($request->duration_paid) {
            $duration = $request->duration_paid;
        }

        $days = null;
        $time  = null;

        if ($request->type == 1) {
            $days = $request->new_days;

            if (!$days) {
                $days = $request->days;
            }

            $package->update([
                'duration_days' => $days,
                'time' => null,
            ]);
        } elseif ($request->type == 2) {
            $time = $request->new_time;

            if (!$time) {
                $time = $request->time;
            }
            $package->update([
                'duration_days' => null,
                'time' => $time,
            ]);
        }

        if ($request->duration_paid == 3) {
            $time = 1;
        } else {
            $time = $request->time;
        }

        $support_type = null;
        $remotely_price = null;
        if ($request->support_type_free) {
            $support_type = 1;
            $remotely_price = null;
        } elseif ($request->support_type_paid) {
            $support_type = 2;
            $remotely_price = $request->remotely_price;
        } else {
            $support_type = null;
            $remotely_price = null;
        }

        $prime_support_type = null;

        if ($request->prime_support_type_free) {
            $prime_support_type = 1;
        } else {
            $prime_support_type = 2;
        }

        $prime_type = $package->prime_type;
        if ($request->prime_support_type && !$request->prime_support_type_free && !$request->prime_support_type_paid) {
            $prime_type = null;
        } elseif(!$request->prime_support_type) {
            $prime_type = null;
        } else {
            $prime_type = $prime_support_type;
        }

        $type_price = null;
        if ($request->price) {
            $type_price = $request->price;
        } else {
            $type_price = 0;
        }

        try {
            if ($duration == 1) {
                $package->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'type' => $request->type,
                    'duration' => $duration,
                    'type_price' => 0,
                    'support_type' => $support_type,
                    'support_price' => $remotely_price,
                    'prime_type' => $prime_type,
                    'prime_price' => $request->prim_price,
                    'status' => 1,
                    'product_id' => $product->id,

                ]);
            } else {
                $package->update([
                    'name' => $request->name,
                    'description' => $request->description,
                    'type' => $request->type,
                    'duration' => $duration,
                    'type_price' => $type_price,
                    'support_type' => $support_type,
                    'support_price' => $remotely_price,
                    'prime_type' => $prime_type,
                    'prime_price' => $request->prim_price,
                    'status' => 1,
                    'product_id' => $product->id,

                ]);
            }

            $admin = Setting::where('id', 1)->first();
            $package = ProductPackage::orderBy('id', 'desc')->first();

            $admin->notify( new EditPackageToAdminNotification($admin, $package) );

            return response()->json(['status' => true, 'data' => __('lang.success')]);
        }catch (\Exception $e) {

            return response()->json(['status' => false, 'data' => $e->getMessage()]);
        }

    }
}
