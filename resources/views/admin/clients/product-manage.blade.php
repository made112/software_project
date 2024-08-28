@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.show_company') }}
@stop
@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/jqvmap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/custom.css') }}">

    <style>
        @media (min-width: 1400px) {
            .container {
                max-width: 1650px;
            }
        }

        @media (max-width: 1024px) {
            .grid-item-lg {
                width: 66.66666667%;
            }
        }

        @media (max-width: 786px) {
            .grid-item-lg {
                width: 100%;
            }
        }

        .grid-item {
            display: flex;
            Width: 100%
        }

        .grid-item-lg {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .statistics-box {
            width: 100%;
        }

        .statistics-box .content {
            padding: 0
        }

        .profile-section .statistics-box-info {
            border-radius: 15px;
            width: 100%;
        }

        .profile-user-box .user-box .content .nav-counters .nav-item .title {
            font-size: 12px !important;
        }

        .profile-user-box .user-box .content .nav-counters .nav-item .count {
            font-size: 14px !important;
        }

        body .profile-user-box .user-box .pic {
            min-width: 150px;
            height: 150px;
            font-size: 30px;
            line-height: 150px;
        }

        body .profile-user-box {
            padding: 30px !important
        }

        body .profile-user-box .user-box .content .nav-counters .nav-item .icon {
            text-align: center;
            line-height: 40px;
        }

        body .statistics-box .chart-box {
            width: 85px;
            height: 85px;
            background: rgb(15 157 194 / 10%);
            border-radius: 50%;
            color: #0F9DC2;
            text-align: center;
            line-height: 80px;
            min-width: 85px;
        }

        body .grid-item {
            height: 125px;
        }
    </style>
@stop

@section('page-content')
    <div class="m-grid__item main-page profile-section m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <!-- END: Subheader -->
        <div class="m-content mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-subheader p-0 ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">

                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon la la-home text-dark"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/dashboard" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                  style="font-weight:bold">{{ trans('lang.dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{ route('admin.clients.index') }}" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                  style="font-weight:bold">{{ trans('lang.companies') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{ route('admin.clients.show',['id'=>$client->id]) }}"
                                           class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                  style="font-weight:bold">{{$client->name}}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                  style="font-weight:bold">{{ trans('lang.products') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span
                                                class="m-nav__link-text text-dark">{{ trans('lang.manage_product') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                            <div class="m-demo__preview  m-demo__preview--btn">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>

            .grid-item-lg {
                flex: 0 0 66.66666667% !important;
                max-width: 66.66666667% !important;
                width: 100%;
            }

            @media (max-width: 1200px) {
                .grid-item-lg {
                    flex: 0 0 100% !important;
                    max-width: 100% !important;
                    width: 100%;
                }
            }

        </style>
        <div class="data-content containser mb-4 profile-section">
            <div class="profile-user-box" style="">
                <div class="user-box d-lg-flex mb-0">
                    <div class="pic mb-4 mb-md-0">
                        <!--
                            if user don't upload his pic to profile you can puu first letter from his name in below span,
                            but you must remove class "d-none" from span & put it in img
                        -->
                        <span class="d-none"> A S </span>
                        <img src="{{$client->logo}}" alt="profile-user" class="">
                    </div>
                    <div class="content">
                        <div class="company-name">{{ object_get($client, 'name', '-') }}</div>
                        <ul class="nav nav-counters">
                            <li class="nav-item">
                                <div class="icon text-primary" style="background: #5a69dd33">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="content">
                                    <p class="title">{{ __('lang.product_name') }}</p>
                                    <h3 class="count">{{ $product->name }}</h3>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="icon text-primary" style="background: #f1fbf1;">
                                    <i class="fas fa-stopwatch"></i>
                                </div>
                                <div class="content">
                                    <p class="title">{{ __('lang.start_date') }}</p>
                                    <h3 class="count">@if($last_licenses)
                                            {{date('Y-m-d',strtotime($last_licenses->created_at))}}
                                        @else
                                            -
                                        @endif</h3>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="icon text-danger" style="background: #fdeeee;color:#ec5353">
                                    <i class="fas fa-stopwatch"></i>
                                </div>
                                <div class="content">
                                    <p class="title">{{ __('lang.end_date') }}</p>
                                    <h3 class="count">{{ $last_licenses->date ?? '-' }}</h3>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="icon text-warning " style="background: #ffb92133">
                                    <i class="fas fa-hourglass"></i>
                                </div>
                                <div class="content">
                                    <p class="title">{{trans('lang.expiration')}} {{trans('lang.day')}}</p>
                                    <h3 class="count">@if($last_licenses)
                                            @if($last_licenses->date)
                                                @php
                                                    $now = time();
                                                    $your_date = strtotime($last_licenses->date);
                                                    $datediff = $your_date - $now;
                                                    if($datediff<0){
                                                        $datediff = 0;
                                                    }
                                                @endphp
                                                {{round($datediff / (60 * 60 * 24))}}
                                            @else
                                                {{trans('lang.unlimited')}}
                                            @endif
                                        @else
                                            -
                                        @endif</h3>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="icon" style="background: #f1fbf1;color:#70d274">
                                    <i class="fas fa-bars"></i>
                                </div>
                                <div class="content">
                                    <p class="title">{{ __('lang.status') }}</p>
                                    <h3 class="count">
                                        @if( $product->status == 1 )
                                            {{ 'Active' }}
                                        @elseif ( $product->status == 0 )
                                            {{ 'Inactive' }}
                                        @endif
                                    </h3>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row grid">
                <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
                    <div class="statistics-box flex-column">
                        <div class="data">
                            <div class="content">
                                <h2 class="title">Active Licenses</h2>
                                <h3 class="number">
                                    <span class="count">{{ $active_licenses }}</span>
                                </h3>
                            </div>
                            <div class="chart-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38.501" height="42.5"
                                     viewBox="0 0 38.501 42.5">
                                    <g id="clipboard-tick" transform="translate(-1.75 -0.75)">
                                        <path id="Path_163114" data-name="Path 163114" d="M9.311,17.2l3,3,8-8"
                                              transform="translate(6.311 10.2)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163115" data-name="Path 163115"
                                              d="M12,10h8c4,0,4-2,4-4,0-4-2-4-4-4H12C10,2,8,2,8,6S10,10,12,10Z"
                                              transform="translate(5 0)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163116" data-name="Path 163116"
                                              d="M29,4.02c6.66.36,10,2.82,10,11.96v12c0,8-2,12-12,12H15c-10,0-12-4-12-12v-12C3,6.86,6.34,4.38,13,4.02"
                                              transform="translate(0 2.02)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
                    <div class="statistics-box flex-column">
                        <div class="data">
                            <div class="content">
                                <h2 class="title">Inactive Licenses</h2>
                                <h3 class="number">
                                    <span class="count">{{ $inactive_licenses }}</span>
                                </h3>
                            </div>
                            <div class="chart-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38.596" height="42.596"
                                     viewBox="0 0 38.596 42.596">
                                    <g id="note-remove" transform="translate(-1.654 -0.654)">
                                        <path id="Path_163120" data-name="Path 163120" d="M7,14H17"
                                              transform="translate(4 12)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163121" data-name="Path 163121" d="M10.75,9.711l-7.5-7.5"
                                              transform="translate(0.25 0.211)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163122" data-name="Path 163122" d="M10.711,2.25l-7.5,7.5"
                                              transform="translate(0.211 0.25)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163123" data-name="Path 163123" d="M7,10H23"
                                              transform="translate(4 8)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163124" data-name="Path 163124"
                                              d="M10,2H22c6.66.36,10,2.82,10,11.98V30" transform="translate(7)"
                                              fill="none" stroke="#0f9dc2" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163125" data-name="Path 163125"
                                              d="M3,9.01V22.95c0,8.02,2,12.04,12,12.04H27" transform="translate(0 7.01)"
                                              fill="none" stroke="#0f9dc2" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163126" data-name="Path 163126"
                                              d="M27.026,16.026l-12,12v-6a5.3,5.3,0,0,1,6-6Z"
                                              transform="translate(11.973 13.973)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
                    <div class="statistics-box flex-column">
                        <div class="data">
                            <div class="content">
                                <h2 class="title">Expired Licenses</h2>
                                <h3 class="number">
                                    <span class="count">{{ $expired_licenses }}</span>
                                </h3>
                            </div>
                            <div class="chart-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38.69" height="42.507"
                                     viewBox="0 0 38.69 42.507">
                                    <g id="calendar-remove" transform="translate(-1.75 -0.75)">
                                        <path id="Path_163127" data-name="Path 163127" d="M8,2V7.714"
                                              transform="translate(4.524)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163128" data-name="Path 163128" d="M16,2V7.714"
                                              transform="translate(11.762)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163129" data-name="Path 163129" d="M3.5,9.09H35.881"
                                              transform="translate(0.452 6.415)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163130" data-name="Path 163130"
                                              d="M29.238,22.619a7.619,7.619,0,1,1-2.232-5.387A7.62,7.62,0,0,1,29.238,22.619Z"
                                              transform="translate(9.952 11.762)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163131" data-name="Path 163131" d="M20.987,22.019,16.949,18"
                                              transform="translate(12.621 14.476)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163132" data-name="Path 163132" d="M20.968,18.02,16.93,22.058"
                                              transform="translate(12.603 14.494)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163133" data-name="Path 163133"
                                              d="M37.286,13.024V28a7.619,7.619,0,0,0-13.333,5.029,7.469,7.469,0,0,0,1.1,3.924,6.845,6.845,0,0,0,1.5,1.79H12.524C5.857,38.738,3,34.929,3,29.214V13.024C3,7.31,5.857,3.5,12.524,3.5H27.762C34.429,3.5,37.286,7.31,37.286,13.024Z"
                                              transform="translate(0 1.357)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163134" data-name="Path 163134" d="M12,13.7h.01"
                                              transform="translate(8.139 10.585)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163135" data-name="Path 163135" d="M8.295,13.7H8.3"
                                              transform="translate(4.791 10.585)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163136" data-name="Path 163136" d="M8.295,16.7H8.3"
                                              transform="translate(4.791 13.299)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
                    <div class="statistics-box flex-column">
                        <div class="data">
                            <div class="content">
                                <h2 class="title">Blocked Licenses</h2>
                                <h3 class="number">
                                    <span class="count">{{ $blocked_licenses }}</span>
                                </h3>
                            </div>
                            <div class="chart-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="42.5" height="42.5"
                                     viewBox="0 0 42.5 42.5">
                                    <g id="lock" transform="translate(-0.75 -0.75)">
                                        <path id="Path_163117" data-name="Path 163117"
                                              d="M6,18V14C6,7.38,8,2,18,2S30,7.38,30,14v4" transform="translate(4)"
                                              fill="none" stroke="#0f9dc2" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163118" data-name="Path 163118"
                                              d="M19.5,18.5a5,5,0,1,1-1.464-3.536A5,5,0,0,1,19.5,18.5Z"
                                              transform="translate(7.5 11.5)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163119" data-name="Path 163119"
                                              d="M32,34H12C4,34,2,32,2,24V20c0-8,2-10,10-10H32c8,0,10,2,10,10v4C42,32,40,34,32,34Z"
                                              transform="translate(0 8)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
                    <div class="statistics-box flex-column">
                        <div class="data">
                            <div class="content">
                                <h2 class="title">Contacts</h2>
                                <h3 class="number">
                                    <span class="count">{{ $contacts }}</span>
                                </h3>
                            </div>
                            <div class="chart-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="42.5" height="36.5"
                                     viewBox="0 0 42.5 36.5">
                                    <g id="sms-tracking" transform="translate(-0.75 -2.25)">
                                        <path id="Path_163137" data-name="Path 163137"
                                              d="M2,13.5c0-7,4-10,10-10H32c6,0,10,3,10,10v14c0,7-4,10-10,10H12"
                                              transform="translate(0 0)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163138" data-name="Path 163138"
                                              d="M27,9l-6.26,5a6.332,6.332,0,0,1-7.5,0L7,9" transform="translate(5 5.5)"
                                              fill="none" stroke="#0f9dc2" stroke-linecap="round"
                                              stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163139" data-name="Path 163139" d="M2,16.5H14"
                                              transform="translate(0 13)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163140" data-name="Path 163140" d="M2,12.5H8"
                                              transform="translate(0 9)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 grid-item products-grid-item">
                    <div class="statistics-box flex-column">
                        <div class="data">
                            <div class="content">
                                <h2 class="title">Managers</h2>
                                <h3 class="number">
                                    <span class="count">{{ $managers }}</span>
                                </h3>
                            </div>
                            <div class="chart-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="38.504" height="42.5"
                                     viewBox="0 0 38.504 42.5">
                                    <g id="tag-user" transform="translate(-1.75 -0.75)">
                                        <path id="Path_163141" data-name="Path 163141"
                                              d="M33,35.724h-1.52a5.977,5.977,0,0,0-4.24,1.74l-3.42,3.38a4.044,4.044,0,0,1-5.661,0l-3.42-3.38a6,6,0,0,0-4.24-1.74H9a5.967,5.967,0,0,1-6-5.941V7.941A5.967,5.967,0,0,1,9,2H33a5.967,5.967,0,0,1,6,5.941V29.763a5.984,5.984,0,0,1-6,5.961Z"
                                              transform="translate(0 0)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163142" data-name="Path 163142"
                                              d="M14.1,12.851h-.3a3.9,3.9,0,1,1,4.04-3.9,3.847,3.847,0,0,1-3.74,3.9Z"
                                              transform="translate(7.041 3.05)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        <path id="Path_163143" data-name="Path 163143"
                                              d="M10.251,12.709a3.612,3.612,0,0,0,0,6.461,10.741,10.741,0,0,0,11,0,3.612,3.612,0,0,0,0-6.461,10.836,10.836,0,0,0-11,0Z"
                                              transform="translate(5.257 9.211)" fill="none" stroke="#0f9dc2"
                                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                    </g>
                                </svg>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                                    <tr>
                                        <th class="text-center font-weight-bold">#</th>
                                        <th class="text-center font-weight-bold">{{trans('lang.license_code')}}</th>
                                        <th class="text-center font-weight-bold">{{trans('lang.start_date')}}</th>
                                        <th class="text-center font-weight-bold">{{trans('lang.end_date')}}</th>

                                        <th class="text-center font-weight-bold">Grace End Days</th>
                                        <th class="text-center font-weight-bold">{{trans('lang.status')}}</th>
                                        <th class="text-center font-weight-bold">{{trans('lang.manage')}}</th>

                                    </tr>

                                    @if($all_licenses)
                                        @php $i=0; @endphp
                                        @foreach($all_licenses as $license)
                                            @php
                                                $status = '';
                                                $btn = '';
                                                if($license->license_status){
                                                    $status = $license->license_status['status'];
                                                    $btn = $license->license_status['color'];
                                                }
                                            @endphp

                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center">
                                                    {{ $license->license_code }}
                                                </td>
                                                <td class="text-center">
                                                    {{date('M d ,Y',strtotime($license->created_at))}}
                                                </td>
                                                <td class="text-center">
                                                    {{date('M d ,Y',strtotime($license->date))}}
                                                </td>
                                                <td class="text-center">
                                                    {{$license->grace_end_days ?? 0}}
                                                </td>

                                                <td class="text-center">
                                                    <button type="button" style="border-radius: 15px;"
                                                            class="btn  btn-sm py-1 {{ $btn }}">{{ $status }}</button>
                                                </td>
                                                <td class="text-center">
                                                    {{--                                                    {{URL::to('/')}}/admin/clients/product-mange/{{$client->id}}/{{$prod->id}}--}}
                                                    <a href="{{route('product-license-statistic',$license->id)}}"
                                                       class="btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                                        <i class="fa fa-cog"></i>
                                                  </a>
                                                </td>
                                                </tr>
                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
