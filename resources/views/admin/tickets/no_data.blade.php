@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.tickets_title') }}
@stop
@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/jqvmap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/custom.css?v=1.0.2') }}">
    <link href="{{ asset('admin-assets/assets/app/plugins.bundle.css') }}" rel="stylesheet" />

@stop
@section('page-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->

        <!-- END: Subheader -->
        <div class="m-content mb-3">

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
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.tickets_page') }}</span>
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
        <div class="row justify-content-center mb-4">
            <h1>
                No Data
            </h1>
        </div>
    </div>
@endsection
