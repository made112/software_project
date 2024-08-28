@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.show_company') }}
@stop
@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/jqvmap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/custom.css') }}">

    <style>
        @media (min-width: 1400px){
            .container {
                max-width: 1650px;
            }
        }

        @media (max-width: 1024px){
            .grid-item-lg {
                width: 66.66666667%;
            }
        }
        @media (max-width: 786px){
            .grid-item-lg {
                width: 100%;
            }
        }
        .grid-item{
            display: flex;
            Width: 100%
        }
        .grid-item-lg{
            flex: 0 0 50%;
            max-width: 50%;
        }
        .statistics-box {
            width: 100%;
        }
        .statistics-box .content{
            padding: 0
        }
        .profile-section .statistics-box-info {
            border-radius: 15px;
            width: 100%;
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
                                                  style="font-weight:bold">{{ trans('lang.company') }}</span>
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
                                                class="m-nav__link-text text-dark">{{ trans('lang.show_company') }}</span>
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


        <div class="data-content  containser mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="profile-user-box">
                        <div class="user-box d-lg-flex">
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
                                <ul class="nav nav-company-info">
                                    {{-- <li class="nav-item">
                                        <div class="icon">
                                            <svg id="Component_70_1" data-name="Component 70 – 1" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                                <rect id="Rectangle_8899" data-name="Rectangle 8899" width="26" height="26" rx="13" fill="#70d274" opacity="0.1"/>
                                                <path id="Icon_awesome-user-check" data-name="Icon awesome-user-check" d="M5.25,6a3,3,0,1,0-3-3A3,3,0,0,0,5.25,6Zm2.1.75H6.959a4.08,4.08,0,0,1-3.417,0H3.15A3.151,3.151,0,0,0,0,9.9v.975A1.125,1.125,0,0,0,1.125,12h8.25A1.125,1.125,0,0,0,10.5,10.875V9.9A3.151,3.151,0,0,0,7.35,6.75Zm7.57-3.009-.652-.659a.278.278,0,0,0-.394,0L11.419,5.517,10.352,4.444a.278.278,0,0,0-.394,0L9.3,5.1a.278.278,0,0,0,0,.394l1.915,1.929a.278.278,0,0,0,.394,0l3.312-3.286a.28.28,0,0,0,0-.394Z" transform="translate(5.25 7)" fill="#70d274"/>
                                            </svg>
                                        </div>
                                        <div class="title">
                                            {{ object_get($client, 'client_id', '-') }}
                                        </div>
                                    </li> --}}
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg id="Component_71_1" data-name="Component 71 – 1" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                                <rect id="Rectangle_8900" data-name="Rectangle 8900" width="26" height="26" rx="13" fill="#158ee3" opacity="0.1"/>
                                                <path id="Icon_zocial-email" data-name="Icon zocial-email" d="M.072,14.241V5.057q0-.016.048-.3L5.525,9.378.136,14.56a1.351,1.351,0,0,1-.064-.319ZM.79,4.116a.687.687,0,0,1,.271-.048H15.619a.9.9,0,0,1,.287.048l-5.421,4.64-.718.574L8.348,10.494,6.929,9.33l-.718-.574ZM.805,15.182,6.243,9.968l2.1,1.706,2.1-1.706,5.437,5.214a.766.766,0,0,1-.271.048H1.061a.722.722,0,0,1-.255-.048Zm10.365-5.8,5.39-4.624a.952.952,0,0,1,.048.3v9.185a1.222,1.222,0,0,1-.048.319Z" transform="translate(4.661 2.932)" fill="#158ee3"/>
                                            </svg>
                                        </div>
                                        <div class="title">
                                            {{ object_get($client, 'email', '-') }}
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg id="Component_72_1" data-name="Component 72 – 1" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                                <rect id="Rectangle_8901" data-name="Rectangle 8901" width="26" height="26" rx="13" fill="#56aad6" opacity="0.1"/>
                                                <path id="Icon_awesome-phone-alt" data-name="Icon awesome-phone-alt" d="M11.658,8.48,9.033,7.355a.563.563,0,0,0-.656.162L7.214,8.937A8.687,8.687,0,0,1,3.061,4.784l1.42-1.163a.561.561,0,0,0,.162-.656L3.518.34A.566.566,0,0,0,2.873.015L.436.577A.563.563,0,0,0,0,1.125,10.874,10.874,0,0,0,10.875,12a.563.563,0,0,0,.548-.436l.563-2.438A.569.569,0,0,0,11.658,8.48Z" transform="translate(7 7)" fill="#56aad6"/>
                                            </svg>
                                        </div>
                                        <div class="title">
                                            {{ object_get($client, 'country_code', '-') }}{{ object_get($client, 'phone_number', '-') }}
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg id="Component_73_1" data-name="Component 73 – 1" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                                <rect id="Rectangle_8901" data-name="Rectangle 8901" width="26" height="26" rx="13" fill="#0f9dc2" opacity="0.1"/>
                                                <path id="Icon_awesome-users" data-name="Icon awesome-users" d="M2.571,7.393A1.714,1.714,0,1,0,.857,5.679,1.716,1.716,0,0,0,2.571,7.393Zm12,0a1.714,1.714,0,1,0-1.714-1.714A1.716,1.716,0,0,0,14.571,7.393Zm.857.857H13.714a1.709,1.709,0,0,0-1.208.5,3.918,3.918,0,0,1,2.012,2.93h1.768a.856.856,0,0,0,.857-.857V9.964A1.716,1.716,0,0,0,15.429,8.25Zm-6.857,0a3,3,0,1,0-3-3A3,3,0,0,0,8.571,8.25Zm2.057.857h-.222a4.142,4.142,0,0,1-3.67,0H6.514a3.087,3.087,0,0,0-3.086,3.086v.771A1.286,1.286,0,0,0,4.714,14.25h7.714a1.286,1.286,0,0,0,1.286-1.286v-.771A3.087,3.087,0,0,0,10.629,9.107ZM4.637,8.748a1.709,1.709,0,0,0-1.208-.5H1.714A1.716,1.716,0,0,0,0,9.964v.857a.856.856,0,0,0,.857.857H2.622A3.928,3.928,0,0,1,4.637,8.748Z" transform="translate(4.428 4.75)" fill="#0f9dc2"/>
                                            </svg>
                                        </div>
                                        <div class="title">
                                            {{ $client->users_count . ' ' . __('lang.users') }}
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg id="Component_74_1" data-name="Component 74 – 1" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                                                <rect id="Rectangle_8901" data-name="Rectangle 8901" width="26" height="26" rx="13" fill="#e37281" opacity="0.1"/>
                                                <path id="Icon_material-location-on" data-name="Icon material-location-on" d="M11.7,3A4.2,4.2,0,0,0,7.5,7.2c0,3.15,4.2,7.8,4.2,7.8s4.2-4.65,4.2-7.8A4.2,4.2,0,0,0,11.7,3Zm0,5.7a1.5,1.5,0,1,1,1.5-1.5A1.5,1.5,0,0,1,11.7,8.7Z" transform="translate(1.3 4.5)" fill="#e37281"/>
                                            </svg>
                                        </div>
                                        <div class="title">
                                            {{ object_get($client, 'country.country_name', '-') }}
                                        </div>
                                    </li>
                                </ul>
                                <ul class="nav nav-counters">
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                                <g id="Group_3007" data-name="Group 3007" transform="translate(-1201 -1016)">
                                                    <rect id="Rectangle_558" data-name="Rectangle 558" width="40" height="40" rx="20" transform="translate(1201 1016)" fill="#005272" opacity="0.1"/>
                                                    <path id="server-solid" d="M15,36H1a1,1,0,0,1-1-1V33a1,1,0,0,1,1-1H15a1,1,0,0,1,1,1v2A1,1,0,0,1,15,36Zm-1.5-2.75a.75.75,0,1,0,.75.75A.75.75,0,0,0,13.5,33.25Zm-2,0a.75.75,0,1,0,.75.75A.75.75,0,0,0,11.5,33.25ZM15,41H1a1,1,0,0,1-1-1V38a1,1,0,0,1,1-1H15a1,1,0,0,1,1,1v2A1,1,0,0,1,15,41Zm-1.5-2.75a.75.75,0,1,0,.75.75A.75.75,0,0,0,13.5,38.25Zm-2,0a.75.75,0,1,0,.75.75A.75.75,0,0,0,11.5,38.25ZM15,46H1a1,1,0,0,1-1-1V43a1,1,0,0,1,1-1H15a1,1,0,0,1,1,1v2A1,1,0,0,1,15,46Zm-1.5-2.75a.75.75,0,1,0,.75.75A.75.75,0,0,0,13.5,43.25Zm-2,0a.75.75,0,1,0,.75.75A.75.75,0,0,0,11.5,43.25Z" transform="translate(1213 997)" fill="#005272"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h3 class="count">{{ $client->products->count() }}</h3>
                                            <p class="title">{{ __('lang.products') }}</p>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                                <g id="Group_3007" data-name="Group 3007" transform="translate(-1201 -1016)">
                                                    <rect id="Rectangle_558" data-name="Rectangle 558" width="40" height="40" rx="20" transform="translate(1201 1016)" fill="#ec5353" opacity="0.1"/>
                                                    <path id="id-badge-solid" d="M12.25,0H1.75A1.75,1.75,0,0,0,0,1.75V16.917a1.75,1.75,0,0,0,1.75,1.75h10.5A1.75,1.75,0,0,0,14,16.917V1.75A1.75,1.75,0,0,0,12.25,0Zm-7,1.167h3.5a.583.583,0,1,1,0,1.167H5.25a.583.583,0,0,1,0-1.167ZM7,5.833A2.333,2.333,0,1,1,4.667,8.167,2.335,2.335,0,0,1,7,5.833Zm4.083,8.633a.765.765,0,0,1-.817.7H3.733a.765.765,0,0,1-.817-.7v-.7a2.3,2.3,0,0,1,2.45-2.1h.182a3.755,3.755,0,0,0,2.9,0h.182a2.3,2.3,0,0,1,2.45,2.1Z" transform="translate(1214 1026.667)" fill="#ec5353"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h3 class="count">{{ $client->licenses->count() }}</h3>
                                            <p class="title">{{ __('lang.licenses') }}</p>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                                <g id="Group_21114" data-name="Group 21114" transform="translate(-1201 -1016)">
                                                    <rect id="Rectangle_558" data-name="Rectangle 558" width="40" height="40" rx="20" transform="translate(1201 1016)" fill="#70d274" opacity="0.1"/>
                                                    <path id="check-double-solid" d="M15.73,5.437,14.493,4.2a.747.747,0,0,0-1.059,0L5.951,11.683,2.47,8.2a.747.747,0,0,0-1.059,0L.17,9.44a.751.751,0,0,0,0,1.062L5.42,15.755a.747.747,0,0,0,1.059,0L15.727,6.5A.753.753,0,0,0,15.73,5.437ZM5.6,8.749a.5.5,0,0,0,.706,0l6.5-6.505a.5.5,0,0,0,0-.706L11.391.123a.5.5,0,0,0-.706,0L5.951,4.856,4.22,3.122a.5.5,0,0,0-.706,0L2.1,4.538a.5.5,0,0,0,0,.706L5.6,8.749Z" transform="translate(1213.051 1028.026)" fill="#70d274"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h3 class="count">{{$data['activation']}}</h3>
                                            <p class="title">Activations</p>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                                <g id="Group_21116" data-name="Group 21116" transform="translate(-1201 -1016)">
                                                    <rect id="Rectangle_558" data-name="Rectangle 558" width="40" height="40" rx="20" transform="translate(1201 1016)" fill="#56aad6" opacity="0.1"/>
                                                    <path id="download-solid" d="M7.594,0h2.812a.842.842,0,0,1,.844.844V6.75h3.083a.7.7,0,0,1,.5,1.2L9.482,13.3a.681.681,0,0,1-.96,0L3.168,7.949a.7.7,0,0,1,.5-1.2H6.75V.844A.842.842,0,0,1,7.594,0ZM18,13.219v3.937a.842.842,0,0,1-.844.844H.844A.842.842,0,0,1,0,17.156V13.219a.842.842,0,0,1,.844-.844H6L7.724,14.1a1.8,1.8,0,0,0,2.552,0L12,12.375h5.157A.842.842,0,0,1,18,13.219Zm-4.359,3.094a.7.7,0,1,0-.7.7A.705.705,0,0,0,13.641,16.312Zm2.25,0a.7.7,0,1,0-.7.7A.705.705,0,0,0,15.891,16.312Z" transform="translate(1212 1027)" fill="#56aad6"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h3 class="count">{{$data['downloads']}}</h3>
                                            <p class="title">Downloads</p>
                                        </div>
                                    </li>
                                    <li class="nav-item">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40">
                                                <g id="Group_21118" data-name="Group 21118" transform="translate(-1201 -1016)">
                                                    <rect id="Rectangle_558" data-name="Rectangle 558" width="40" height="40" rx="20" transform="translate(1201 1016)" fill="#fdb44d" opacity="0.1"/>
                                                    <path id="Path_162918" data-name="Path 162918" d="M13,7h8m0,0v8m0-8-8,8L9,11,3,17" transform="translate(1209 1024)" fill="none" stroke="#fdb44d" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                                                </g>
                                            </svg>
                                        </div>
                                        <div class="content">
                                            <h3 class="count">{{$data['api_call']}}</h3>
                                            <p class="title">API Calls</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="profile-user-tabs">
                            <ul class="nav nav-tabs">
                                @can('client_statistics')
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab"
                                           href="#company_statistics">{{ __('lang.company_statistics') }}</a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#products">{{ __('lang.products') }}</a>
                                </li>
                                @can('client_user')
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"
                                           href="#users">{{ __('lang.contacts') }}</a>
                                    </li>
                                @endcan
                                {{-- @can('edit_client')
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                        href="#update_profile">{{ __('lang.edit_company') }}</a>
                                </li>
                                @endcan --}}
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#project_manager">{{ __('lang.project_manager') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">

                    <div class="tab-content mt-5" id="myTabContent">
                        @can('client_statistics')
                            <div class="tab-pane fade show active" id="company_statistics" role="tabpanel"
                                 aria-labelledby="{{ __('lang.company_statistics') }}">
                                @include('admin.clients.statistics')
                            </div>
                        @endcan

                        @can('client_user')
                        <!-- begin users section  -->
                            <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="{{ __('lang.users') }}">



                                <div class="row ">
                                    <div class="col-md-12 mb-4">
                                        <h5 class="font-weight-bold float-left">{{ trans('lang.contacts') }}
                                            ({{ count($client->users) }})
                                        </h5>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-10 col-lg-10 mb-4">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <select name="status" id="status" class="status form-control reset-filter">
                                                    <option value="">{{ trans('lang.status') }}</option>
                                                    <option value="1">{{ trans('lang.active') }}</option>
                                                    <option value="2">{{ trans('lang.inactive') }}</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="product_id" id="product_id" class="product_id form-control reset-filter">
                                                    <option value="">{{ trans('lang.product') }}</option>
                                                    @foreach ($client->products as $product)
                                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="job_title form-control reset-filter" name="job_title"
                                                       id="job_title" autocomplete="off"
                                                       placeholder="{{ trans('lang.job_title') }}">
                                            </div>
                                            <div class="col-md-2 align-self-center">
                                                <button type="button" class="btn btn-md reset btn-info">{{trans('lang.reset')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-lg-2 mb-4 text-right">
                                        @can('add_client_user')
                                            <a href="{{ route('admin.clients.users.create', ['clientId' => $client->id]) }}"
                                               class="btn btn-md btn-dark text-white"><i class="fa fa-plus"></i>
                                                {{ trans('lang.add_user') }}</a>
                                        @endcan
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="table-container" id="users_table">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end users section -->
                        @endcan

                        <div id="products"  class="tab-pane fade" role="tabpanel" aria-labelledby="{{ __('lang.products') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                                            <tr>
                                                <th class="text-center font-weight-bold">#</th>
                                                <th class="text-center font-weight-bold">{{trans('lang.product_name')}}</th>
                                                <th class="text-center font-weight-bold">{{trans('lang.contacts')}}</th>
                                                <th class="text-center font-weight-bold">Licenses</th>
                                                {{-- <th class="text-center font-weight-bold">{{trans('lang.licenses_status')}}</th> --}}
                                                <th class="text-center font-weight-bold">{{trans('lang.product_status')}}</th>
                                                <th class="text-center font-weight-bold">{{trans('lang.gitlab')}}</th>
                                                <th class="text-center font-weight-bold">{{trans('lang.manage')}}</th>
                                            </tr>

                                            @if($client->products)
                                                @php $i=0; @endphp
                                                @foreach($client->products as $prod)
                                                    @php
                                                        if ($prod->status == 1) {
                                                            $text = trans('lang.active');
                                                        } else {
                                                            $text = trans('lang.inactive');
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td class="text-center">{{++$i}}</td>
                                                        <td class="text-center">
                                                            {{$prod->name}}
                                                        </td>
                                                        <td class="text-center">
                                                            @if($prod->supportUsers)
                                                                @foreach($prod->supportUsers as $key=>$users)
                                                                    {{$users->first_name}} {{$users->last_name}} <br>
                                                                @endforeach
                                                            @else
                                                                -
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @php
                                                                $active_licenses = 0;
                                                                $inactive_licenses = 0;
                                                                $expired_licenses = 0;
                                                                $blocked_licenses = 0;
                                                            @endphp

                                                            @if($prod->licenses)
                                                                @php
                                                                    $active_licenses = $prod->licenses->where('usage',1)->where('date','>=',date('Y-m-d'))->count();
                                                                    $inactive_licenses = $prod->licenses->where('usage',0)->where('date','>=',date('Y-m-d'))->count();
                                                                    $expired_licenses = $prod->licenses->where('date','<',date('Y-m-d'))->count();
                                                                    $blocked_licenses = $prod->licenses->where('block',1)->count();
                                                                @endphp

                                                            @endif

                                                            <div class="d-flex justify-content-center">
                                                                <button class="btn btn-outline-success btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="1">{{$active_licenses}} Active</button>
                                                                <button class="btn btn-outline-danger btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="2">{{$inactive_licenses}} Inactive</button>
                                                                <button class="btn btn-outline-warning btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="3">{{$expired_licenses}} Expired</button>
                                                                <button class="btn btn-outline-dark btn-show-details btn-sm ml-2" style="border-style: dashed;" data-product="{{$prod->id}}" data-id="4">{{$blocked_licenses}} Blocked</button>
                                                            </div>
                                                        </td>
                                                        {{-- <td class="text-center">

                                                            @if($prod->licenses)
                                                                @foreach($prod->licenses->sortByDesc('id')->take(1) as $key=>$licenses)
                                                                    {{$licenses->status_name}}
                                                                @endforeach
                                                            @else
                                                                -
                                                            @endif
                                                        </td> --}}
                                                        <td class="text-center">
                                                            {{$text}}
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ route('gitlab', ['client_id' => $client->id, 'product_id' => $prod->id]) }}"  class="btn btn-info btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
                                                                <i class="fa fa-cog"></i>
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{URL::to('/')}}/admin/clients/product-mange/{{$client->id}}/{{$prod->id}}"  class="btn btn-primary btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air">
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

                        {{-- @can('edit_client')
                        <!-- begin update client profile -->
                        <div class="tab-pane fade" id="update_profile" role="tabpanel"
                            aria-labelledby="{{ __('lang.edit_company') }}">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <h5 class="font-weight-bold">{{ trans('lang.edit_company') }}</h5>
                                        </div>
                                        <div class="col-md-12 col-lg-12">
                                            <form action="{{ route('admin.clients.update') }}"
                                                class="update_client_form" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $client->id }}">
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <label for="name">{{ trans('lang.company_name') }}</label>
                                                        <input type="text" name="name" id="name"
                                                            value="{{ $client->name }}" class="name form-control"
                                                            placeholder="{{ trans('lang.company_name') }}">
                                                    </div>

                                                    <div class="col-md-6 col-lg-6">
                                                        <label for="client_id">{{ trans('lang.company_id') }}</label>
                                                        <input type="text" name="client_id" id="client_id"
                                                            class="client_id form-control"
                                                            value="{{ $client->client_id }}"
                                                            placeholder="{{ trans('lang.company_id') }}">
                                                    </div>

                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-md-6 col-lg-6">
                                                        <label for="email">{{ trans('lang.email') }}</label>
                                                        <input type="email" name="email" id="email"
                                                            class="email form-control" value="{{ $client->email }}"
                                                            placeholder="{{ trans('lang.email') }}">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label
                                                                    for="phone_number">{{ trans('lang.phone_number') }}</label>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <select name="country_code" id="country_code"
                                                                    class="country_code form-control">
                                                                    @if (count($countries))
                                                                        @foreach ($countries as $c)
                                                                            <option value="{{ $c->country_code }}"
                                                                                @if ($c->country_code == $client->country_code) selected @endif>
                                                                                {{ $c->country_code }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" name="phone_number" id="phone_number"
                                                                    class="phone_number form-control"
                                                                    value="{{ $client->phone_number }}"
                                                                    placeholder="{{ trans('lang.phone_number') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <label for="country_id">{{ trans('lang.country') }}</label>
                                                        <select name="country_id" id="country_id"
                                                            class="country_id form-control">
                                                            @if (count($countries))
                                                                @foreach ($countries as $c)
                                                                    <option value="{{ $c->id }}"
                                                                        @if ($c->id == $client->country_id) selected @endif>
                                                                        {{ object_get($c, 'name_' . app()->getLocale()) }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="city_id">{{ ucwords(trans('lang.city')) }}</label>
                                                        <select name="city_id" id="city_id" class="city_id form-control"
                                                            required>
                                                            @if (!is_null(object_get($client, 'city')))
                                                                <option value="{{ object_get($client, 'city.id') }}"
                                                                    selected>
                                                                    {{ object_get($client, 'city.name') }}</option>
                                                            @endif
                                                            @if (count($cities))
                                                                @foreach ($cities as $c)
                                                                    <option value="{{ $c->id }}"
                                                                        {{ object_get($client, 'city_id') == $c->id ? 'selected' : '' }}>
                                                                        {{ $c->name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">


                                                    <div class="col-md-6 col-lg-6">
                                                        <label for="status">{{ trans('lang.status') }}</label>
                                                        <select name="status" id="status_edit" class="status form-control">
                                                            <option value="">{{ trans('lang.status') }}</option>
                                                            <option value="1"
                                                                @if ($client->status == 1) selected @endif>
                                                                {{ trans('lang.active') }}</option>
                                                            <option value="2"
                                                                @if ($client->status == 2) selected @endif>
                                                                {{ trans('lang.inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-12 col-lg-12 text-center">
                                                        <button type="submit"
                                                            class="btn btn-md px-5 text-white btn-dark">{{ trans('lang.submit') }}</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- enf update client profile -->


                        @endcan --}}

                        <div id="project_manager"  class="tab-pane fade" role="tabpanel" aria-labelledby="{{ __('lang.project_manager') }}">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0 bg-white" id="html_table" width="100%">
                                            <tr>
                                                <th class="text-center font-weight-bold">#</th>
                                                <th class="text-center font-weight-bold">{{trans('lang.name')}}</th>
                                            </tr>
                                            @if($client->projects_manager)
                                                @php $i=0; @endphp
                                                @foreach($client->projects_manager as $proj)
                                                    <tr>
                                                        <td class="text-center">{{++$i}}</td>
                                                        <td class="text-center">
                                                            @if($proj->manager)
                                                                {{$proj->manager->name}}
                                                            @else
                                                                -
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

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="modal fade" id="DetailsLicenses"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Licenses code</th>
                            <th scope="col" class="text-center">Expiration days</th>
                            <th scope="col" class="text-center">No. Used license</th>
                        </tr>
                        </thead>
                        <tbody class="body-license">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Hide</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')


    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"
            integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.countup.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.vmap.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.vmap.world.js') }}"></script>

    <script>
        var  cartDataURL = "{{ route('admin.clients.get_chart_data' , ['client' => $client->id]) }}"

        var license_data = {
            labels: {!! json_encode(array_column( $licensesData , 'date_group' )) !!},
            datasets: [{
                data:  {!! json_encode(array_column( $licensesData , 'price' )) !!},
                borderWidth: 1,
                borderColor: "#0058FF",
                backgroundColor: "#0058FF",
                lineTension: .35,
                radius: 0
            }]
        }

        var activations_chart = {
            labels: {!! json_encode(array_column($activationsData , 'date' ))  !!},
            datasets: [{
                data : {!! json_encode(array_column($activationsData , 'count' ))  !!},
                fill: true,
                backgroundColor: "#D1E6FA",
                borderWidth: 2,
                borderColor: "#0058FF",
                //        lineTension: .35,
                radius: 0
            }]
        }
    </script>


    <script src="{{ asset('admin-assets/assets/statistics/js/custom-user.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/statistics_ajax-user.js') }}"></script>


    <script>

        function getUsers() {
            $('#load').show();

            $.ajax({
                url: "{{ route('admin.clients.users.index', ['clientId' => $client->id]) }}",
                type: "GET",
                dataType: "JSON",
                data: {
                    status: $('#status').val(),
                    product_id: $('#product_id').val(),
                    job_title: $('#job_title').val()
                },
                success: function(response) {
                    $('#load').hide();
                    $('#users_table').empty().html(response.data)
                },
                error: function(response) {
                    $('#load').hide();

                }
            })
        }

        $(document).on('click','.reset',function(e){
            e.preventDefault();
            $('.reset-filter').val('');
            getUsers();
        });

        function deleteUser(id, route) {
            Swal.fire({
                title: "{{ __('lang.are_you_sure') }}?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "{{ __('lang.yes') }}!",
                cancelButtonText: "{{ __('lang.cancel') }}!",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: route,
                        type: "DELETE",
                        token: "{{ csrf_token() }}",
                        dataType: "JSON",
                        data: {
                            id: id,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            $('#load').hide();
                            getUsers()

                            if (data["status"] == true) {
                                swal({
                                    title: "",
                                    text: data["data"],
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "حسنا",
                                    cancelButtonText: "الغاء",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                            } else {
                                swal({
                                    title: "",
                                    text: data["data"],
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{ __('lang.ok') }}",
                                    cancelButtonText: "{{ __('lang.cancel') }}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                            }
                        },
                        error: function(data) {
                            $('#load').hide();

                            swal({
                                title: "",
                                text: "{{ __('lang.error') }}",
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{ __('lang.ok') }}",
                                cancelButtonText: "{{ __('lang.cancel') }}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                            getUsers()

                        }
                    })
                } else if (result.dismiss === "cancel") {
                    Swal.fire(
                        "{{ __('lang.cancel') }}",
                        "{{ __('lang.cancel') }}",
                        "error"
                    )
                    getUsers()

                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            getUsers()
        })

        $('#status , #product_id').on('change', function() {
            getUsers()
        })

        $('#job_title').on('input', function() {
            getUsers()
        })
    </script>

    <script>
        $('.update_client_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            console.log(formData.get('country_code'))
            $.ajax({
                url: "{{ route('admin.clients.update') }}",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $('#load').hide();
                    if (data["status"] == true) {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "حسنا",
                            cancelButtonText: "الغاء",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        }).then(function(resault) {
                            if (resault.value == true) {
                                location.replace(
                                    "{{ route('admin.clients.show', ['id' => $client->id]) }}"
                                );
                            }
                        });
                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                }
            });
        })
    </script>
    <script>
        const ctx_user_4_1 = document.getElementById('chart-user-4-1').getContext('2d');
        const chart_user_4_1 = new Chart(ctx_user_4_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Total Download',
                    'Today Download',
                ],
                datasets: [{
                    label: 'Download',
                    data: ["{{$data['update_download_all']}}","{{$data['update_download_today']}}"],
                    backgroundColor: ['#147AD6','#EC6666'],
                    borderRadius: 50,
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: "90%",
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                    },
                    x:{
                        display: false,
                        grid: {
                            display: false
                        },
                    }
                }
            },
        });
    </script>
    <script>
        const ctx_user_5_1 = document.getElementById('chart-user-5-1').getContext('2d');
        const chart_user_5_1 = new Chart(ctx_user_5_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Total API Calls',
                    'Today API Calls',
                ],
                datasets: [{
                    label: 'Download',
                    data: ["{{$data['update_download_all']}}","{{$data['update_download_today']}}"],
                    backgroundColor: ['#147AD6', '#EC6666'],
                    borderRadius: 50,
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: "90%",
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        display: false,
                        beginAtZero: true,
                        grid: {
                            display: false
                        },
                    },
                    x:{
                        display: false,
                        grid: {
                            display: false
                        },
                    }
                }
            },
        });
    </script>
    <script>
        $(document).on('click', '.update_status', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var status = $(this).data('status');
            var name = $(this).data('name');

            Swal.fire({
                title: '',
                text: "{{ trans('lang.are_you_sure_to') }} "+status+' '+name+' ?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ trans('lang.ok') }}",
                cancelButtonText: "{{ trans('lang.cancel') }}",
            }).then((result) => {
                if (result.value) {
                    $('#load').show();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '/admin/clients/{{$client->id}}/users/'+id+'/update_status',
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            id: id
                        },
                        success: function(data) {
                            $('#load').hide();
                            var url = $(this).attr
                            if (data["status"]) {
                                swal({
                                    title: "",
                                    text: data["data"],
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{ trans('lang.ok') }}",
                                    cancelButtonText: "{{ trans('lang.cancel') }}",
                                });
                                getUsers();
                            } else {
                                swal({
                                    title: "",
                                    text: data["data"],
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{ trans('lang.ok') }}",
                                    cancelButtonText: "{{ trans('lang.cancel') }}",
                                });
                            }
                        }
                    });
                }
            })
        });
    </script>

    <script>
        //     const ctx_user_1_1 = document.getElementById('chart-user-1-1').getContext('2d');
        //    const chart_user_1_2 = new Chart(ctx_user_1_1, {
        //        type: 'line',
        //        data: {
        //            labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
        //            datasets: [{
        //                data: [ 20, 32, 66, 50, 84, 46],
        //                borderWidth: 1,
        //                borderColor: "#70D274",
        //                backgroundColor: "#70D274",
        //                lineTension: .35,
        //                radius: 0
        //            },{
        //                data: [ 40,80, 50 ,60 ,70 ,40],
        //                borderWidth: 1,
        //                borderColor: "#EC6666",
        //                backgroundColor: "#EC6666",
        //                lineTension: .35,
        //                radius: 0
        //            }]
        //        },
        //        options: {
        //            plugins: {
        //                legend: {
        //                    display: false
        //                }
        //            },
        //            scales: {
        //                y: {
        //                 //   display: false,
        //                    beginAtZero: true,
        //                    grid: {
        //                        display: false
        //                    },
        //                },
        //                x:{
        //                    grid: {
        //                        display: false
        //                    },
        //                }
        //            }
        //        },
        //    });
    </script>
    <script>
        $(document).on('click','.btn-show-details',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            var product_id = $(this).data('product');
            $.ajax({
                url: "{{ route('admin.clients.products.licenses')}}",
                type: "GET",
                dataType: "JSON",
                data: {
                    id:id,product_id:product_id,client_id:{{$client->id}}
                },
                success: function(data) {
                    var count = data['data'].length;
                    var title = '';
                    if(id == 1){
                        title = 'Active';
                    }else if(id == 2){
                        title = 'Inactive';
                    }else if(id == 3){
                        title = 'Expired';
                    }else if(id == 4){
                        title = 'Blocked';
                    }
                    var table = '';

                    if(data.data && count > 0){
                        $.each(data.data, function( key, value ) {
                            table += `<tr>
                                <td class="text-center">`+value.license_code+`</td>
                                <td class="text-center">`+value.remain_day+`</td>
                                <td class="text-center">`+value.license_use.length+`</td>
                              </tr>`
                        });
                    }else{
                        var table = '<tr ><td class="text-center" colspan="3">No Data</td></tr>';
                    }

                    $('#DetailsLicenses .modal-title').text(title +' Licenses ('+count+')');
                    $('#DetailsLicenses .body-license').html(table);
                    $('#DetailsLicenses').modal('show');
                },
                error: function(data) {
                    $('#load').hide();

                }
            })
        });


        $(document).on('click','.close-modal',function(e){
            $('#DetailsLicenses').modal('hide');
        })

    </script>
@stop
