@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.gitlab') }}
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

        <div class="col-md-12 col-md-12 mt-4">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('updateGitlab', ['id' => $client_product->id]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="image">{{ __('lang.gitlab_link') }}</label>
                                        <input type="text" class="form-control image" value="{{ $client_product->gitlab_link }}" name="gitlab_link">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="image">{{ __('lang.gitlab_username') }}</label>
                                        <input type="text" class="form-control image" value="{{ $client_product->gitlab_username }}"  name="gitlab_username">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <div>
                                        <label for="image">{{ __('lang.gitlab_access_token') }}</label>
                                        <input type="text" class="form-control image" value="{{ $client_product->gitlab_access_token }}"  name="gitlab_access_token">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-lg-12 text-center">
                                <button type="submit" class="btn btn-md px-5 text-white btn-black">{{ trans('lang.submit') }}</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>


    </div>
@stop
