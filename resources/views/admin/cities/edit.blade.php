@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.edit') . ' ' . __('lang.city') }}
@stop
@section('css')
    <style>

    </style>
@stop
@section('page-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
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
                                        <a href="/admin/cities" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.cities') }}</span>
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
                                                class="m-nav__link-text text-dark">{{ trans('lang.edit') . ' ' . __('lang.city') }}</span>
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
        <div class="data-content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text" style="font-weight: bold">
                                        {{ trans('lang.edit') . ' ' . __('lang.city') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.cities.update', ['city' => $city->id]) }}"
                                class="add_city_form" method="post">
                                @method('PUT')
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="name_ar">{{ trans('lang.name_ar') }}</label>
                                        <input type="text" value="{{ $city->name_ar }}" name="name_ar" id="name_ar"
                                            class="name_ar form-control" placeholder="{{ trans('lang.name_ar') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="name_en">{{ trans('lang.name_en') }}</label>
                                        <input type="text" value="{{ $city->name_en }}" name="name_en" id="name_en"
                                            class="name_en form-control" placeholder="{{ trans('lang.name_en') }}">
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="country_id">{{ trans('lang.country') }}</label>
                                        <select name="country_id" id="country_id" class="form-control country_id">
                                            <option value="">{{ __('lang.select') . ' ' . __('lang.country') }}</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"
                                                    {{ $city->country_id == $country->id ? 'selected' : '' }}>
                                                    {{ $country->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-12 col-lg-12">
                                        <input type="checkbox" {{ $city->status ? "checked" : "" }} class="status" id="status" name="status">
                                        <label for="status">
                                            {{ __('lang.active') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
                                            class="btn btn-md px-5 text-white btn-black">{{ trans('lang.submit') }}</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>


@stop


@section('js')
    <script>
        $('.add_city_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('admin.cities.update', ['city' => $city->id]) }}",
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
                        });
                        location.replace("{{ route('admin.cities.index') }}");
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
                }
            });
        })
    </script>
@stop
