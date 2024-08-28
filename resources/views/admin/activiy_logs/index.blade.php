@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.activity_logs') }}
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
                                            <span
                                                class="m-nav__link-text text-dark">{{ trans('lang.activity_logs') }}</span>
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
                    <h5 class="font-weight-bold">{{ trans('lang.activity_logs') }}</h5>
                </div>
                <div class="col-md-10 col-lg-10 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="name form-control" name="name" id="description-filter"
                                autocomplete="off" placeholder="{{ trans('lang.name') }}">
                        </div>
                        @can('delete_activity_log')
                            <div class="col-md-2 algin-self-center">
                                <button type="button" class="btn btn-danger delete-multiple delete-activities d-none">{{ __('lang.delete') }}</button>
                                <button type="button" id="delete-all" class="btn btn-danger d-none">{{ __('lang.delete_all') }}</button>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="table-container" id="table-container">
                        @include('admin.activiy_logs.table')
                    </div>
                </div>
            </div>
        </div>


    </div>


@stop

@section('js')
    <script>

    $(document).on('click', '.pagination a',function(event)
        {
            event.preventDefault();
            $('li').removeClass('active');
            $(this).parent('li').addClass('active');
            var url = $(this).attr('href');
            getData(url);
        });

    function getData(url) {
        description = $('#description-filter').val();
        $.ajax({
            url : url,
            data:{name:description}
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }

        function deleteActivities() {
            Swal.fire({
                title:'',
                text: "{{ __('lang.are_you_sure') }}",
                type: "warning",
                confirmButtonText: "{{ __('lang.yes') }}",
                cancelButtonText: "{{ __('lang.cancel') }}",
                showCancelButton: true,
            }).then(function(result) {

                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $('#load').show();

                    $.ajax({
                        url: "{{ route('admin.activity_logs.delete') }}",
                        type: "DELETE",
                        dataType: "JSON",
                        data: {
                            activities: activities,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(response) {
                            $('#load').hide();
                            var url = $(this).attr('href');
                            getData(url);

                            if (response.status == true) {
                                swal({
                                    title: "",
                                    text: response["data"],
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{ __('lang.ok') }}",
                                    cancelButtonText: "{{ __('lang.cancel') }}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                                $('.delete-activities').addClass('d-none');
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
                            var url = $(this).attr('href');
                            getData(url);
                        },
                    })
                }
            });
        }
        $('.delete-activities').on('click', function() {
            deleteActivities()
        })

        $('#delete-all').on('click', function() {
            deleteActivities()
        })
        var timer
        $('#description-filter').on('input', function() {
            var url = $(this).attr('href');
            getData(url);
        })


    </script>
@stop
