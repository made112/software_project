<?php


namespace App\Http\Controllers\Admin;

use App\Models\License;
use App\Models\ProjectsManager;
use App\Models\User;
use App\Notifications\NewLicenseToManagerNotification;
use App\Notifications\NewLicenseToUserNotification;
use DB;
use Carbon\Carbon;
use App\Models\Clients;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Products;
use App\Models\ClientUser;
use App\Traits\FileUpload;
use App\Models\LicensesUse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Helpers\Helpers;
use App\Models\ClientsProducts;
use App\Models\User_Permission;
use App\Models\ClientUserProduct;
use App\Models\License as MyModel;
use App\Events\UpdateLicensesEvent;
use App\Services\License\HashService;
use App\Listeners\NewLicensesRegistered;
use Spatie\Permission\Models\Permission;
use App\Events\NewLicensesRegisteredEvent;
use App\Notifications\LicensesNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewLicenseNotification;
use App\Http\Controllers\Admin\HashingController;
use App\Http\Requests\Admin\License\EmailRequest;
use App\Notifications\LicensesHashServiceNotification;
use App\Http\Requests\Admin\License\StoreLicenseRequest;
use App\Notifications\NewLicensesRegisteredNotification;
use App\Http\Requests\Admin\License\UpdateLicenseRequest;
use App\Models\ProductPackage;
use App\Models\ProductPackagePrice;
use Freshdesk\Resources\Product;
use Illuminate\Validation\ValidationException;
use Spatie\Crypto\Rsa\PublicKey;


class LicenseController extends AdminController
{

    protected $model;
    protected $hashService;
    use FileUpload;

    public function __construct(MyModel $model, HashService $hashService)
    {
        $this->model = $model;
        $this->hashService = $hashService;
    }

    //////////////////////////////////////////////
    public function index(Request $request)
    {
        $licenses = $this->model->filter($request->all());
        if ($request->from) {
            $licenses = $licenses->where('created_at', '>=', $request->from);
        }
        if ($request->to) {
            $licenses = $licenses->where('created_at', '<=', $request->to);
        }
        if ($request->status == 1 or strVal($request->status) == "0") {
            $licenses = $licenses->where('usage', $request->status)->where('date', '>', date('Y-m-d'));
        } elseif ($request->status == 2) {
            $licenses = $licenses->where('date', '<=', date('Y-m-d'));
        }

        $licenses = $licenses->with(['client', 'product'])->select('id', 'client_id', 'date', 'license_code', 'type', 'updated_at', 'parallel_use_limit', 'usage', 'product_id', 'use_limit as use_limit_lin', 'block', 'block as status_name', 'uses_left')->orderBy('id', 'desc')->paginate(10);
        $data['licenses'] = $licenses;
        if ($request->ajax()) {
            return view('admin.licenses.table-data', compact('data'))->render();
        }
        return view('admin.licenses.index', compact('data'));
    }

    public function create(Request $request)
    {
        $setting = Setting::first();
        $product_id = Str::random(7);
        $license_code = Helpers::GenerateLicenses($setting->license_code); //
        $payment_type = array('1' => 'Cash', '2' => 'Bank Transfer', '3' => 'Online Payment');

        $clients = Clients::all();
        return view('admin.licenses.create', compact(['license_code', 'payment_type', 'clients']));
    }

    public function edit(Request $request, $id)
    {
        $licenses = MyModel::with(['client', 'product'])->where('id', $id)->first();

        if (!$licenses) {
            abort(404);
        }
        $payment_type = array('1' => 'Cash', '2' => 'Bank Transfer', '3' => 'Online Payment');
        return view('admin.licenses.edit', compact(['licenses', 'id', 'payment_type']));
    }

