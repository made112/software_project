    <style>
        .grid-item-lg{
            flex: 0 0 66.66666667% !important;
            max-width: 66.66666667% !important;
            width: 100%;
        }
        @media (max-width: 1200px){
            .grid-item-lg {
                flex: 0 0 100% !important;
                max-width: 100% !important;
                width: 100%;
            }
        }

        .data-content {
            max-width: 1650px;
        }
        @media (max-width: 1440px){
			.data-content {
				max-width: 1080px;
			}
        }

        /*
            2022/08/31
        */

        .statistics-chart-info{
            text-align: initial;
            margin: auto;
        }
        .statistics-chart-info-2 {
            max-width: 240px !important;
        }
        .chart-info-box .dot {
            margin-inline-end: .5rem;
        }
        .statistics-count{
            gap: 1rem;
        }
        .statistics-count .box{
            min-width: 100px;
        }
        .circle-chart{
            min-width: 140px;
        }
    </style>
    <div class="row grid">
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item products-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">{{ __('lang.products') }}</h2>
                    <h3 class="number">
                        <span class="count">{{ $products->count() }}</span>
                    </h3>
                    <p class="info">
                        ({{ $products->where('status', 1)->count() . ' ' . __('lang.active') }})
                    </p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-1" width="140" height=""></canvas>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">
                        <h2 class="title">{{ __('lang.products') }}</h2>
                    </h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">

                                <div class="circle-chart">
                                    <canvas id="chart-1-1"></canvas>
                                    <div class="chart-title">
                                        <h2 class="title"> {{ __('lang.products') }}</h2>
                                        <h3 class="number"> <span
                                                class="count">{{ $products->count() }}</span></h3>
                                    </div>
                                </div>
                            </div>

                            <div class="statistics-chart-info">
                                <table class="table table-sm table-borderless chart-info-box">
                                    <tr>
                                        <td>
                                            <span class="dot bg-pruple"></span>
                                            <span class="mr-3">{{ __('lang.active') }}</span>
                                        </td>
                                        <td>
                                            <span id="activeProductsCount"
                                                data-value="{{ $products->where('status', 1)->count() }}">
                                                {{ $products->where('status', 1)->count() }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot bg-pink"></span>
                                            <span class="mr-3">{{ __('lang.inactive') }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-3" id="inActiveProductsCount"
                                                data-value="{{ $products->where('status', 2)->count() }}">
                                                {{ $products->where('status', 2)->count() }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">
                                <div class="circle-chart">
                                    <canvas id="chart-1-2"></canvas>
                                    <div class="chart-title">
                                        <h2 class="title"> {{ __('lang.products') }}</h2>
                                        <h3 class="number"> <span
                                                class="count">
                                                {{ count($licenses_product) }}
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="statistics-chart-info statistics-chart-info-2 text-start">
                                <h6 class="font-weight-bold text-center">Number of active license products</h6>
                                <table class="table table-borderless table-sm" style="font-size: 14px;">
                                @foreach($licenses_product as $li_prod)
                                @if($li_prod->product)
                                    <tr>
                                        <td >
                                            <span class="dot" @if($li_prod->product) style="color: {{ $li_prod->product->color }};" @endif >
                                                <i class="fa fa-circle" style="font-size: 10px;"></i>
                                            </span>
                                            <span class="mr-3">@if($li_prod->product) {{ $li_prod->product->name }} @endif</span>
                                        </td>
                                        <td >
                                            {{$li_prod->cnt}}
                                        </td>
                                    </tr>
                                    @endif
                                    {{-- <div class="chart-info-box">
                                        <div class="product" data-color="@if($li_prod->product) {{ $li_prod->product->color }} @endif"
                                            data-name="@if($li_prod->product) {{ $li_prod->product->name }} @endif"
                                            data-licenses="{{ $li_prod->cnt }}"></div>
                                        <span class="dot" @if($li_prod->product) style="-color: {{ $li_prod->product->color }}" @endif ></span>
                                        <span class="ms-2">@if($li_prod->product) {{ $li_prod->product->name }} @endif</span>
                                    </div> --}}
                                @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body bg-light">
                    <div class="form-box d-sm-flex mb-4">
                        <h2 class="title">Total Income</h2>
                        <div class="select-box d-flex">
                            <select name="" class="form-control mr-2" id="chart-1-3_product-id">
                                <option value="" selected> All Products </option>
                                @if($products_data)
                                    @foreach($products_data as $pr)
                                        <option value="{{$pr->id}}">{{$pr->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <select name="" class="form-control" id="select-chart-1-3">
                                <option value="1" selected> Last 6 months </option>
                                <option value="2"> Last 12 months </option>
                            </select>
                        </div>
                    </div>

                    <canvas id="chart-1-3" width="400" height="100"></canvas>

                    <div class="statistics-chart-info statistics-total-incomr-info d-sm-flex justify-content-center gap-3 mt-4">
                        @foreach ($income_array as $in_array)
                            @if(isset($in_array['product']))
                            <div class="chart-info-box">
                                <div class="product-chart" data-color="{{ $in_array['borderColor'] }}"
                                    data-name="{{ $in_array['product'] }}"></div>
                                <span class="dot" style="background-color: {{ $in_array['borderColor'] }}"></span>
                                <span class="mr-3">{{ $in_array['product'] }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item clients-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">{{ __('lang.companies') }}</h2>
                    <h3 class="number">
                        <span class="count">{{ $clients->count() }}</span>
                    </h3>
                    <p class="info">({{ $clients->where('status' ,1)->count() . ' ' . __('lang.active')}} )</p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-2" width="140" height=""></canvas>
                </div>
            </div>
            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">
                        <h2 class="title">{{ __('lang.companies') }}</h2>
                    </h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">
                                <div class="circle-chart">
                                    <canvas id="chart-2-1" height="148"></canvas>
                                    <div class="chart-title">
                                        <h2 class="title"> {{ __('lang.companies') }} </h2>
                                        <h3 class="number"> <span class="count">{{ $clients->count() }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="statistics-chart-info">
                                <table class="table table-sm table-borderless chart-info-box">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: rgb(121, 210, 222);"></span>
                                            <span class="mr-3">{{ __('lang.active') }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-3">{{ $clients->where('status' , 1)->count() }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: rgb(121, 210, 222, .3);"></span>
                                            <span class="mr-3">{{ __('lang.inactive') }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-3"> {{ $clients->where('status' , 0)->count() }} </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">
                                <div class="form-box d-sm-flex mb-4">
                                    <h2 class="title" style="font-size:13px">{{ __('lang.active') . ' ' . __('lang.companies') }}</h2>
                                    <div class="select-box">
                                        <select name="" class="form-control" id="select-chart-2-2">
                                            <option value="1" > Last 6 months </option>
                                            <option value="2" selected  > Last 12 months </option>
                                        </select>
                                    </div>
                                </div>


                                    <div class="statistics-count justify-content-enevly">

                                        <div class="box">
                                            <h3 class="title">Daily (avg)</h3>
                                            <h4 class="number"><span class="count"> {{$data['clients_today']}} </span></h4>
                                            <p class="status @if($data['clients_today_pct'] > 0) text-success @else text-danger @endif">
                                                <i class="bi @if($data['clients_today_pct'] > 0) bi-arrow-up @else bi-arrow-down @endif"></i> {{round($data['clients_today_pct'],2)}}%
                                            </p>
                                        </div>

                                        <div class="box">
                                            <h3 class="title">Weekly</h3>
                                            <h4 class="number"><span class="count"> {{$data['clients_weekly']}}  </span></h4>
                                            <p class="status @if($data['clients_week_pct'] > 0) text-success @else text-danger @endif">
                                                <i class="bi @if($data['clients_week_pct'] > 0) bi-arrow-up @else bi-arrow-down @endif"></i> {{round($data['clients_week_pct'],2)}}%
                                            </p>
                                        </div>

                                        <div class="box">
                                                <h3 class="title">Monthly</h3>
                                                <h4 class="number">
                                                    <span class="count"> {{$data['clients_month']}}  </span></h4>
                                                <p class="status @if($data['clients_month_pct'] > 0) text-success @elseif($data['clients_month_pct'] == 0) text-info @else text-danger @endif">
                                                    <i class="bi @if($data['clients_month_pct'] > 0) bi-arrow-up @else bi-arrow-down @endif "></i> {{round($data['clients_month_pct'],2)}}%
                                                </p>
                                            </div>
                                    </div>

                                <canvas id="chart-2-2"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body bg-white">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="user-card">
                                <h2 class="title"> {{ __('lang.top') .' '. __('lang.companies') }} </h2>
                                <div class="user-list">
                                    @foreach (App\Models\Clients::whereHas('licenses')->withCount('licenses')->orderBy('licenses_count',  'desc')->take(10)->get() as $client)
                                        <div class="user-box">
                                            <div class="pic">
                                                <img src="{{ $client->logo }}" alt="">
                                            </div>
                                            <div class="content">
                                                <h3 class="name">{{ object_get($client , 'name') }}</h3>
                                                <p class="info">
                                                    @if (!is_null($client->products))
                                                        @foreach ($client->products as $product)
                                                            {{ $product->name }} ,
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="user-card">
                                <h2 class="title"> Online Companies </h2>
                                <div class="user-list">
                                    @foreach( $online_clients as $client )
                                        <div class="user-box">
                                            <div class="pic">
                                                <span class="status online"></span>
                                                <img src="{{ $client->logo }}" alt="">
                                            </div>
                                            <div class="content">
                                                <h3 class="name">
                                                    {{ $client->name }}
                                                </h3>
                                                <p class="info">
                                                    @php
                                                        $i = 0;
                                                    @endphp
                                                    @foreach($client->products as $product)
                                                        {{ $product->name }}
                                                        @if( $i == 0 )
                                                            @break
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                            <div class="user-status">
                                                @php
                                                    $current_time = \Carbon\Carbon::now()->format('Y-m-d');

                                                    $last_seen = \Carbon\Carbon::parse($client->last_seen_at)->format('Y-m-d');
                                                @endphp
                                                @if( $last_seen == $current_time )
                                                    {{ \Carbon\Carbon::parse($client->last_seen_at)->format('H:i') }}
                                                @else
                                                    {{ $client->last_seen_at }}
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body bg-white">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-box d-sm-flex mb-4">
                                <h2 class="title">Daily Active Users</h2>
                                <div class="select-box d-flex">
                                    <select name="" class="form-control" id="select-chart-2-3">
                                        <option value="last_month"> {{ __('lang.last_month') }} </option>
                                        <option value="last_year"  selected > {{ __('lang.last_year') }} </option>
                                        <option value="all_dates"> {{ __('lang.all_time') }} </option>
                                    </select>

                                </div>
                            </div>
                            <canvas id="chart-2-3" width="400" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item licenses-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">{{ __('lang.licenses') }}</h2>
                    <h3 class="number">
                        <span class="count">{{ $licenses->count() }}</span>
                    </h3>


                    <p class="info">({{ $licenses->where('usage',1)->where('date','>=',date('Y-m-d'))->count() }} {{ __('lang.active') }})</p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-3" width="140" height=""></canvas>
                </div>
            </div>
            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title"> {{ __('lang.licenses') }}</h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">
                                <div class="circle-chart">
                                    <canvas id="chart-3-1" height="148"></canvas>
                                    <div class="chart-title">
                                        <h2 class="title">  {{ __('lang.licenses') }} </h2>
                                        <h3 class="number"> <span class="count">{{ $licenses->count() }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="statistics-chart-info">
                                <table class="table table-sm table-borderless chart-info-box">
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: rgb(121, 210, 222);"></span>
                                            <span class="mr-3">{{ __('lang.active') }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $licenses->where('usage',1)->where('date','>=',date('Y-m-d'))->count() }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: rgb(121, 210, 222, .3);"></span>
                                            <span class="mr-3">{{ __('lang.inactive') }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $licenses->where('usage',0)->where('date','>=',date('Y-m-d'))->count() }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dot" style="background-color: rgb(255, 184, 34, .5);"></span>
                                            <span class="mr-3">{{ __('lang.expired') }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-3">{{ $licenses->where('date','<',date('Y-m-d'))->count() }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="user-card">
                                <h2 class="title"> {{ __('lang.top') .' '. __('lang.companies') }} </h2>
                                <div class="user-list">
                                    @foreach (App\Models\Clients::whereHas('licenses')->withCount('licenses')->orderBy('licenses_count',  'desc')->take(10)->get() as $client)
                                        <div class="user-box">
                                            <div class="pic">
                                                <img src="{{ $client->logo }}" alt="">
                                            </div>
                                            <div class="content">
                                                <h3 class="name">{{ object_get($client , 'name') }}</h3>
                                                <p class="info">
                                                    @if (!is_null($client->products))
                                                        @foreach ($client->products as $product)
                                                            {{ $product->name }} ,
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body bg-light">
                    <div class="form-box d-sm-flex mb-4">
                        <h2 class="title">Product Licenses Income</h2>
                        <div class="select-box d-flex">
                            <select name="" class="form-control mr-2" id="chart-3-2_product-id">
                                <option value="" selected> All Products </option>
                                @if($products_data)
                                    @foreach($products_data as $pr)
                                        <option value="{{$pr->id}}">{{$pr->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <select name="" class="form-control" id="select-chart-3-2">
                                <option value="1" selected> Last 6 months </option>
                                <option value="2"   > Last 12 months </option>
                            </select>

                        </div>
                    </div>

                    <canvas id="chart-3-2" width="596" height="100"></canvas>

                    <div class="statistics-chart-info d-sm-flex justify-content-center gap-3 mt-4 statistics-product-info">

                    </div>
                </div>
                {{-- <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="statistics-chart-box">
                                <div class="form-box d-sm-flex mb-4">
                                    <h2 class="title">Licenses Purchase History</h2>
                                    <div class="select-box d-flex">
                                        <select name="" class="form-control me-2" id="">
                                            <option value="" disabled="" selected=""> All Products </option>
                                        </select>
                                        <select name="" class="form-control" id="">
                                            <option value="" disabled="" selected=""> Last 6 months </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="statistics-count justify-content-center gap-5">
                                    <div class="box">
                                        <h3 class="title">Monthly</h3>
                                        <h4 class="number"><span class="count"> 20 </span></h4>
                                        <p class="status text-success">
                                            <i class="bi bi-arrow-up"></i> 13.8%
                                        </p>
                                    </div>
                                    <div class="box">
                                        <h3 class="title">Weekly</h3>
                                        <h4 class="number"><span class="count"> 10 </span></h4>
                                        <p class="status text-danger">
                                            <i class="bi bi-arrow-down"></i> 13.8%
                                        </p>
                                    </div>
                                    <div class="box">
                                        <h3 class="title">Daily (avg)</h3>
                                        <h4 class="number"><span class="count"> 2 </span></h4>
                                        <p class="status text-success">
                                            <i class="bi bi-arrow-up"></i> 13.8%
                                        </p>
                                    </div>
                                </div>
                                <canvas id="chart-3-3" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="chart-body bg-light">
                    <div class="table-head">
                        <h2 class="title">
                            License Activation
                            <span data-bs-toggle="tooltip"
                                title="Licenses usage status (in last 24h)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                    <path id="Icon_awesomr-question-circle" data-name="Icon awesomr-question-circle"
                                        d="M14.563,7.563a7.23,7.23,0,0,1-1.1,3.775,6.868,6.868,0,0,1-5.9,3.225,7,7,0,1,1,7-7ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                        transform="translate(-0.563 -0.563)" fill="#43425d" />
                                </svg>
                            </span>
                        </h2>

                        <a href="{{ route('admin.licenses.index') }}" class="view-all"> {{ __('lang.view') . ' ' . __('lang.all') }} </a>
                    </div>
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('lang.date_modified') }}</th>
                                <th>{{ __('lang.license_code') }}</th>
                                <th>{{ __('lang.product_name') }}</th>
                                <th>{{ __('lang.company_name') }}</th>
                                <th>{{ __('lang.status') }}</th>
                            </tr>
                            @foreach ($licenses->sortByDesc('updated_at')->take(10) as $license)
                                <tr>
                                    <td>{{ $license->updated_at }}</td>
                                    <td>{{ $license->license_code }}</td>
                                    <td>{{ object_get($license , 'product.name' , '-') }}</td>
                                    <td>{{ object_get($license , 'client.name' , '-')  }}</td>
                                    <td>
                                        <span class="badge {{$license->license_status['color']}}">
                                            {{ $license->license_status['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item activations-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">{{ __('lang.activations') }}</h2>
                    <h3 class="number">
                        <span class="count">{{ $totalActivations =  App\Models\ApiCall::activations()->count() }}</span>
                    </h3>
                    <p class="info">({{$activations = App\Models\ApiCall::whereIn('function',[App\Models\ApiCall::ActivateLicense])->where('status',1)->count()}} Active)</p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-4" width="140" height="140"></canvas>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title"> {{ __('lang.activations') }} </h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">
                                <div class="circle-chart">
                                    <canvas id="chart-4-1" height="148"></canvas>
                                    <div class="chart-title">
                                        <h2 class="title"> {{ __('lang.activations') }} </h2>
                                        <h3 class="number"> <span class="count">{{ $totalActivations }}</span></h3>
                                    </div>
                                </div>
                            </div>
                            @php
                                $success_activation = App\Models\ApiCall::whereIn('function',[App\Models\ApiCall::ActivateLicense])->where('status',1)->count();
                                $success_deactivation = App\Models\ApiCall::whereIn('function',[App\Models\ApiCall::DeactivateLicense])->where('status',1)->count();

                                $fail_activation = App\Models\ApiCall::whereIn('function',[App\Models\ApiCall::ActivateLicense])->where('status',0)->count();
                                $fail_deactivation = App\Models\ApiCall::whereIn('function',[App\Models\ApiCall::DeactivateLicense])->where('status',0)->count();
                            @endphp
                            <div class="statistics-chart-info">
                                <table class="table table-sm table-borderless">
                                    <tr class="chart-info-box">
                                        <td>
                                            <span class="dot" style="background-color: rgb(121, 210, 222)"></span>
                                            <span class="mr-3">{{ __('lang.success_activation') }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-3" id="success_activations" data-value="{{ $success_activation }}">{{ $success_activation }}</span>
                                        </td>
                                    </tr>
                                    <tr class="chart-info-box">
                                        <td>
                                            <span class="dot" style="background-color: rgb(121, 210, 222, .3);"></span>
                                            <span class="mr-3">{{ __('lang.fail_activation') }}</span>
                                        </td>
                                        <td>
                                            <span class="mr-3" id="fail_Activation" data-value="{{ $fail_activation }}">{{ $fail_activation }}</span>
                                        </td>
                                    </tr>
                                    <tr class="chart-info-box">
                                        <td>
                                            <span class="dot" style="background-color: rgb(255, 65, 65)"></span>
                                            <span class="mr-3">Success Deactivation</span>
                                        </td>
                                        <td>
                                            <span class="mr-3" id="success_deactivations" data-value="{{ $success_deactivation }}">{{ $success_deactivation }}</span>
                                        </td>
                                    </tr>
                                    <tr class="chart-info-box">
                                        <td>
                                            <span class="dot" style="background-color: rgb(255, 65, 65, .3);"></span>
                                            <span class="mr-3">Fail Deactivation</span>
                                        </td>
                                        <td>
                                    <span class="mr-3" id="fail_deActivation" data-value="{{ $fail_deactivation }}">{{ $fail_deactivation }}</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="statistics-chart-box">
                                <div class="form-box d-sm-flex mb-4">
                                    <h2 class="title">Activations</h2>
                                    <div class="select-box d-flex">
                                        <select name="" class="form-control" id="activation_select_chart">
                                            <option value="1" selected> Last 6 months </option>
                                            <option value="2" > Last 12 months </option>
                                        </select>
                                    </div>
                                </div>

                                @if($data['activations_month_month_pct'] != 0 or $data['activations_week_pct'] != 0 or $data['activations_today_pct'] != 0)
                                <div class="statistics-count justify-content-center gap-5">
                                    @if($data['activations_month_month_pct'] != 0)
                                    <div class="box">
                                        <h3 class="title">Monthly</h3>
                                        <h4 class="number"><span class="count"> {{$data['activations_month']}} </span></h4>
                                        <p class="status @if($data['activations_month_month_pct'] > 0) text-success @else text-danger @endif">
                                            <i class="bi @if($data['activations_month_month_pct'] > 0) bi-arrow-up @else bi-arrow-down @endif"></i> {{round($data['activations_month_month_pct'],2)}}%
                                        </p>
                                    </div>
                                    @endif

                                    @if($data['activations_week_pct'] != 0)
                                    <div class="box">
                                        <h3 class="title">Weekly</h3>
                                        <h4 class="number"><span class="count"> {{$data['activations_weekly']}} </span></h4>
                                        <p class="status text-danger">
                                            <i class="bi bi-arrow-down"></i> {{round($data['activations_week_pct'],2)}}%
                                        </p>
                                    </div>
                                    @endif

                                    @if($data['activations_today_pct'] != 0)
                                    <div class="box">
                                        <h3 class="title">Daily (avg)</h3>
                                        <h4 class="number"><span class="count"> {{$data['activations_today']}} </span></h4>
                                        <p class="status @if($data['activations_today_pct'] > 0) text-success @else text-danger @endif">
                                            <i class="bi @if($data['activations_today_pct'] > 0) bi-arrow-up @else bi-arrow-down @endif"></i> {{round($data['activations_today_pct'],2)}}%
                                        </p>
                                    </div>
                                    @endif
                                </div>
                                @endif
                                <canvas id="chart-4-2" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="chart-body bg-light">
                    <div class="form-box d-sm-flex mb-4">
                        <h2 class="title">{{ __('lang.activation') . ' ' . __('lang.activity') }}</h2>
                        <div class="select-box d-flex">
                            <select name="" class="form-control" id="activation_select">
                                <option value="1" selected> Last 6 months </option>
                                <option value="2" > Last 12 months </option>
                            </select>

                        </div>
                    </div>

                    <canvas id="chart-4-3" width="596" height="100"></canvas>
                </div> --}}

                <div class="chart-body bg-light">
                    <div class="table-head">
                        <h2 class="title">
                            Licenses Activation
                            <span data-bs-toggle="tooltip"
                                title="Licenses activation status (in last 24h)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                    <path id="Icon_awesomr-question-circle" data-name="Icon awesomr-question-circle"
                                        d="M14.563,7.563a7.23,7.23,0,0,1-1.1,3.775,6.868,6.868,0,0,1-5.9,3.225,7,7,0,1,1,7-7ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                        transform="translate(-0.563 -0.563)" fill="#43425d" />
                                </svg>
                            </span>
                        </h2>

                        <a href="{{ route('admin.activations.index') }}" class="view-all"> {{ __('lang.view') . ' ' . __('lang.all') }} </a>
                    </div>
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('lang.license_code') }}</th>
                                <th>{{ __('lang.product_name') }}</th>
                                <th>{{ __('lang.company_name') }}</th>
                                <th>{{ __('lang.status') }}</th>
                            </tr>
                            @foreach (App\Models\ApiCall::activations()->whereRaw('MONTH(created_at) = '. Carbon\Carbon::now()->month)->take(10)->get() as $item)
                            <tr>
                                <td>{{ object_get($item , 'license_code' , '-') }}</td>
                                <td>{{ object_get($item , 'product.name' , '-') }}</td>
                                <td>{{ object_get($item , 'client.name' , '-') }}</td>
                                <td>
                                    @if(isset($item) and $item)
                                    <span class="btn m-btn m-btn--icon m-btn--pill py-1 {{ $item->status ? "btn-success" : "btn-danger" }}">
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


                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item downloads-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">Update Downloads</h2>
                    <h3 class="number">
                        <span class="count">{{ $update_download_all }}</span>
                    </h3>
                    <p class="info">({{ $update_download_today }} Success today) <span class="@if($data['update_download_pct_today'] > 0) up @else down @endif">{{round($data['update_download_pct_today'],2)}}%</span></p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-5" width="140" height=""></canvas>
                </div>
            </div>
            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title"> Update Downloads </h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="d-md-flex jusify-content-center justify-content-center">
                                <div class="statistics-chart-box">
                                    <div class="circle-chart">
                                        <div class="chart-title">
                                            <h2 class="title mb-3"> Update Downloads </h2>
                                            <span class="count">{{ $update_download_all }}</span>
                                        </div>
                                        <canvas id="chart-5-1" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="statistics-chart-info mx-0 ml-4">
                                    <table class="table table-borderless table-sm">
                                        <tr class="chart-info-box">
                                            <td>
                                                <span class="dot" style="background-color: #147AD6"></span>
                                                <span class="mr-3">Success Downloads</span>
                                            </td>
                                            <td>
                                                <div class="h5"><strong>@if($update_download_array) {{ $update_download_array[0] }} @endif</strong></div>
                                            </td>
                                        </tr>
                                        <tr class="chart-info-box">
                                            <td>
                                                <span class="dot" style="background-color: #EC6666;"></span>
                                                <span class="mr-3">Failed Downloads</span>
                                            </td>
                                            <td>
                                                <div class="h5">
                                                    <strong>@if ($update_download_array) {{ $update_download_array[1] }} @endif</strong>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chart-body bg-light" style="background: #Fff">
                    <div class="statistics-chart-box">
                        <div class="form-box d-sm-flex mb-4">
                            <h2 class="title">Downloads History</h2>
                            <div class="select-box d-flex">
                                <select name="" class="form-control" id="download_history_chart">
                                    <option value="1" selected> Last 6 months </option>
                                    <option value="2" > Last 12 months </option>
                                </select>
                            </div>
                        </div>
                        <canvas id="chart-5-2" height="100"></canvas>
                        <div class="statistics-chart-info d-sm-flex justify-content-center gap-3 mt-4">
                            <div class="chart-info-box">
                                <span class="dot" style="background-color: #4791FF"></span>
                                <span class="mr-3">Success</span>
                            </div>
                            <div class="chart-info-box">
                                <span class="dot" style="background-color:  #EC6666"></span>
                                <span class="mr-3">Failed</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chart-body bg-white">
                    <div class="table-head">
                        <h2 class="title">
                            Downloads (Past 24 hours)
                            <span data-bs-toggle="tooltip"
                                title=" Downloads (Past 24 hours)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                    <path id="Icon_awesomr-question-circle" data-name="Icon awesomr-question-circle"
                                        d="M14.563,7.563a7.23,7.23,0,0,1-1.1,3.775,6.868,6.868,0,0,1-5.9,3.225,7,7,0,1,1,7-7ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                        transform="translate(-0.563 -0.563)" fill="#43425d" />
                                </svg>
                            </span>
                        </h2>

                        <a href="{{URL::to('/')}}/admin/downloads" class="view-all"> view all </a>
                    </div>
                    <div class="table-responsive table-content">
                        <table class="table table-bordered">
                            <tr>
                                <th>Version</th>
                                <th>Product Name</th>
                                <th>Company Name</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                            @if($update_download and count($update_download) > 0)
                                @foreach($update_download as $download)
                                <tr>
                                    <td>@if($download->version) {{$download->version->name}} @else - @endif</td>
                                    <td>@if($download->product) {{$download->product->name}} @else - @endif</td>
                                    <td>@if($download->client) {{$download->client->name}} @else - @endif</td>
                                    <td>{{date('d M, Y, H:i A',strtotime($download->created_at))}}</td>
                                    <td>
                                        <span class="btn m-btn m-btn--icon m-btn--pill py-1 {{ $download->status ? "btn-success" : "btn-danger" }}">
                                            {{ $download->status ? __('lang.success') : __('lang.faild') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr><td class="text-center" colspan="5">No downloads on last 24</td></tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item api-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">API Calls</h2>
                    <h3 class="number">
                        <span class="count">{{$api_call_all }}</span>
                    </h3>
                    <p class="info">( {{ $api_call_today }} Success today) <span class=" @if($data['api_call_pct_today'] > 0) up @else down @endif">{{ round($data['api_call_pct_today'], 2) }}%</span></p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-6" width="140" height=""></canvas>
                </div>
            </div>

            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title"> API Calls </h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <div class="statistics-chart-box">
                                <div class="circle-chart">
                                    <div class="chart-title">
                                        <h2 class="title mb-3"> API Calls</h2>
                                         <span class="count">{{ $api_call_all  }}</span>
                                    </div>
                                    <canvas id="chart-6-1" height="100"></canvas>
                                </div>
                            </div>
                            <div class="statistics-chart-info d-sm-flex gap-3 justify-content-center">

                                <table class="table table-borderless table-sm">
                                    <tr class="chart-info-box">
                                        <td>
                                            <span class="dot" style="background-color: #147AD6"></span>
                                            <span class="mr-3">Success API Calls</span>
                                        </td>
                                        <td>
                                            <div class="h5"><strong>{{ $api_call_all_success }}</strong></div>
                                        </td>
                                    </tr>
                                    <tr class="chart-info-box">
                                        <td>
                                            <span class="dot" style="background-color: #EC6666;"></span>
                                            <span class="mr-3">Failed API Calls</span>
                                        </td>
                                        <td>
                                            <div class="h5"><strong>{{$api_call_all_faild}}</strong></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="table-head mb-2">
                                <h2 class="title"> Top APIs</h2>
                                <div class="select-box d-flex">
                                    <select name="" class="form-control" id="top_api_select">
                                        <option value="1" > Last 6 months </option>
                                        <option value="2" > Last 12 months </option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive table-content">
                                <table class="table table-api-call">
                                    @if( $top_api_call )
                                        @foreach( $top_api_call as $api )
                                            @php
                                                $function_name='';
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
                                                }else if ( $api->function == 0 ) {
                                                    $function_name = 'Unknown Function';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $function_name }}</td>
                                                <td class="text-end">{{ $api->cnt }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chart-body bg-light">
                    <div class="statistics-chart-box">
                        <div class="form-box d-sm-flex mb-4">
                            <h2 class="title">API Activity</h2>
                            <div class="select-box d-flex">
                                <select name="" class="form-control" id="api_activity_chart">
                                    <option value="1" selected> Last 6 months </option>
                                    <option value="2" > Last 12 months </option>
                                </select>
                            </div>
                        </div>
                        <canvas id="chart-6-2" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @php

            $yesterdayNotificationsCount = App\Models\Notifications::whereRaW('date(date) ='.Carbon\Carbon::yesterday()->format('Y-m-d'))->count();

        @endphp
        <div class="col-xl-4 col-lg-6 grid-item products-grid-item Notifications-grid-item">
            <div class="statistics-box">
                <div class="content">
                    <h2 class="title">{{ __('lang.notifications') }} </h2>
                    <h3 class="number">
                        <span class="count">{{ $notificationsCount  }}</span>
                    </h3>
                    <p class="info">({{ $todayNotificationsCount }} {{ __('lang.today') }}) <span class="@if($data['notifications_pct_today'] > 0) up @else down @endif"> {{ round($data['notifications_pct_today'],2) }}%</span></p>
                </div>
                <div class="chart-box">
                    <canvas id="chart-7" width="140" height=""></canvas>
                </div>
            </div>
            <div class="statistics-box-info d-none">
                <div class="close-statistics-box"> &times;</div>
                <div class="head">
                    <h2 class="title">Notifications</h2>
                </div>
                <div class="chart-body">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="d-md-flex justify-content-center">
                                <div class="statistics-chart-box">
                                    <div class="circle-chart">
                                        <div class="chart-title">
                                            <h2 class="title mb-3"> {{ 'Total Notification' }}</h2>
                                            <span class="number">
                                                {{ $notificationsCount }}
                                            </span>
                                        </div>
                                        <canvas id="chart-7-1" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="statistics-chart-info mx-0 ml-4">
                                    <table class="table table-borderless table-sm">
                                        <tr class="chart-info-box">
                                            <td>
                                                <span class="dot" style="background-color: #147AD6"></span>
                                                <span class="mr-3">Total Notifications</span>
                                            </td>
                                            <td>
                                                <div class="h5"><strong>{{ $notificationsCount }}</strong></div>
                                            </td>
                                        </tr>
                                        <tr class="chart-info-box">
                                            <td>
                                                <span class="dot" style="background-color: #EC6666;"></span>
                                                <span class="mr-3">Today Notifications</span>
                                            </td>
                                            <td>
                                            <div class="h5"><strong>{{ $todayNotificationsCount }}</strong></div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="chart-body bg-light">
                    <div class="statistics-chart-box">
                        <div class="form-box d-sm-flex mb-4">
                            <h2 class="title">Notifications History</h2>
                            <div class="select-box d-flex">
                                <select name="" class="form-control" id="notification_history_chart">
                                    <option value="1" selected> Last 6 months </option>
                                    <option value="2" > Last 12 months </option>
                                </select>
                            </div>
                        </div>
                        <canvas id="chart-7-2" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="custom-card">
                <div class="head  border-0">
                    <h2 class="title">Companies on Map</h2>
                </div>
                <div id="vmap" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="custom-card">
                <div class="head">
                    <h2 class="title">{{ __('lang.activity_logs') }}</h2>
                    <a href="{{ route('admin.activity_logs.index') }}" class="link">
                        {{ ucwords(__('lang.view') . ' ' . __('lang.all')) }}
                    </a>
                </div>
                <div class="body">
                    <div class="vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                        @foreach (Spatie\Activitylog\Models\Activity::orderBy('id', 'desc')->take(20)->get() as $activity)
                            <div class="vertical-timeline-item vertical-timeline-element">
                                <div>
                                    <span class="vertical-timeline-element-icon">
                                        <i
                                            class="badge badge-dot badge-dot-xl {{ App\Http\Helpers\Helpers::getColorOfActivity($activity) }}">
                                        </i>
                                    </span>
                                    <div class="vertical-timeline-element-content">
                                        <p>{{ object_get($activity, 'causer.name', 'system') . ' ' . $activity->description }}
                                        </p>
                                        <span
                                            class="vertical-timeline-element-date">{{ $activity->created_at->format('H:i') }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
