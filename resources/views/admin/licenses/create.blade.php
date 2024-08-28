@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.add_license') }}
@stop
@section('css')
    <style>
        .div_file,
        .div_limit {
            display: none;
        }
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
                                        <a href="/admin/licenses" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.licenses') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.add_license') }}</span>
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
                                        {{ trans('lang.add_license') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.licenses.add') }}" class="add_licenses_form" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="client_id">{{ trans('lang.company') }}</label>
                                        <a href="{{ route('admin.clients.create') }}" class="float-right">
                                            {{ trans('lang.add_company') }}
                                        </a>
                                        <div class="clearfix"></div>
                                        <select name="client_id" id="client_id" class="client_id form-control">
                                            <option value="">{{ trans('lang.company') }}</option>
                                        </select>
                                        <span style="color: #8b8b8b;" id="client_select">

                                        </span>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="product_id">{{ trans('lang.license_for_product') }}</label>
                                        {{-- <button type="button" class="btn btn-dark text-white btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn_add_product_to_client">
                                        <i class="fa fa-plus"></i>
                                    </button> --}}
                                        <select name="product_id" id="product_id" class="product_id form-control">
                                            <option value="">{{ trans('lang.product') }}</option>
                                        </select>

                                        <span style="color: #8b8b8b;" id="product_select">

                                        </span>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="license_code">{{ trans('lang.license_code') }}</label>
                                        <input type="text" name="license_code" id="license_code"
                                            value="{{ $license_code }}" class="license_code form-control"
                                            placeholder="{{ trans('lang.license_code') }}" style="pointer-events: none;">
                                    </div>

                                    {{-- Price Type ( Package ) --}}
                                    <div class="col-md-6 col-lg-6 mb-4">
                                        <label>{{ trans('lang.package_price_type') }}</label>
                                        <select name="price_type" class="price_type form-control" id="package_price_type"
                                            disabled="disabled">
                                            <option value="">Select Price Type</option>
                                        </select>
                                    </div>



                                    {{-- Duration --}}
                                    <div class="col-md-6 col-lg-6 mb-4">
                                        <label>{{ trans('lang.package_duration') }}</label>
                                        <select name="price_type" class="price_type form-control" id="package_duration"
                                            disabled>
                                            <option value="">Select Duration</option>
                                        </select>
                                    </div>

                                    {{-- Package Name --}}
                                    <div class="col-md-6 col-lg-6">
                                        <label>{{ trans('lang.package') }}</label>
                                        <span id="add_package">

                                        </span>
                                        <select name="product_package_id" class="form-control" id="license_package" disabled>
                                            <option value="">Select Package</option>
                                        </select>
                                        <span id="license_package_duration"
                                            style="color: #8b8b8b; font-size: 12px; display: inline-block; margin-bottom: 5px;">

                                        </span>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="license_expiration_date">{{ trans('lang.license_expiration_date') }}
                                            ({{ trans('lang.optional') }})</label>
                                        <input type="text" name="date" id="license_expiration_date"
                                            autocomplete="off" style="width:100%; pointer-events: none"
                                            class="date datepicker license_expiration_date form-control"
                                            placeholder="{{ trans('lang.license_expiration_date') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="license_expiration_days">
                                            <div class="position-relative">
                                                {{ trans('lang.license_expiration_days') }}
                                                ({{ trans('lang.optional') }})
                                                <label role="button" data-toggle="tooltip" data-placement="right"
                                                    title="{{ __('tooltip.license_expire_days') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle"
                                                            data-name="Icon awesome-question-circle"
                                                            d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                                            transform="translate(-0.563 -0.563)" fill="#43425d" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="number" name="days" id="license_expiration_days"
                                            autocomplete="off" class="license_expiration_days days form-control"
                                            placeholder="{{ trans('lang.license_expiration_days') }}"
                                            style="pointer-events: none">
                                    </div>


                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="license_type">{{ trans('lang.license_type') }}</label>
                                        <select name="type" class="license_type form-control" id="license_type">
                                            <option value="">{{ trans('lang.license_type') }}</option>
                                            <option value="1">{{ trans('lang.online') }}</option>
                                            <option value="2">{{ trans('lang.offline') }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="support_type">{{ trans('lang.support_type') }}</label>
                                        <select name="package_support_type" class="support_type form-control" id="support_type"
                                            disabled>
                                            <option>Select From Here</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-6 div_limit flex-column mb-3">
                                        <label for="parallel_use_limit">
                                            <div class="position-relative">
                                                {{ trans('lang.total_parallel_use_limit') }}
                                                ({{ trans('lang.leave_empty_unlimited_parallel_uses') }})
                                                <label role="button" data-toggle="tooltip" data-placement="right"
                                                    title="{{ __('tooltip.parallel_use_limit') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle"
                                                            data-name="Icon awesome-question-circle"
                                                            d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                                            transform="translate(-0.563 -0.563)" fill="#43425d" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="number" min="0" name="parallel_use_limit"
                                            id="parallel_use_limit" class="parallel_use_limit form-control"
                                            placeholder="{{ trans('lang.total_parallel_use_limit') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 div_limit flex-column mb-3">
                                        <label for="use_limit">
                                            <div class="position-relative">
                                                {{ trans('lang.total_license_use_limit') }}
                                                ({{ trans('lang.leave_empty_unlimited_uses') }})
                                                <label role="button" data-toggle="tooltip" data-placement="right"
                                                    title="{{ __('tooltip.use_limit') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle"
                                                            data-name="Icon awesome-question-circle"
                                                            d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                                            transform="translate(-0.563 -0.563)" fill="#43425d" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="number" min="0" name="use_limit" id="use_limit"
                                            class="use_limit form-control"
                                            placeholder="{{ trans('lang.total_license_use_limit') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 div_file">
                                        <label for="file">{{ trans('lang.license_file') }}
                                            </label>
                                        <input type="file" name="file" id="file" class="file form-control">
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="license_domains">{{ trans('lang.license_domains') }}
                                            ({{ trans('lang.optional') }})
                                        </label>
                                        <input type="text" name="domains" id="license_domains" data-role="tagsinput"
                                            class="license_domains form-control tagsinput"
                                            placeholder="{{ trans('lang.license_domains') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="payment_type">{{ trans('lang.payment_type') }}</label>
                                        <select name="payment_type" id="payment_type" class="form-control payment_type">
                                            <option value="">{{ trans('lang.payment_type') }}</option>
                                            @if ($payment_type)
                                                @foreach ($payment_type as $key => $pay)
                                                    <option value="{{ $key }}">{{ $pay }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="invoice_no">{{ trans('lang.invoice_no') }}
                                            ({{ trans('lang.optional') }})</label>
                                        <input type="text" name="invoice_no" id="invoice_no"
                                            class="invoice_no form-control" placeholder="{{ trans('lang.invoice_no') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="price">{{ trans('lang.price') }}</label>
                                        <input type="number" min="0" step="1" name="price"
                                            id="price" class="price form-control" value="0"
                                            readonly placeholder="{{ trans('lang.price') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 div_limit flex-column mb-3">
                                        <label for="license_ip">{{ trans('lang.license_ip') }}
                                            ({{ trans('lang.optional') }})</label>
                                        <input type="text" name="ip" id="license_ip" data-role="tagsinput"
                                            class="license_ip form-control tagsinput"
                                            placeholder="{{ trans('lang.license_ip') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6 div_limit flex-column mb-3">
                                        <label for="machine_id">{{ trans('lang.machine_id') }}
                                            ({{ trans('lang.optional') }})</label>
                                        <input type="text" name="machine_id" id="machine_id"
                                            class="machine_id form-control" placeholder="{{ trans('lang.machine_id') }}">
                                    </div>


                                    <div class="col-md-6 col-lg-6 mb-3">
                                        <label for="grace_end_days">
                                            <div class="position-relative">
                                                {{ trans('lang.grace_end_days') }} ({{ trans('lang.optional') }})
                                                <label role="button" data-toggle="tooltip" data-placement="right"
                                                    title="{{ __('tooltip.license_expiration_date') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle"
                                                            data-name="Icon awesome-question-circle"
                                                            d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                                            transform="translate(-0.563 -0.563)" fill="#43425d" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="number" name="grace_end_days" id="grace_end_days"
                                            class="grace_end_days form-control"
                                            placeholder="{{ trans('lang.grace_end_days') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="name">{{ trans('lang.comments') }}
                                            ({{ trans('lang.optional') }})</label>
                                        <textarea name="comments" id="comments" class="details form-control" cols="30" rows="5"
                                            placeholder="{{ trans('lang.comments') }}"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <input type="checkbox" class="block" id="block" name="block">
                                        <label for="block">
                                            {{ trans('lang.block_license') }}
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

    @include('admin.modals.products.search')
@stop


@section('js')
    <script>
        $('.datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: "yyyy-mm-dd",
            language: "ar",
            rtl: true,
            autoclose: true,
            todayHighlight: true,
            startDate: new Date()
        });

        $(".add_licenses_form").on("keypress", function(event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        $('.add_licenses_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            if ($('.block').is(':checked')) {
                formData.set('block', 1);
            } else {
                formData.set('block', 0);
            }

            var license_expiration_date = $('.license_expiration_date').val();
            var license_expiration_days = $('.license_expiration_days').val();
            formData.set('date', license_expiration_date);
            formData.set('days', license_expiration_days);

            $.ajax({
                url: "{{ route('admin.licenses.add') }}",
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
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                        location.replace("{{ route('admin.licenses.index') }}");
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
                error: function (response) {
                    $('#load').hide();
                }
            });
        })
    </script>
    <script>
        var data = {
            @foreach ($clients as $client)
                id: {{ $client->id }},
                name: {{ $client->name }},
            @endforeach
        }

        var newOption = new Option(data.id, data.name, false, false);
        $('.client_id').append(newOption).val(initial_creditor_id).trigger('change');
    </script>

    <script>
        $(".product_id").select2({
            // minimumInputLength: 2,
            ajax: {
                url: "{{ route('admin.products.select') }}",
                dataType: 'json',
                delay: 250,
                type: "get",
                data: function(term) {
                    return {
                        term: term.term
                    };
                },
                processResults: function(response) {
                    if (response) {
                        return {
                            results: response
                        };
                    }
                },
                cache: true
            }
        });

        $(".client_id").select2({
            // minimumInputLength: 2,
            ajax: {
                url: "{{ route('admin.clients.select') }}",
                dataType: 'json',
                delay: 250,
                type: "get",
                data: function(term) {
                    return {
                        term: term.term,
                        product_id: $('.product_id').val()
                    };
                },
                processResults: function(response) {
                    if (response) {
                        return {
                            results: response
                        };
                    }
                },
                cache: true
            }
        });


        $(document).on('change', '.license_type', function(e) {
            var id = $(this).val();
            $('.div_file').hide();
            $('.file').val('');
            $('.parallel_use_limit').val('');
            $('.license_ip').tagsinput('removeAll');
            $('.machine_id').val('');
            $('.use_limit').val('');
            $('.div_limit').hide();
            $('.license_expiration_date').attr('disabled', true);
            $('.license_expiration_days').attr('disabled', true);
            if (id == 1) {
                $('.div_limit').css('display', 'flex');
                $('.license_expiration_date').removeAttr('disabled');
            } else if (id == 2) {
                $('.div_file').show();
                $('.license_expiration_days').removeAttr('disabled');
            }
        });

        $(document).on('input', '.license_expiration_days', function(e) {
            var days = parseInt($(this).val());
            if (!days) {
                days = 0;
                $('.license_expiration_days').val(days);
            }
            var date = new Date();
            date.setDate(date.getDate() + days);
            var date = setDateFormat(date)
            $('.license_expiration_date').val(date);
        });

        $(document).on('change', '.license_expiration_date', function(e) {
            var todate = $(this).val();
            var fromdate = new Date();
            var diff = getDiffDate(fromdate, todate);
            $('.license_expiration_days').val(Math.round(diff));
        });
    </script>

    <script>
        $('#product_id').change(function() {
            $('#package_price_type').removeAttr("disabled")

            $('#package_price_type').empty();

            $('#package_price_type').append(`
                <option value="0">Select Price Type</option>
                <option value="1">Free</option>
                <option value="2">Paid</option>
            `)

            product_id = $(this).val();

            $('#add_package').empty();
            $('#add_package').append(`
                <a href="{{ url('admin/products/` + product_id + `/packages/create') }}" class="float-right">
                    Add Package
                </a>
            `)
        });

        $('#package_price_type').change(function() {
            $('#package_duration').removeAttr("disabled");

            $('#package_duration').empty();



            if ($(this).val() == 2) {
                $('#package_duration').append(`
                    <option value="0">Select Duration</option>
                    <option value="3">Anual</option>
                    <option value="2">Monthly</option>
                `)

            } else if ($(this).val() == 1) {

                $('#package_duration').append(`
                    <option value="0">Select Duration</option>
                    <option value="1">Days</option>
                `)


            }
        })

        // Ajax To Get Packages
        $('#package_duration').change(function() {
            $('#license_package').removeAttr("disabled");

            var product_id = $('#product_id').val(),
                price_type = $('#package_price_type').val(),
                duration = $('#package_duration').val();
            first_price = null;

            console.log(product_id + ' ' + price_type + ' ' + duration)

            $.ajax({
                url: "{{ route('admin.licenses.getPackage') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    id: product_id,
                    type: price_type,
                    duration: duration,
                },
                success: function(data) {
                    $('#license_package').empty();
                    $('#license_package').append(`
                        <option value="">Select From Here</option>
                    `);
                    $.each(data.packages, function(key, value) {
                        $('#license_package').append(`
                            <option value="` + value.id + `">` + value.name + `</option>
                        `);
                    });
                },
                error: function(data) {
                    console.log(data)
                },
            })
        })

        var to = null;

        var first_price = null;

        $('#license_package').change(function() {
            var package_id = $(this).val(),
                product_id = $('#product_id').val();

            $.ajax({
                url: "{{ route('admin.licenses.getDuration') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    package_id: package_id,
                    product_id: product_id,
                },
                success: function(data) {

                    // Set Price For Type_Price
                    $('#price').val(data.price.type_price);

                    // Set Global Var To Sum It With Seconde Price
                    first_price = data.first_price.type_price;

                    // Start Duration
                    $('#license_package_duration').empty();
                    if (data.duration.time) {
                        $('#license_package_duration').append(`
                            Duration Is : ` + data.duration.time + `
                        `);
                    } else if (data.duration.duration_days) {
                        $('#license_package_duration').empty();
                        $('#license_package_duration').append(`
                            Duration Is : ` + data.duration.duration_days + ` Days
                        `);
                    }
                    // End Duration

                    // Start Date With Days
                    $('#license_expiration_date').val(data.to);
                    var todate = $('#license_expiration_date').val();
                    var fromdate = new Date();
                    var diff = getDiffDate(fromdate, todate);
                    $('.license_expiration_days').val(Math.round(diff));
                    // End Date With Days

                    // Set Support Type With These Conditions
                    $('#support_type').prop('disabled', false);

                    if (data.first_price.support_type && data.first_price.prime_type) {
                        $('#support_type').html(`
                            <option value="0">Select From Here</option>
                            <option value="2">Remotely</option>
                            <option value="3">On Prime</option>
                        `)
                    } else if (!data.first_price.prime_type && data.first_price.support_type == 1 ||
                        data.first_price.support_type == 2) {
                        $('#support_type').html(`
                            <option value="0">Select From Here</option>
                            <option value="2">Remotely</option>
                        `)
                    } else if (!data.first_price.support_type && data.first_price.prime_type == 1 ||
                        data.first_price.prime_type == 2) {
                        $('#support_type').html(`
                            <option value="0">Select From Here</option>
                            <option value="3">On Prime</option>
                        `)
                    }
                    // Set Support Type With These Conditions

                },
                error: function(data) {

                },

            });


            $('#support_type').change(function() {
                var type = $(this).val(),
                    package_id = $('#license_package').val(),
                    product = $('#product_id').val();

                $.ajax({
                    url: "{{ route('admin.licenses.getTotalPrice') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        package_id: package_id,
                        product_id: product,
                        type: type,
                    },
                    success: function(data) {
                        if (data.type == 2 && data.second_price.support_price) {
                            second_price = data.second_price.support_price;
                        } else if (data.type == 3 && data.second_price.prime_price) {
                            second_price = data.second_price.prime_price;
                        } else {
                            second_price = 0;
                        }


                        total = parseInt(first_price) + parseInt(second_price);

                        $('#price').val(total);
                    },
                    error: function(data) {

                    },
                })
            })
        });
    </script>
    {{--
    <script>
        $('#product_id').change(function() {
            var product_id = $(this).val();

            $.ajax({
                url: "{{ route('admin.licenses.getPackage') }}",
                type: 'get',
                dataType: 'json',
                data: {
                    id: product_id,
                },
                success: function(data) {
                    $('#license_package').empty();
                    $.each(data.packages, function(key, value) {
                        $('#license_package').append(`
                            <option value="` + value.id + `">` + value.name + `</option>
                        `);
                    });
                },
                error: function(data) {
                    console.log(data)
                },
            })
        })
    </script> --}}
@stop