    public function add(StoreLicenseRequest $request)
    {
        if ($request->date) {
            $request->date = date('Y-m-d', strtotime($request->date));
        }

        $validated = $request->validated();
        $uuid = (string) \Str::uuid();

        $validated['user_id'] = \Auth::user()->id;
        $validated['uuid'] = $uuid;


        DB::beginTransaction();
        try {

            $clients_products = ClientsProducts::where('product_id', $request->product_id)->where('client_id', $request->client_id)->first();
            if (!$clients_products) {
                $clients_products = new ClientsProducts();
                $clients_products->client_id = $request->client_id;
                $clients_products->product_id = $request->product_id;
                $clients_products->user_id = \Auth::user()->id;
                $clients_products->save();
            }

            if ($request->file and $request->type == 2) {
                $product = Products::find($request->product_id);

                $validated['file'] = $this->uploadFile($request->file);
                $data['product_id'] = $product->product_id;
                $data['client_id'] = $request->client_id;
                $data['date'] = $request->date;
                $data['license_code'] = $request->license_code;
                $data['days'] = $request->days;
                $data['end_days'] = 0;
                $data['startDate'] = date('Y-m-d');
                $data['endDate'] = $request->date;

                // $unhash = $this->hashService->decryption(file_get_contents(public_path('uploads/') . $validated['file']), 1);

                $fileData = json_decode(Helpers::remove_utf8_bom(file_get_contents(public_path('uploads/') . $validated['file'])), true);
                if (!isset($fileDate['encrypted_data']) && !isset($fileData['public_key'])) {
                    return response()->json(['status' => false, 'data' => trans('invalud uploaded file'), 'file' =>  $fileData]);
                }
                $unhash = $this->hashService->SSLDecrypt($fileData['encrypted_data'], $fileData['public_key']);

                $unhash['public_key'] = $fileData['public_key'];

                if (isset($unhash['ip'])) {
                    $data['ip'] = $unhash['ip'];
                    $validated['ip'] = $unhash['ip'];
                }
                //                if (isset($unhash['macaddress'])) {
                //                    $data['macaddress'] = $unhash['macaddress'];
                //                    $validated['machine_id'] = $unhash['macaddress'];
                //                }

                if (isset($unhash['datetime'])) {
                    $data['generated_file_date'] = $unhash['datetime'];
                    $validated['generated_file_date'] = $unhash['datetime'];
                }

                if (isset($unhash['uuid'])) {
                    // $uuidSerial = explode('_', $unhash['uuid']);
                    // if (!$uuidSerial[0]) {
                    //     return response()->json([
                    //         'status' => false,
                    //         'data' => __('validation.wrong_file_content')
                    //     ]);
                    // }
                    $validated['uuid'] = $unhash['uuid'];
                } else {
                    return response()->json([
                        'status' => false,
                        'data' => __('validation.wrong_file_content')
                    ]);
                }

                if (isset($unhash['macaddress'])) {
                    $data['macaddress'] = $unhash['macaddress'];
                    $validated['macaddress'] = $unhash['macaddress'];
                }

                if (isset($unhash['public_key'])) {
                    // $data['public_key'] = $unhash['public_key'];
                    $validated['public_key'] = $unhash['public_key'];
                } else {
                    return response()->json([
                        'status' => false,
                        'data' => __('validation.wrong_file_content')
                    ]);
                    // throw new ValidationException(__('validation.required', ['attribute' => 'public_key']), 1);
                }


                // dd($unhash , $data , $validated);


                if (isset($unhash['client_id'])) {
                    $data['client_id'] = $unhash['client_id'];
                }

                $data['uuid'] = $unhash['uuid'];


                $validated['hash_code'] = $this->hashService->encryption($data, 2, array()); // $api->encryption($validated['file']);

            }
            $saved =  MyModel::create($validated);
            if (!$saved) {
                return response()->json(['status' => false, 'data' => trans('lang.error')]);
            }


            DB::commit();

            /* Comment Here
             * Send Notification To
             * 1- Client_id
             * 2- First Col In Settings Table
             * 3- Project-managers For This Company
             * 4- Users Whose Manage The Product
             */

            $client = Clients::find($request->client_id);
            $setting = Setting::where('id', 1)->first();
            $product = Products::find($request->product_id);
            $license = License::orderBy('id', 'desc')->first();
            event(new NewLicensesRegisteredEvent($client, $setting, $product, $license));


            if ($request->file and $request->type == 2) {
                $client = Clients::find($request->client_id);
                $product = Products::find($request->product_id);
                $data['license_code']  = $validated['license_code'];
                $data['date']  = $validated['date'];
                $data['ip']  = $validated['ip'];
                $data['hash_code']  = $validated['hash_code'];
                $data['product_id']  = $product['product_id'];
                $client->notify(new LicensesHashServiceNotification($data));
            }
            return response()->json(['status' => true, 'data' => trans('lang.success')]);
        } catch (\Exception $e) {
            DB::rollback();
        }
        return $e;
        return response()->json(['status' => false, 'data' => trans('lang.error'), 'error' => [$e->getMessage()]]);
    }

