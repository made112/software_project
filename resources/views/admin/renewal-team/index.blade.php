@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.renewal-team') }}
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
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.renewal-team') }}</span>
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
            <div class="row ">
                <div class="col-md-12 mb-4">
                    <h5 class="font-weight-bold float-left">{{ trans('lang.renewal-team') }}</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-10 col-lg-10 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="license_code reset-filter form-control" name="license_code"
                                autocomplete="off" placeholder="{{ trans('lang.license_code') }}">
                        </div>
                        <div class="col-md-3 col-lg-3">
                            <select name="client_id" id="client_id" class="client_id reset-filter form-control">
                            </select>
                        </div>

                        <div class="col-md-3 col-lg-3">
                            <select name="product_id" id="product_id" class="product_id reset-filter form-control">
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" class="from form-control date-picker reset-filter" name="from"
                                autocomplete="off" placeholder="{{ trans('lang.from') }}" readonly>
                        </div>
                        <div class="col-md-3 mt-3">
                            <input type="text" class="to form-control date-picker reset-filter" name="to"
                                autocomplete="off" placeholder="{{ trans('lang.to') }}" readonly>
                        </div>
                        <div class="col-md-3 mt-3">
                            <select class="license_type form-control reset-filter" style="color: #999" id="license_type">
                                <option value="">{{ trans('lang.license_type') }}</option>
                                <option value="1">{{ trans('lang.online') }}</option>
                                <option value="2">{{ trans('lang.offline') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <select class="block form-control reset-filter" style="color: #999" id="block">
                                <option value="">{{ trans('lang.block_status') }}</option>
                                <option value="1">{{ trans('lang.blocked') }}</option>
                                <option value="0">{{ trans('lang.unblocked') }}</option>
                            </select>
                        </div>
                        <div class="col-md-3 mt-3">
                            <select name="status" id="status" style="color: #999"
                                class="status form-control reset-filter">
                                <option value="">{{ trans('lang.status') }}</option>
                                <option value="0">{{ trans('lang.inactive') }}</option>
                                <option value="1">{{ trans('lang.active') }}</option>
                                <option value="2">{{ trans('lang.expired') }}</option>
                            </select>
                        </div>
                        <div class="col-md-2 mt-3 align-self-center mb-4">
                            <button type="button" class="btn btn-md reset btn-info">{{ trans('lang.reset') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 mb-4 text-right">

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="table-container" id="table-container">
                        @include('admin.renewal-team.table-data')
                    </div>
                </div>
            </div>
        </div>


    </div>


@stop


@section('js')
    <script>
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
        });

        function getData(url) {
            status = $('.status').val();
            client_id = $('.client_id').val();
            product_id = $('.product_id').val();
            license_code = $('.license_code').val();
            from = $('.from').val();
            to = $('.to').val();
            license_type = $('.license_type').val();
            block = $('.block').val();
            $.ajax({
                url: url,
                data: {
                    usage: status,
                    license_code: license_code,
                    client_id: client_id,
                    product_id: product_id,
                    from: from,
                    to: to,
                    type: license_type,
                    block: block
                }
            }).done(function(data) {
                $("#table-container").empty().html(data);
            });
        }

        $(document).on('change', '.status,.product_id,.client_id', function(e) {
            var url = $(this).attr('href');
            getData(url);
        });

        $(document).on('change', '.from,.to', function(e) {
            var url = $(this).attr('href');
            getData(url);
        });

        $(document).on('click', '.reset', function(e) {
            e.preventDefault();
            $('.reset-filter').val('');
            $('.client_id,.product_id').val('').trigger('change');
            var url = $(this).attr('href');
            getData(url);
        });

        $(document).on('change', '.license_type,.block', function(e) {
            var url = $(this).attr('href');
            getData(url);
        });

        $(document).on('input', '.license_code', function(e) {
            var license_code = $(this).val();
            if (license_code == '' || license_code.length >= 3) {
                var url = $(this).attr('href');
                getData(url);
            }
        });
    </script>
    <script>
        $(".product_id").select2({
            minimumInputLength: 2,
            allowClear: true,
            placeholder: "{{ trans('lang.products') }}",
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
            minimumInputLength: 2,
            allowClear: true,
            placeholder: "{{ trans('lang.company') }}",
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
    </script>
@stop