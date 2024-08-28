{{-- <style>--}}
{{--	.grid-item-lg{--}}
{{--		flex: 0 0 66.66666667% !important;--}}
{{--		max-width: 66.66666667% !important;--}}
{{--		width: 100%;--}}
{{--	}--}}

{{--	.statistics-box-info {--}}
{{--		height: 600px;--}}
{{--		overflow-y: scroll;--}}
{{--		scrollbar-color:  #e9ecef transparent;--}}
{{--		scrollbar-width: thin;--}}
{{--	}--}}
{{--	.statistics-box-info::-webkit-scrollbar {--}}
{{--		width: 0;--}}
{{--	}--}}
{{--	.statistics-box-info::-webkit-scrollbar-track {--}}
{{--		background: transparent;--}}
{{--	}--}}
{{--	.statistics-box-info::-webkit-scrollbar-thumb {--}}
{{--		background: #e9ecef;--}}
{{--	}--}}

{{--	.circle-chart{--}}
{{--		min-width: 140px;--}}
{{--	}--}}
{{--	@media (max-width: 1200px){--}}
{{--		.grid-item-lg {--}}
{{--			flex: 0 0 100% !important;--}}
{{--			max-width: 100% !important;--}}
{{--			width: 100%;--}}
{{--		}--}}
{{--	}--}}
{{--</style>--}}
{{--<div class="profile-section">--}}
{{--    <div class="row grid">--}}
{{--        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">--}}
{{--            <div class="statistics-box flex-column">--}}
{{--                <div class="data">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="title">{{ __('lang.products') }}</h2>--}}
{{--                        <h3 class="number">--}}
{{--                            <span class="count">{{ $client->products->count() }}</span>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="chart-box">--}}
{{--                        <canvas id="chart-user-1" width="120" height="70"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                @php--}}
{{--                    $count_products = $client->products->count();--}}
{{--                    if($count_products == 0){--}}
{{--                        $count_products = 1;--}}
{{--                    }--}}
{{--                @endphp--}}
{{--                <div class="progress-data">--}}
{{--                    <p class="info">--}}
{{--                        ({{ $client->products->where('status', 1)->count() . ' ' . __('lang.active') }})</p>--}}
{{--                    <div class="progress w-100">--}}
{{--                        <div class="progress-bar" role="progressbar" style="width: {{($client->products->where('status', true)->count()/$count_products)*100}}%;"--}}
{{--                            aria-valuenow="{{($client->products->where('status', 1)->count()/$count_products)*100}}"--}}
{{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="statistics-box-info d-none">--}}
{{--                <div class="close-statistics-box"> &times;</div>--}}
{{--                <div class="head">--}}
{{--                    <h2 class="title">{{ __('lang.products') }}</h2>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="table-responsive table-content">--}}
{{--                        <table class="table">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>{{ __('lang.product_name') }}</th>--}}
{{--                                    <th>{{ __('lang.support') }}</th>--}}
{{--                                    <th>{{ __('lang.status') }}</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                                @if (count($client->products))--}}
{{--                                    @foreach ($client->products as $product)--}}
{{--                                        @php--}}
{{--                                            if ($product->status == 1) {--}}
{{--                                                $class = 'btn btn-success text-white m-btn m-btn--icon m-btn--pill';--}}
{{--                                                $icon = 'check';--}}
{{--                                                $text = trans('lang.active');--}}
{{--                                            } else {--}}
{{--                                                $class = 'btn btn-danger text-white m-btn m-btn--icon m-btn--pill';--}}
{{--                                                $icon = 'check';--}}
{{--                                                $text = trans('lang.inactive');--}}
{{--                                            }--}}
{{--                                        @endphp--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ object_get($product, 'name', '-') }}</td>--}}
{{--                                            <td>--}}
{{--                                                @foreach ($product->supportUsers->where('client_id', $client->id) as $user)--}}
{{--                                                    {{ $user->name . ' , ' }}--}}
{{--                                                @endforeach--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <a data-id="{{ $product->id }}" class="{{ $class }} py-1">--}}
{{--                                                    <span>{{ $text }}</span>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                --}}{{-- <div class="chart-body bg-light">--}}
{{--                    <div class="statistics-chart-box">--}}
{{--                        <div class="form-box d-sm-flex mb-4">--}}
{{--                            <h2 class="title">Online / Offline History</h2> --}}
{{--                            --}}{{-- <div class="select-box d-flex">--}}
{{--                                <select name="" class="form-select" id="">--}}
{{--                                    <option value="" disabled="" selected="">All Products </option>--}}
{{--                                </select>--}}
{{--                                <select name="" class="form-select ms-2" id="">--}}
{{--                                    <option value="" disabled="" selected=""> Last 6 month </option>--}}
{{--                                </select>--}}
{{--                            </div> --}}
{{--                        --}}{{-- </div>--}}
{{--                        <canvas id="chart-user-1-1" height="100"></canvas>--}}
{{--                    </div>--}}
{{--                    <div class="statistics-chart-info d-sm-flex gap-3 mt-4">--}}
{{--                        <div class="chart-info-box">--}}
{{--                            <span class="dot" style="background-color: #70D274"></span>--}}
{{--                            <span class="ms-2">Online</span>--}}
{{--                        </div>--}}
{{--                        <div class="chart-info-box">--}}
{{--                            <span class="dot" style="background-color:  #EC6666"></span>--}}
{{--                            <span class="ms-2">Offline</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div> --}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">--}}
{{--            <div class="statistics-box flex-column">--}}
{{--                <div class="data">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="title">{{ __('lang.licenses') }}</h2>--}}
{{--                        <h3 class="number">--}}
{{--                            <span class="count">{{ $licensesCount = $client->licenses->count() }}</span>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="chart-box">--}}
{{--                        <canvas id="chart-user-2" width="120" height="70"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="progress-data">--}}
{{--                    <p class="info">--}}

{{--                        ({{ $client->licenses->where('usage', 1)->where('date','>',date('Y-m-d'))->count() . ' ' . __('lang.active') }})</p>--}}
{{--                    <div class="progress w-100">--}}
{{--                        @php--}}
{{--                            $licensesCount = $licensesCount > 1 ? $licensesCount :  1;--}}
{{--                        @endphp--}}
{{--                        <div class="progress-bar" role="progressbar"--}}
{{--                            style="width: {{ ($client->licenses->where('usage', 1)->where('date','>',date('Y-m-d'))->count() / $licensesCount) * 100 }}%;"--}}
{{--                            aria-valuenow="{{ ($client->licenses->where('usage', 1)->where('date','>',date('Y-m-d'))->count() / $licensesCount) * 100 }}"--}}
{{--                            aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="statistics-box-info d-none">--}}
{{--                <div class="close-statistics-box"> &times;</div>--}}
{{--                <div class="head">--}}
{{--                    <h2 class="title">{{ __('lang.licenses') }}</h2>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="table-responsive table-content">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>{{ __('lang.license_code') }}</th>--}}
{{--                                    <th>{{ __('lang.product_name') }}</th>--}}
{{--                                    <th>{{ __('lang.date') }}</th>--}}
{{--                                    <th>{{ __('lang.status') }}</th>--}}
{{--                                </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                                @if (count($client->licenses))--}}
{{--                                    @foreach ($client->licenses as $license)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $license->license_code }}</td>--}}
{{--                                            <td>{{ object_get($license, 'product.name') }}</td>--}}
{{--                                            <td>{{ $license->date }}</td>--}}
{{--                                            <td>--}}
{{--                                                <span--}}
{{--                                                    class="btn btn-sm py-1  m-btn m-btn--icon m-btn--pill {{ $license->license_status['color'] }}">--}}
{{--                                                    {{ $license->license_status['status'] }}--}}
{{--                                                </span>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="chart-body bg-light">--}}
{{--                    <div class="statistics-chart-box">--}}
{{--                        <div class="form-box d-sm-flex mb-4">--}}
{{--                            <h2 class="title">Daily Active Users</h2>--}}

{{--                        </div>--}}
{{--                        <canvas id="chart-user-2-1" height="100"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">--}}
{{--            <div class="statistics-box flex-column">--}}
{{--                <div class="data">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="title">{{ __('lang.activations') }}</h2>--}}
{{--                        <h3 class="number">--}}
{{--                            <span--}}
{{--                                class="count">{{ $totalActivationsCount = $client->activations()->count() }}</span>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="chart-box">--}}
{{--                        <canvas id="chart-user-3" width="120" height="70"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="progress-data">--}}
{{--                    <p class="info">--}}
{{--                        ({{ $activationsCount = $client->activations()->where('status',1)->where('function', App\Models\ApiCall::ActivateLicense)->count() }}--}}
{{--                        {{ __('lang.active') }})</p>--}}
{{--                    @php--}}
{{--                        $totalActivationsCount = $totalActivationsCount ? $totalActivationsCount : 1;--}}
{{--                    @endphp--}}
{{--                    <div class="progress w-100">--}}
{{--                        <div class="progress-bar" role="progressbar"--}}
{{--                            style="width: {{ ($activationsCount / $totalActivationsCount) * 100 }}%;"--}}
{{--                            aria-valuenow="{{ ($activationsCount / $totalActivationsCount) * 100 }}" aria-valuemin="0"--}}
{{--                            aria-valuemax="100"></div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="statistics-box-info d-none">--}}
{{--                <div class="close-statistics-box"> &times;</div>--}}
{{--                <div class="head">--}}
{{--                    <h2 class="title">{{ __('lang.activations') }}</h2>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="table-responsive table-content">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th>{{ __('lang.license_code') }}</th>--}}
{{--                                <th>{{ __('lang.product_name') }}</th>--}}
{{--                                <th>{{ __('lang.status') }}</th>--}}
{{--                            </tr>--}}
{{--                            --}}{{-- @if (count($client->licenses)) --}}
{{--                                    @foreach (App\Models\ApiCall::activations()->where('client_id',$client->id)->take(10)->get() as $item)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ object_get($item , 'license_code' , '-') }}</td>--}}
{{--                                            <td>{{ object_get($item , 'product.name' , '-') }}</td>--}}
{{--                                            <td>--}}
{{--                                                @if(isset($item) and $item)--}}
{{--                                                <span class="btn m-btn m-btn--icon m-btn--pill py-1 {{ $item->status ? "btn-success" : "btn-danger" }}">--}}
{{--                                                    @if($item->function == 3)--}}
{{--                                                    Activate--}}
{{--                                                    @elseif($item->function == 4)--}}
{{--                                                    Deactivate--}}
{{--                                                    @endif--}}
{{--                                                </span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                --}}{{-- @endif --}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="chart-body bg-light">--}}
{{--                    <div class="statistics-chart-box">--}}
{{--                        <div class="form-box d-sm-flex mb-4">--}}
{{--                            <h2 class="title">Daily Active Users</h2>--}}
{{--                            <div class="select-box d-flex">--}}
{{--                                <select name="assessments_duration" class="form-select" id="assessments_duration">--}}
{{--                                    <option value="day" selected>last 24h  </option>--}}
{{--                                    <option value="week"> last week </option>--}}
{{--                                    <option value="month">'last month </option>--}}
{{--                                    <option value="months">last 6 months </option>--}}
{{--                                    <option value="year" selected>last year </option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <canvas id="chart-user-3-1" height="100"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">--}}
{{--            <div class="statistics-box flex-column">--}}
{{--                <div class="data">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="title">Downloads</h2>--}}
{{--                        <h3 class="number">--}}
{{--                            <span class="count">{{$data['update_download_all']}}</span>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="chart-box">--}}
{{--                        <canvas id="chart-user-4" width="120" height="70"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="content w-100 text-start">--}}
{{--                    <strong class="info">--}}
{{--                        @if($data['update_download_weekly'] < 0)--}}
{{--                        <span class="down"><i class="bi bi-arrow-down"></i>--}}
{{--                        @else--}}
{{--                        <span class="up"><i class="bi bi-arrow-up"></i>--}}
{{--                        @endif--}}
{{--                            {{round($data['update_download_weekly'],2)}}%</span> From last week</strong>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="statistics-box-info d-none">--}}
{{--                <div class="close-statistics-box"> &times;</div>--}}
{{--                <div class="head">--}}
{{--                    <h2 class="title">Downloads</h2>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="statistics-chart-box">--}}
{{--						<div class="d-md-flex justify-content-center align-items-center">--}}
{{--							<div class="circle-chart mx-0">--}}
{{--								<div class="chart-title">--}}
{{--									<h2 class="title mb-3"> Daily Average</h2>--}}
{{--									<h3 class="number text-success">--}}
{{--										@if($data['update_download_pct_today'] > 0)--}}
{{--										<i class="bi bi-arrow-up"></i>--}}
{{--										@else--}}
{{--										<i class="bi bi-arrow-down"></i>--}}
{{--										@endif--}}
{{--										<span class="count">{{round($data['update_download_pct_today'],2)}}%</span>--}}
{{--									</h3>--}}
{{--								</div>--}}
{{--								<canvas id="chart-user-4-1" width="80" height="80"></canvas>--}}
{{--							</div>--}}
{{--							<div class="statistics-chart-info mx-0 ml-4">--}}
{{--								<table class="table table-borderless table-sm chart-info-box">--}}
{{--									<tr>--}}
{{--										<td>--}}
{{--											<span class="dot" style="background-color: #147AD6"></span>--}}
{{--											<span class="ms-3">Total Downloads</span>--}}
{{--										</td>--}}
{{--										<td>--}}
{{--											<div class="h5"><strong>{{$data['update_download_all']}}</strong></div>--}}
{{--										</td>--}}
{{--									</tr>--}}
{{--									<tr>--}}
{{--										<td>--}}
{{--											<span class="dot" style="background-color: #EC6666;"></span>--}}
{{--											<span class="ms-3">Today Downloads</span>--}}
{{--										</td>--}}
{{--										<td>--}}
{{--											<div class="h5"><strong>{{$data['update_download_today']}}</strong></div>--}}
{{--										</td>--}}
{{--									</tr>--}}
{{--								</table>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--					</div>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="table-responsive table-content">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th>Version</th>--}}
{{--                                <th>Product Name</th>--}}
{{--                                <th>Data</th>--}}
{{--                                <th>Status</th>--}}
{{--                            </tr>--}}
{{--                            @if($data['update_download'])--}}
{{--                                @foreach($data['update_download'] as $download)--}}

{{--                                <tr>--}}
{{--                                    <td>@if($download->version) {{$download->version->name}} @else - @endif</td>--}}
{{--                                    <td>@if($download->product) {{$download->product->name}} @else - @endif</td>--}}
{{--                                    <td>{{date('d M, Y, H:i A',strtotime($download->created_at))}}</td>--}}
{{--                                    <td>--}}
{{--                                        @if($download->status == 1)--}}
{{--                                        <span class="btn btn-success py-1 m-btn m-btn--icon m-btn--pill  btn-sm">sucess</span>--}}
{{--                                        @else--}}
{{--                                        <span class="btn btn-danger py-1 m-btn m-btn--icon m-btn--pill btn-sm" data-bs-toggle="tooltip"--}}
{{--                                        title="{{$download->validation_error}} - {{$download->errors}}">--}}

{{--                                        <span class="ms-2">--}}
{{--                                            failed <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"--}}
{{--                                                viewBox="0 0 10 10">--}}
{{--                                                <path id="Icon_awesome-question-circle"--}}
{{--                                                    data-name="Icon awesome-question-circle"--}}
{{--                                                    d="M10.563,5.563a5,5,0,1,1-5-5A5,5,0,0,1,10.563,5.563ZM5.7,2.216A2.611,2.611,0,0,0,3.347,3.5a.242.242,0,0,0,.055.328l.7.53a.242.242,0,0,0,.336-.043c.36-.457.607-.722,1.155-.722.412,0,.921.265.921.664,0,.3-.249.457-.656.685-.474.266-1.1.6-1.1,1.425V6.45A.242.242,0,0,0,5,6.692H6.127a.242.242,0,0,0,.242-.242V6.423c0-.574,1.677-.6,1.677-2.151A2.3,2.3,0,0,0,5.7,2.216Zm-.134,5a.927.927,0,1,0,.927.927A.928.928,0,0,0,5.563,7.216Z"--}}
{{--                                                    transform="translate(-0.563 -0.563)" fill="#fff" />--}}
{{--                                            </svg>--}}
{{--                                        </span>--}}
{{--                                    </span>--}}
{{--                                        @endif--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                                @endforeach--}}
{{--                            @endif--}}

{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">--}}
{{--            <div class="statistics-box flex-column">--}}
{{--                <div class="data">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="title">API Calls</h2>--}}
{{--                        <h3 class="number">--}}
{{--                            <span class="count">{{$data['api_call']}}</span>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="chart-box">--}}
{{--                        <canvas id="chart-user-5" width="120" height="70"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="content w-100 text-start">--}}
{{--                    <strong class="info">--}}
{{--                        @if($data['api_call_weekly_pct'] < 0)--}}
{{--                        <span class="down">--}}
{{--                            <i class="bi bi-arrow-down"></i>--}}
{{--                        @else--}}
{{--                        <span class="up">--}}
{{--                            <i class="bi bi-arrow-up"></i>--}}
{{--                        @endif--}}

{{--                            {{round(abs($data['api_call_weekly_pct']),2)}}%</span> From last week</strong>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="statistics-box-info d-none">--}}
{{--                <div class="close-statistics-box"> &times;</div>--}}
{{--                <div class="head">--}}
{{--                    <h2 class="title">API Calls</h2>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}

{{--                    <div class="statistics-chart-box">--}}

{{--						<div class="d-md-flex justify-content-center align-items-center">--}}
{{--							<div class="circle-chart mx-0">--}}
{{--								<div class="chart-title">--}}
{{--									<h2 class="title mb-3"> Daily Average</h2>--}}
{{--									<h3 class="number text-success">--}}
{{--										@if($data['api_call_pct_today'] > 0)--}}
{{--										<i class="bi bi-arrow-up"></i>--}}
{{--										@else--}}
{{--										<i class="bi bi-arrow-down"></i>--}}
{{--										@endif--}}
{{--										<span class="count">{{round($data['api_call_pct_today'],2)}}%</span>--}}
{{--									</h3>--}}
{{--								</div>--}}
{{--								<canvas id="chart-user-5-1" width="80" height="80"></canvas>--}}
{{--							</div>--}}
{{--							<div class="statistics-chart-info mx-0 ml-4">--}}
{{--								<table class="table table-borderless table-sm chart-info-box">--}}
{{--									<tr>--}}
{{--										<td>--}}
{{--											<span class="dot" style="background-color: #147AD6"></span>--}}
{{--											<span class="ms-3">Total API Calls</span>--}}
{{--										</td>--}}
{{--										<td>--}}
{{--											<div class="h5"><strong>{{$data['api_call']}}</strong></div>--}}
{{--										</td>--}}
{{--									</tr>--}}
{{--									<tr>--}}
{{--										<td>--}}
{{--											<span class="dot" style="background-color: #EC6666;"></span>--}}
{{--											<span class="ms-3">Today API Calls</span>--}}
{{--										</td>--}}
{{--										<td>--}}
{{--											<div class="h5"><strong>{{$data['api_call_today']}}</strong></div>--}}
{{--										</td>--}}
{{--									</tr>--}}
{{--								</table>--}}
{{--							</div>--}}
{{--						</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="table-responsive table-content">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th>API</th>--}}
{{--                                <th>Times</th>--}}
{{--                                <th>Status</th>--}}
{{--                            </tr>--}}
{{--                                @if($top_api_call)--}}
{{--                                    @foreach($top_api_call as $api)--}}
{{--                                        @php--}}
{{--                                            if ($api->function == 1) {--}}
{{--                                                $function_name = 'Get Last Version';--}}
{{--                                            } else if ($api->function == 2) {--}}
{{--                                                $function_name = 'Check Availability License';--}}
{{--                                            } else if ($api->function == 3) {--}}
{{--                                                $function_name = 'Activate License';--}}
{{--                                            } else if ($api->function == 4) {--}}
{{--                                                $function_name = 'Deactivate License';--}}
{{--                                            } else if ($api->function == 5) {--}}
{{--                                                $function_name = 'Check Update';--}}
{{--                                            }else if ($api->function == 6) {--}}
{{--                                                $function_name = 'Update Downloads';--}}
{{--                                            }else if ($api->function == 7) {--}}
{{--                                                $function_name = 'View Package';--}}
{{--                                            }else if ($api->function == 8) {--}}
{{--                                                $function_name = 'Sign In';--}}
{{--                                            }else if ($api->function == 9) {--}}
{{--                                                $function_name = 'Sign Out';--}}
{{--                                            }--}}
{{--                                        @endphp--}}
{{--                                        <tr>--}}
{{--                                            <td>{{$function_name}}</td>--}}
{{--                                            <td class="text-end">{{$api->cnt}}</td>--}}
{{--                                            <td>--}}
{{--                                                @if($api->status == 1)--}}
{{--                                                <span class="btn btn-success py-1 btn-sm m-btn m-btn--icon m-btn--pill">Success</span>--}}
{{--                                                @else--}}
{{--                                                <span class="btn btn-danger py-1 btn-sm m-btn m-btn--icon m-btn--pill">Failed</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endif--}}
{{--                            </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">--}}
{{--            <div class="statistics-box flex-column">--}}
{{--                <div class="data">--}}
{{--                    <div class="content">--}}
{{--                        <h2 class="title">{{ __('lang.activity_logs') }}</h2>--}}
{{--                        <h3 class="number">--}}
{{--                            <span class="count">{{ $client->activities->count() }}</span>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div class="chart-box">--}}
{{--                        <canvas id="chart-user-6" width="120" height="70"></canvas>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="content w-100 text-start">--}}
{{--                    <strong class="info"><span class="up"><i class="bi bi-arrow-up"></i>--}}
{{--                            0%</span> From last week</strong>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="statistics-box-info d-none">--}}
{{--                <div class="close-statistics-box"> &times;</div>--}}
{{--                <div class="head">--}}
{{--                    <h2 class="title">{{ __('lang.activity_logs') }}</h2>--}}
{{--                </div>--}}
{{--                <div class="chart-body">--}}
{{--                    <div class="table-head">--}}
{{--                        <h2 class="title">--}}
{{--                            {{ __('lang.activity_logs') }} ({{ __('lang.past_24') }})--}}
{{--                            <span data-bs-toggle="tooltip" title=""--}}
{{--                                data-bs-original-title=" {{ __('lang.activity_logs') }} for company ({{ __('lang.past_24') }})">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">--}}
{{--                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle"--}}
{{--                                        d="M14.563,7.563a7.23,7.23,0,0,1-1.1,3.775,6.868,6.868,0,0,1-5.9,3.225,7,7,0,1,1,7-7ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"--}}
{{--                                        transform="translate(-0.563 -0.563)" fill="#43425d"></path>--}}
{{--                                </svg>--}}
{{--                            </span>--}}
{{--                        </h2>--}}

{{--                    </div>--}}
{{--                    <div class="table-responsive table-content">--}}
{{--                        <table class="table table-bordered">--}}
{{--                            <tr>--}}
{{--                                <th>{{ __('lang.date') }}</th>--}}
{{--                                <th>{{ __('lang.actions') }}</th>--}}
{{--                            </tr>--}}

{{--                            @foreach ($client->activities()->orderBy('id', 'desc')->take(10)->get()--}}
{{--    as $activity)--}}
{{--                                <tr>--}}
{{--                                    <td>{{ $activity->created_at }}</td>--}}
{{--                                    <td>{{ $activity->causer->name . ' ' . $activity->description }}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{-- --}}

<style>
    .grid-item-lg {
        flex: 0 0 66.66666667% !important;
        max-width: 66.66666667% !important;
        width: 100%;
    }

    .statistics-box-info {
        height: 600px;
        overflow-y: scroll;
        scrollbar-color: #e9ecef transparent;
        scrollbar-width: thin;
    }

    .statistics-box-info::-webkit-scrollbar {
        width: 0;
    }

    .statistics-box-info::-webkit-scrollbar-track {
        background: transparent;
    }

    .statistics-box-info::-webkit-scrollbar-thumb {
        background: #e9ecef;
    }

    .circle-chart {
        min-width: 140px;
    }

    @media (max-width: 1200px) {
        .grid-item-lg {
            flex: 0 0 100% !important;
            max-width: 100% !important;
            width: 100%;
        }
    }

    .data-content {
        max-width: 1650px;
    }

    @media (max-width: 1440px) {
        .data-content {
            max-width: 1080px;
        }
    }
</style>
<div class="profile-section data-content">
    <div class="row grid">
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
            <div class="statistics-box flex-column">
                <div class="data">
                    <div class="content">
                        <h2 class="title">{{ __('lang.products') }}</h2>
                        <h3 class="number">
                            <span class="count">{{ $client->products->count() }}</span>
                        </h3>
                    </div>
                    <div class="chart-box">
                        <canvas id="chart-user-1" width="120" height="70"></canvas>
                    </div>
                </div>
                @php
                    $count_products = $client->products->count();
                    if($count_products == 0){
                        $count_products = 1;
                    }
                @endphp
                <div class="progress-data">
                    <p class="info">
                        ({{ $client->products->where('status', 1)->count() . ' ' . __('lang.active') }})</p>
                    <div class="progress w-100">
                        <div class="progress-bar" role="progressbar"
                             style="width: {{($client->products->where('status', true)->count()/$count_products)*100}}%;"
                             aria-valuenow="{{($client->products->where('status', 1)->count()/$count_products)*100}}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">{{ __('lang.products') }}</h2>
                </div>
                <div class="chart-body">
                    <div class="table-responsive table-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>{{ __('lang.product_name') }}</th>
                                <th>{{ __('lang.support') }}</th>
                                <th>{{ __('lang.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($client->products))
                                @foreach ($client->products as $product)
                                    @php
                                        if ($product->status == 1) {
                                            $class = 'btn btn-success text-white m-btn m-btn--icon m-btn--pill';
                                            $icon = 'check';
                                            $text = trans('lang.active');
                                        } else {
                                            $class = 'btn btn-danger text-white m-btn m-btn--icon m-btn--pill';
                                            $icon = 'check';
                                            $text = trans('lang.inactive');
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ object_get($product, 'name', '-') }}</td>
                                        <td>
                                            @foreach ($product->supportUsers->where('client_id', $client->id) as $user)
                                                {{ $user->name . ' , ' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a data-id="{{ $product->id }}" class="{{ $class }} py-1">
                                                <span>{{ $text }}</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>


                {{-- <div class="chart-body bg-light">
                    <div class="statistics-chart-box">
                        <div class="form-box d-sm-flex mb-4">
                            <h2 class="title">Online / Offline History</h2> --}}
                {{-- <div class="select-box d-flex">
                    <select name="" class="form-select" id="">
                        <option value="" disabled="" selected="">All Products </option>
                    </select>
                    <select name="" class="form-select ms-2" id="">
                        <option value="" disabled="" selected=""> Last 6 month </option>
                    </select>
                </div> --}}
                {{-- </div>
                <canvas id="chart-user-1-1" height="100"></canvas>
            </div>
            <div class="statistics-chart-info d-sm-flex gap-3 mt-4">
                <div class="chart-info-box">
                    <span class="dot" style="background-color: #70D274"></span>
                    <span class="ms-2">Online</span>
                </div>
                <div class="chart-info-box">
                    <span class="dot" style="background-color:  #EC6666"></span>
                    <span class="ms-2">Offline</span>
                </div>
            </div>
        </div> --}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
            <div class="statistics-box flex-column">
                <div class="data">
                    <div class="content">
                        <h2 class="title">{{ __('lang.licenses') }}</h2>
                        <h3 class="number">
                            <span class="count">{{ $licensesCount = $client->licenses->count() }}</span>
                        </h3>
                    </div>
                    <div class="chart-box">
                        <canvas id="chart-user-2" width="120" height="70"></canvas>
                    </div>
                </div>
                <div class="progress-data">
                    <p class="info">

                        ({{ $client->licenses->where('usage', 1)->where('date','>',date('Y-m-d'))->count() . ' ' . __('lang.active') }}
                        )</p>
                    <div class="progress w-100">
                        @php
                            $licensesCount = $licensesCount > 1 ? $licensesCount :  1;
                        @endphp
                        <div class="progress-bar" role="progressbar"
                             style="width: {{ ($client->licenses->where('usage', 1)->where('date','>',date('Y-m-d'))->count() / $licensesCount) * 100 }}%;"
                             aria-valuenow="{{ ($client->licenses->where('usage', 1)->where('date','>',date('Y-m-d'))->count() / $licensesCount) * 100 }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">{{ __('lang.licenses') }}</h2>
                </div>
                <div class="chart-body">
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{ __('lang.license_code') }}</th>
                                <th>{{ __('lang.product_name') }}</th>
                                <th>{{ __('lang.date') }}</th>
                                <th>{{ __('lang.status') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (count($client->licenses))
                                @foreach ($client->licenses as $license)
                                    <tr>
                                        <td>{{ $license->license_code }}</td>
                                        <td>{{ object_get($license, 'product.name') }}</td>
                                        <td>{{ $license->date }}</td>
                                        <td>
                                                <span
                                                    class="btn btn-sm py-1  m-btn m-btn--icon m-btn--pill {{ $license->license_status['color'] }}">
                                                    {{ $license->license_status['status'] }}
                                                </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="chart-body bg-light">
                    <div class="statistics-chart-box">
                        <div class="form-box d-sm-flex mb-4">
                            <h2 class="title">Daily Active Users</h2>

                        </div>
                        <canvas id="chart-user-2-1" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
            <div class="statistics-box flex-column">
                <div class="data">
                    <div class="content">
                        <h2 class="title">{{ __('lang.activations') }}</h2>
                        <h3 class="number">
                            <span
                                class="count">{{ $totalActivationsCount = $client->activations()->count() }}</span>
                        </h3>
                    </div>
                    <div class="chart-box">
                        <canvas id="chart-user-3" width="120" height="70"></canvas>
                    </div>
                </div>
                <div class="progress-data">
                    <p class="info">
                        ({{ $activationsCount = $client->activations()->where('status',1)->where('function', App\Models\ApiCall::ActivateLicense)->count() }}
                        {{ __('lang.active') }})</p>
                    @php
                        $totalActivationsCount = $totalActivationsCount ? $totalActivationsCount : 1;
                    @endphp
                    <div class="progress w-100">
                        <div class="progress-bar" role="progressbar"
                             style="width: {{ ($activationsCount / $totalActivationsCount) * 100 }}%;"
                             aria-valuenow="{{ ($activationsCount / $totalActivationsCount) * 100 }}" aria-valuemin="0"
                             aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">{{ __('lang.activations') }}</h2>
                </div>
                <div class="chart-body">
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('lang.license_code') }}</th>
                                <th>{{ __('lang.product_name') }}</th>
                                <th>{{ __('lang.status') }}</th>
                            </tr>
                            {{-- @if (count($client->licenses)) --}}
                            @foreach (App\Models\ApiCall::activations()->where('client_id',$client->id)->take(10)->get() as $item)
                                <tr>
                                    <td>{{ object_get($item , 'license_code' , '-') }}</td>
                                    <td>{{ object_get($item , 'product.name' , '-') }}</td>
                                    <td>
                                        @if(isset($item) and $item)
                                            <span
                                                class="btn m-btn m-btn--icon m-btn--pill py-1 {{ $item->status ? "btn-success" : "btn-danger" }}">
                                                    @if($item->function == 3)
                                                    Activate
                                                @elseif($item->function == 4)
                                                    Deactivate
                                                @endif
                                                </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            {{-- @endif --}}
                        </table>
                    </div>
                </div>
                <div class="chart-body bg-light">
                    <div class="statistics-chart-box">
                        <div class="form-box d-sm-flex mb-4">
                            <h2 class="title">Daily Active Users</h2>
                            <div class="select-box d-flex">
                                <select name="assessments_duration" class="form-select" id="assessments_duration">
                                    <option value="day" selected>last 24h</option>
                                    <option value="week"> last week</option>
                                    <option value="month">'last month</option>
                                    <option value="months">last 6 months</option>
                                    <option value="year" selected>last year</option>
                                </select>
                            </div>
                        </div>
                        <canvas id="chart-user-3-1" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
            <div class="statistics-box flex-column">
                <div class="data">
                    <div class="content">
                        <h2 class="title">Downloads</h2>
                        <h3 class="number">
                            <span class="count">{{$data['update_download_all']}}</span>
                        </h3>
                    </div>
                    <div class="chart-box">
                        <canvas id="chart-user-4" width="120" height="70"></canvas>
                    </div>
                </div>
                <div class="content w-100 text-start">
                    <strong class="info">
                        @if($data['update_download_weekly'] < 0)
                            <span class="down"><i class="bi bi-arrow-down"></i>
                        @else
                                    <span class="up"><i class="bi bi-arrow-up"></i>
                        @endif
                                        {{round($data['update_download_weekly'],2)}}%</span> From last week</strong>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">Downloads</h2>
                </div>
                <div class="chart-body">
                    <div class="statistics-chart-box">
                        <div class="d-md-flex justify-content-center align-items-center">
                            <div class="circle-chart mx-0">
                                <div class="chart-title">
                                    <h2 class="title mb-3"> Daily Average</h2>
                                    <h3 class="number text-success">
                                        @if($data['update_download_pct_today'] > 0)
                                            <i class="bi bi-arrow-up"></i>
                                        @else
                                            <i class="bi bi-arrow-down"></i>
                                        @endif
                                        <span class="count">{{round($data['update_download_pct_today'],2)}}%</span>
                                    </h3>
                                </div>
                                <canvas id="chart-user-4-1" width="80" height="80"></canvas>
                            </div>
                            <div class="statistics-chart-info mx-0 ml-4">
                                <table class="table table-borderless table-sm chart-info-box">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #147AD6"></span>
                                            <span class="ms-3">Total Downloads</span>
                                        </td>
                                        <td>
                                            <div class="h5"><strong>{{$data['update_download_all']}}</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #EC6666;"></span>
                                            <span class="ms-3">Today Downloads</span>
                                        </td>
                                        <td>
                                            <div class="h5"><strong>{{$data['update_download_today']}}</strong></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body">
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>Version</th>
                                <th>Product Name</th>
                                <th>Data</th>
                                <th>Status</th>
                            </tr>
                            @if($data['update_download'])
                                @foreach($data['update_download'] as $download)

                                    <tr>
                                        <td>@if($download->version)
                                                {{$download->version->name}}
                                            @else
                                                -
                                            @endif</td>
                                        <td>@if($download->product)
                                                {{$download->product->name}}
                                            @else
                                                -
                                            @endif</td>
                                        <td>{{date('d M, Y, H:i A',strtotime($download->created_at))}}</td>
                                        <td>
                                            @if($download->status == 1)
                                                <span
                                                    class="btn btn-success py-1 m-btn m-btn--icon m-btn--pill  btn-sm">sucess</span>
                                            @else
                                                <span class="btn btn-danger py-1 m-btn m-btn--icon m-btn--pill btn-sm"
                                                      data-bs-toggle="tooltip"
                                                      title="{{$download->validation_error}} - {{$download->errors}}">

                                        <span class="ms-2">
                                            failed <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10"
                                                        viewBox="0 0 10 10">
                                                <path id="Icon_awesome-question-circle"
                                                      data-name="Icon awesome-question-circle"
                                                      d="M10.563,5.563a5,5,0,1,1-5-5A5,5,0,0,1,10.563,5.563ZM5.7,2.216A2.611,2.611,0,0,0,3.347,3.5a.242.242,0,0,0,.055.328l.7.53a.242.242,0,0,0,.336-.043c.36-.457.607-.722,1.155-.722.412,0,.921.265.921.664,0,.3-.249.457-.656.685-.474.266-1.1.6-1.1,1.425V6.45A.242.242,0,0,0,5,6.692H6.127a.242.242,0,0,0,.242-.242V6.423c0-.574,1.677-.6,1.677-2.151A2.3,2.3,0,0,0,5.7,2.216Zm-.134,5a.927.927,0,1,0,.927.927A.928.928,0,0,0,5.563,7.216Z"
                                                      transform="translate(-0.563 -0.563)" fill="#fff"/>
                                            </svg>
                                        </span>
                                    </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
            <div class="statistics-box flex-column">
                <div class="data">
                    <div class="content">
                        <h2 class="title">API Calls</h2>
                        <h3 class="number">
                            <span class="count">{{$data['api_call']}}</span>
                        </h3>
                    </div>
                    <div class="chart-box">
                        <canvas id="chart-user-5" width="120" height="70"></canvas>
                    </div>
                </div>
                <div class="content w-100 text-start">
                    <strong class="info">
                        @if($data['api_call_weekly_pct'] < 0)
                            <span class="down">
                            <i class="bi bi-arrow-down"></i>
                        @else
                                    <span class="up">
                            <i class="bi bi-arrow-up"></i>
                        @endif

                                        {{round(abs($data['api_call_weekly_pct']),2)}}%</span> From last week</strong>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">API Calls</h2>
                </div>
                <div class="chart-body">

                    <div class="statistics-chart-box">

                        <div class="d-md-flex justify-content-center align-items-center">
                            <div class="circle-chart mx-0">
                                <div class="chart-title">
                                    <h2 class="title mb-3"> Daily Average</h2>
                                    <h3 class="number text-success">
                                        @if($data['api_call_pct_today'] > 0)
                                            <i class="bi bi-arrow-up"></i>
                                        @else
                                            <i class="bi bi-arrow-down"></i>
                                        @endif
                                        <span class="count">{{round($data['api_call_pct_today'],2)}}%</span>
                                    </h3>
                                </div>
                                <canvas id="chart-user-5-1" width="80" height="80"></canvas>
                            </div>
                            <div class="statistics-chart-info mx-0 ml-4">
                                <table class="table table-borderless table-sm chart-info-box">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #147AD6"></span>
                                            <span class="ms-3">Total API Calls</span>
                                        </td>
                                        <td>
                                            <div class="h5"><strong>{{$data['api_call']}}</strong></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: #EC6666;"></span>
                                            <span class="ms-3">Today API Calls</span>
                                        </td>
                                        <td>
                                            <div class="h5"><strong>{{$data['api_call_today']}}</strong></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body">
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>API</th>
                                <th>Times</th>
                                <th>Status</th>
                            </tr>
                            @if($top_api_call)

                                @foreach($top_api_call as $api)
                                    @php
                                        $function_name = '';
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
                                    @endphp

                                    <tr>
                                        <td>{{$function_name}}</td>
                                        <td class="text-end">{{$api->cnt}}</td>
                                        <td>
                                            @if($api->status == 1)
                                                <span class="btn btn-success py-1 btn-sm m-btn m-btn--icon m-btn--pill">Success</span>
                                            @else
                                                <span class="btn btn-danger py-1 btn-sm m-btn m-btn--icon m-btn--pill">Failed</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
            <div class="statistics-box flex-column">
                <div class="data">
                    <div class="content">
                        <h2 class="title">{{ __('lang.activity_logs') }}</h2>
                        <h3 class="number">
                            <span class="count">{{ $client->activities->count() }}</span>
                        </h3>
                    </div>
                    <div class="chart-box">
                        <canvas id="chart-user-6" width="120" height="70"></canvas>
                    </div>
                </div>
                <div class="content w-100 text-start">
                    <strong class="info"><span class="up"><i class="bi bi-arrow-up"></i>
                            0%</span> From last week</strong>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">{{ __('lang.activity_logs') }}</h2>
                </div>
                <div class="chart-body">
                    <div class="table-head">
                        <h2 class="title">
                            {{ __('lang.activity_logs') }} ({{ __('lang.past_24') }})
                            <span data-bs-toggle="tooltip" title=""
                                  data-bs-original-title=" {{ __('lang.activity_logs') }} for company ({{ __('lang.past_24') }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle"
                                          d="M14.563,7.563a7.23,7.23,0,0,1-1.1,3.775,6.868,6.868,0,0,1-5.9,3.225,7,7,0,1,1,7-7ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                          transform="translate(-0.563 -0.563)" fill="#43425d"></path>
                                </svg>
                            </span>
                        </h2>

                    </div>
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('lang.date') }}</th>
                                <th>{{ __('lang.actions') }}</th>
                            </tr>

                            @foreach ($client->activities()->orderBy('id', 'desc')->take(10)->get()
    as $activity)
                                <tr>
                                    <td>{{ $activity->created_at }}</td>
                                    @if($activity->causer)
                                        <td>{{ $activity->causer->name . ' ' . $activity->description }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- --}}