    public function update(UpdateLicenseRequest $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        if ($request->date) {
            $request->date = date('Y-m-d', strtotime($request->date));
        }
        $validated = $request->validated();
        if ($request->file and $request->type == 2) {
            $validated['file'] = $this->uploadFile($request->file);
            $product = Products::find($request->product_id);

            $data['product_id'] = $product->product_id;
            // $data['client_id'] = $request->client_id;
            $data['date'] = $request->date;
            $data['license_code'] = $request->license_code;
            $data['days'] = $request->days;
            $data['end_days'] = 0;
            $data['startDate'] = date('Y-m-d');
            $data['endDate'] = $request->date;

            $fileData = json_decode(Helpers::remove_utf8_bom(file_get_contents(public_path('uploads/') . $validated['file'])), true);

            $unhash = $this->hashService->SSLDecrypt($fileData['encrypted_data'], $fileData['public_key']);

            $unhash['public_key'] = $fileData['public_key'];

            if (isset($unhash['ip'])) {
                $data['ip'] = $unhash['ip'];
                $validated['ip'] = $unhash['ip'];
            }
            if (isset($unhash['macaddress'])) {
                $data['macaddress'] = $unhash['macaddress'];
                $validated['machine_id'] = $unhash['macaddress'];
            }

            if (isset($unhash['datetime'])) {
                $data['generated_file_date'] = $unhash['datetime'];
                $validated['generated_file_date'] = $unhash['datetime'];
            }

            if (isset($unhash['macaddress'])) {
                $data['macaddress'] = $unhash['macaddress'];
                $validated['macaddress'] = $unhash['macaddress'];
            }

            if (isset($unhash['uuid'])) {
                // $uuidSerial = explode('_', $unhash['uuid']);
                // if (!$uuidSerial[0]) {
                //     return response()->json([
                //         'status' => false,
                //         'data' => __('validation.wrong_file_content')
                //     ]);
                // }
                $validated['uuid'] = $unhash['uuid'];
            } else {
                return response()->json([
                    'status' => false,
                    'data' => __('validation.wrong_file_content')
                ]);
            }


            if (isset($unhash['public_key'])) {
                // $data['public_key'] = $unhash['public_key'];
                $validated['public_key'] = $unhash['public_key'];
            } else {
                return response()->json([
                    'status' => false,
                    'data' => __('validation.wrong_file_content')
                ]);
            }


            $validated['hash_code'] = $this->hashService->encryption($data, 2, array()); //$api->encryption($validated['file']);

            $data['uuid'] = $unhash['uuid'];
            // $contents = file_get_contents(public_path('uploads/').$validated['file']);
            // $contents = json_decode($contents,true);

            if (isset($unhash['client_id'])) {
                $data['client_id'] = $unhash['client_id'];
            }

            $validated['hash_code'] = $this->hashService->encryption($data, 2, array()); //$api->encryption($validated['file']);

            // $contents = file_get_contents(public_path('uploads/').$validated['file']);
            // $contents = json_decode($contents,true);

            $data['uuid'] = $unhash['uuid'];
            // $contents = file_get_contents(public_path('uploads/').$validated['file']);
            // $contents = json_decode($contents,true);


        }


        $clients_products = ClientsProducts::where('product_id', $request->product_id)->where('client_id', $request->client_id)->first();
        if (!$clients_products) {
            $clients_products = new ClientsProducts();
            $clients_products->client_id = $request->client_id;
            $clients_products->product_id = $request->product_id;
            $clients_products->user_id = \Auth::user()->id;
            $clients_products->save();
        }


        $saved =  $obj->update($validated);

        // Send Emails After Update
        event(new UpdateLicensesEvent($obj));

        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        $deleted = $obj->delete();
        if (!$deleted) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function send_mail(EmailRequest $request)
    {
        $id = $request->get('hidden');
        $to = $request->get('to');
        $send_contacts = $request->get('send_contacts');
        $email_subject = $request->get('email_subject');
        $id = $request->get('hidden');
        $message = $request->get('message');
        $validated = $request->validated();
        \Notification::route('mail', $to)->notify(new LicensesNotification($validated));

        if ($send_contacts) {
            $obj = MyModel::where('id', $id)->first();
            $client_users = ClientUser::whereIn('id', ClientUserProduct::where('product_id', $obj->product_id)->pluck('client_user_id')->ToArray())->where('client_id', $obj->client_id)->get();
            if ($client_users) {
                foreach ($client_users as $cl) {
                    \Notification::route('mail', $cl->email)->notify(new LicensesNotification($validated));
                }
            }
        }

        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function update_status(Request $request)
    {
        $id = $request->get('id');
        $obj = MyModel::where('id', $id)->first();
        if (!$obj) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        if ($obj->block == MyModel::BLOCK) {
            $saved = $obj->update(['block' => MyModel::UNBLOCK]);
        } else {
            $saved = $obj->update(['block' => MyModel::BLOCK]);
        }
        if (!$saved) {
            return response()->json(['status' => false, 'data' => trans('lang.error')]);
        }
        return response()->json(['status' => true, 'data' => trans('lang.success')]);
    }

    public function download(Request $request, $id)
    {
        $obj = MyModel::where('id', $id)->where('type', 2)->first();
        if (!$obj) {
            abort(404);
        }

        $content = $this->hashService->decryption($obj->hash_code, 1);
        $content['last_check_date'] = now();

        $content = json_encode($content);

        $content = $this->hashService->SSLEncrypt($content);

        $fileName = \Str::random(8) . ".txt";

        $headers = [
            'Content-type' => 'text/plain',
            'Content-Disposition' => sprintf('attachment; filename="%s"', $fileName)
            // 'Content-Length' => sizeof($content)
        ];

        return \Response::make($content, 200, $headers);
    }

    public function ipDetails(Request $request)
    {
        $id = $request->get('id');
        $licenses_use = LicensesUse::where('license_id', $id)->get();
        return response()->json(['status' => true, 'data' => $licenses_use]);
    }

    public function decryption()
    {
        // $this->hashService->encryption($validated['file'],1);
    }

    public function getPackage(Request $request)
    {
        if ($request->duration == 1) {
            // Days -> Duration = 1, time Is Null , Duration Days hava a value
            $packages = ProductPackage::query()
                ->where('product_id', $request->id)
                ->where('type', $request->type)
                ->where('duration', $request->duration)
                ->get();
        } elseif ($request->duration == 2 || $request->duration == 3) {
            $packages = ProductPackage::query()
                ->where('product_id', $request->id)
                ->where('type', $request->type)
                ->where('duration', $request->duration)
                ->get();
        }

        return response()->json([
            'packages' => $packages,
        ]);
    }

    public function getDuration(Request $request)
    {
        $free_duration = ProductPackage::query()
            ->where('id', $request->package_id)
            ->where('product_id', $request->product_id)
            ->whereNotNull('duration_days')
            ->whereNull('time')
            ->first();

        $paid_duration = ProductPackage::query()
            ->where('id', $request->package_id)
            ->where('product_id', $request->product_id)
            ->whereNotNull('time')
            ->whereNull('duration_days')
            ->first();

        $price = ProductPackage::query()
            ->where('id', $request->package_id)
            ->where('product_id', $request->product_id)
            ->first();

        // Days
        if ($free_duration) {

            $first_price = ProductPackage::query()
                ->where('product_id', $request->product_id)
                ->where('id', $request->package_id)
                ->first();

            // Duration
            $date = Carbon::today();
            if ($free_duration->duration == 1) {
                $date->addDays($free_duration->duration_days);
            } elseif ($free_duration->duration == 2) {
                $date->addMonths($free_duration->time);
            } elseif ($free_duration->duration == 3) {
                $date->addYear($free_duration->time);
            }

            $newDate = $date->format('Y-m-d');

            return response()->json([
                'duration' => $free_duration,
                'first_price' => $first_price,
                'date' => $date,
                'to' => $newDate,
                'price' => $price,
            ]);

            // Months & Anual
        } elseif ($paid_duration) {
            $first_price = ProductPackage::query()
                ->where('product_id', $request->product_id)
                ->where('id', $request->package_id)
                ->first();

            $date = Carbon::today();
            if ($paid_duration->duration == 1) {
                $date->addDays($paid_duration->duration_days);
            } elseif ($paid_duration->duration == 2) {
                $date->addMonths($paid_duration->time);
            } elseif ($paid_duration->duration == 3) {
                $date->addYear($paid_duration->time);
            }

            $newDate = $date->format('Y-m-d');

            return response()->json([
                'duration' => $paid_duration,
                'first_price' => $first_price,
                'date' => $date,
                'to' => $newDate,
                'price' => $price,
            ]);
        }
    }

    public function getPrice(Request $request)
    {
        $first_price = ProductPackage::query()
            ->where('product_id', $request->product_id)
            ->where('id', $request->package_id)
            ->first();

        $date = Carbon::today();
        if ($first_price->duration == 1) {
            $date->addDays($first_price->duration_days);
        } elseif ($first_price->duration == 2) {
            $date->addMonths($first_price->time);
        } elseif ($first_price->duration == 3) {
            $date->addYear($first_price->time);
        }

        $newDate = $date->format('Y-m-d');
        return response()->json([
            'first_price' => $first_price,
            'date' => $date,
            'to' => $newDate,
        ]);
    }

    public function getTotalPrice(Request $request)
    {
        $second_price = null;
        if ($request->type == 2) {
            $second_price = ProductPackage::query()
                ->where('product_id', $request->product_id)
                ->where('id', $request->package_id)
                ->first();
        } elseif ($request->type == 3) {
            $second_price = ProductPackage::query()
                ->where('product_id', $request->product_id)
                ->where('id', $request->package_id)
                ->first();
        }

        return response()->json([
            'second_price' => $second_price,
            'type' => $request->type,
        ]);
    }
}
