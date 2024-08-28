@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.packages') }}
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
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.packages') }}</span>
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
                    <h5 class="font-weight-bold">{{ trans('lang.manage') . ' ' . __('lang.packages') }}</h5>
                </div>
                <div class="col-md-10 col-lg-10 mb-4">
                    <div class="fillter-box">
                        <div>
                            <input type="text" class="name form-control reset-filter" name="name" id="name" autocomplete="off" placeholder="{{trans('lang.name')}}">
                        </div>

                        <div>
                            <select name="status" id="status" class="status form-control reset-filter" style="color: #999da6">
                                <option value="">{{trans('lang.status')}}</option>
                                <option value="1">{{trans('lang.active')}}</option>
                                <option value="0">{{trans('lang.inactive')}}</option>
                            </select>
                        </div>

                        <div class="col-md-2 align-self-center">
                            <button type="button" class="btn btn-md reset btn-info">{{trans('lang.reset')}}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 mb-4">
                    @can('add_packages')
                    <a href="{{ route('admin.products.packages.create', ['product' => $product->id]) }}" class="btn btn-dark float-right">
                        <i class="fa fa-plus"></i>
                        {{ __('lang.add_package') }}
                    </a>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="table-container" id="table-container">
                        @include('admin.products.packages.table')
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        function getData(url) {
            var name = $('#name').val();
            var status = $('.status').val();

            $.ajax({
                url: url,
                data: {
                    name: name,
                    status: status,
                }
            }).done(function(data) {
                $("#table-container").empty().html(data);
            });
        }

        $(document).on('input', '.name', function(e) {
            var name = $(this).val();
            if (name == '' || name.length >= 3) {
                var url = $(this).attr('href');
                getData(url);
            }
        });

        $(document).on('change','.status',function(e){
            var url = $(this).attr('href');
            getData(url);
        });

        $('.reset').click(function() {
            $('.status').val('');
            $('.name').val('');

            var url = $(this).attr('href');
            getData(url);

        });

        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
        });

        $(document).on('click', '.package_status', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#load').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.products.packages.update-status', ['product' => $product->id]) }}",
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
                    var element = $('.package_status[data-id="' + data.package.id + '"]')

                    if (data.package.status) {
                        element.removeClass('btn-danger')
                        element.addClass('btn-success')

                        element.html("<span> {{ __('lang.active') }} </span>")
                    } else {
                        element.removeClass('btn-success')
                        element.addClass('btn-danger')

                        element.html("<span> {{ __('lang.inactive') }} </span>")
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
                        confirmButtonText: "{{ trans('lang.ok') }}",
                        cancelButtonText: "{{ trans('lang.cancel') }}",
                    });
                }
            });
        });

        $('.delete-package').on('click', function() {
            event.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var tableRow = $(".package-" + id)
            $('#load').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: "DELETE",
                dataType: "JSON",
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
                        tableRow.remove()
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

                },
                error: function(data) {
                    $('#load').hide();
                    swal({
                        title: "",
                        text: "{{ __('lang.error') }}",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ trans('lang.ok') }}",
                        cancelButtonText: "{{ trans('lang.cancel') }}",
                    });
                }
            });
        })
    </script>

@stop
