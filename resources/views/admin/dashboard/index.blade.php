@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.home') }}
@stop
@section('css')
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/jqvmap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/assets/statistics/css/custom.css?v=1.0.2') }}">
    <link href="{{ asset('admin-assets/assets/app/plugins.bundle.css') }}" rel="stylesheet" />

    <style>
        #chartjs-tooltip tr td{
            background:#264653; border-color:#fff !important; border-width: 2px !important;color:#fff;
            padding:5px 10px;border-radius: 5px;
        }
        @media (min-width: 1400px) {
            .container {
                max-width: 1320px;
                padding: 0 15px
            }
        }

        .statistics-box {
            width: 100%;
        }

        .statistics-box-info {
            width: 100%
        }

        /* .statistics-box .content{
                padding: 0
               }
                        .profile-section .statistics-box-info {
                            border-radius: 15px;
                            width: 100%;
                        }*/

    </style>
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
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.statistics') }}</span>
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

        <div class="data-content main-page">
            <div class="row align-items-center">
                <div class="col-md-3 mb-md-0 mb-4">
                    <h5 class="font-weight-bold">{{ trans('lang.dashboard') }}</h5>
                </div>
                <form action="" id="report-form" method="POST" class="col-md-9" style="display: flex; justify-content: flex-end;">
                    @csrf

                    <div class="d-flex align-items-center justify-content-center" style="gap: 1rem">
                        <div class='input-group'>
                            <input class="form-control form-control-solid @error('date') is-invalid @enderror" placeholder="Date" value="" autocomplete="off" name="date" id="kt_daterangepicker_1"/>
                            <div class="input-group-append">
                                <span class="input-group-text px-2">
                                    <i class="la la-calendar-check-o"></i>
                                </span>
                            </div>
                        </div>
                        @error('date')
                        <span class="text-danger">
                            {{ $message }}
                        </span>
                        @enderror


                        <div class="d-flex gap-3" style="gap: 1rem">
                            <button type="button" data-route="{{ route('report.general') }}" id="general-report" class="btn btn-info">
                                {{ __('lang.general_report') }}
                            </button>

                            <button type="button" data-route="{{ route('report.detailed') }}" id="details-report" class="btn btn-outline-info">
                                {{ __('lang.detailed_report') }}
                            </button>
                        </div>
                    </div>

                </form>


                <div class="col-md-10 col-lg-10 mb-4">
                </div>
                <div class="col-md-2 col-lg-2 mb-4">
                </div>
            </div>

            @can('statistics')
                @include('admin.dashboard.statistics')
            @endcan

        </div>


    </div>
@stop
@section('js')
    <!-- JavaScript Libraries -->
    <script>
        var activeProductsCount = $('#activeProductsCount').data('value');
        var inActiveProductsCount = $('#inActiveProductsCount').data('value');

        var deActivation = $('#fail_Activation').data('value')
        var activations = $('#success_activations').data('value')

        var success_deactivations = $('#success_deactivations').data('value')
        var fail_deActivation = $('#fail_deActivation').data('value')

        var gdpData = {!! $countries !!}



        var clientsChart = {
            labels: {!! json_encode($clientsChart['dates']) !!},
            datasets: [{
                data: {!! json_encode($clientsChart['data']) !!},
                borderWidth: 1,
                borderColor: "#0058FF",
                backgroundColor: "#0058FF",
            }]
        }

        var LicenseChart = {
            labels: ['Jan', 'Feb', 'Mar', 'Mar', 'May', 'Jun'],
            datasets: [{
                data: [12, 19, 33, 25, 42, 23],
                borderWidth: 1,
                borderColor: "#EC6666",
                backgroundColor: "#EC6666",
            }, {
                data: [22, 9, 13, 10, 22, 41],
                borderWidth: 1,
                borderColor: "#147AD6",
                backgroundColor: "#147AD6",
            }, {
                data: [5, 9, 37, 15, 6, 14, 21],
                borderWidth: 1,
                borderColor: "#79D2DE",
                backgroundColor: "#79D2DE",
            }]
        }
    </script>



    <script>
        {{-- Disabled General Button When #report-select Change  --}}
        $('#report-select').change(function() {
            if($(this).val() != "Select From Here") {
                $('#general-report').attr('disabled', true);
            }else if ($(this).val() == "Select From Here") {
                $('#general-report').attr('disabled', false);
            }
        })

        {{-- Replace Action Route Based on the user's choice In #report-form --}}
        $('#general-report, #details-report').click(function (e){
            if(!$("#kt_daterangepicker_1").val()){
                swal.fire({
                    title: "",
                    text: "{{trans('lang.date_required')}}",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ __('lang.ok') }}",
                    cancelButtonText: "{{ __('lang.cancel') }}",
                    closeOnConfirm: true,
                    closeOnCancel: true
                });
                return false;
            }
            e.preventDefault();
            var route = $(this).attr('data-route');
            $('#report-form').attr('action', route).submit();
        })
    </script>

    <script src="{{ asset('admin-assets/assets/app/js/plugins.bundle.js') }}"></script>

    <script>
        $("#kt_daterangepicker_1").daterangepicker({
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD',
                    cancelLabel: 'Clear'
                },
            }
        );

        $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    </script>
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
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.countup.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.vmap.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/custom.js?v=1.0.3') }}"></script>
    <script src="{{ asset('admin-assets/assets/statistics/js/statistics_ajax-dashboard.js') }}"></script>

    <script>
        $(document).ready(function(e){
            getActivationsChardData();
            getDownloadHistory();
            getNotificationHistory();
            getApiActivity();
            getProductLicenses();
            // getActivationActivity();
        });
    </script>
    <script>
        const ctx_1_3 = document.getElementById('chart-1-3').getContext('2d');

        console.log( {!! json_encode($income_array) !!} )

        var chart_1_3 = new Chart(ctx_1_3, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: {!! json_encode($income_array) !!}
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    //   display: false,
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                },
                x: {
                    grid: {
                        display: false
                    },
                }
            }
        },
    });
    </script>
    <script>
        var chart_2_2;
        const ctx_2_2 = document.getElementById('chart-2-2').getContext('2d');
        chart_2_2 = new Chart(ctx_2_2, {
            type: 'bar',
            data: {
                labels:  ['Jan', 'Feb', 'Mar', 'Apr', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
                datasets: [{
                    maxBarThickness: 6,
                    //   label: '# of Votes',
                    data: {!! json_encode($clients_array) !!},
                    borderWidth: 0,
                    borderRadius: 50,
                    backgroundColor: "#9BABFE",
                }]
            },
            options: {
                responsive: true,
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
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            },
        });


        $(document).on('change','#select-chart-2-2',function(e){
            chart_2_2.destroy();
            getActiveClients();
        });


        function getActiveClients(){
            var duration = $('#select-chart-2-2').val();
            $.ajax({
                    url: "{{route('admin.dashboard.active-clients')}}",
                    type: "get",
                    dataType: "JSON",
                    data: {
                        duration:duration
                    },
                    success: function(data){
                        if(data['status'] == true){
                            const ctx_2_2_ch = document.getElementById('chart-2-2').getContext('2d');
                            chart_2_2 = new Chart(ctx_2_2_ch, {
                                type: 'bar',
                                data: {
                                    labels:  data['month'],
                                    datasets: [{
                                        maxBarThickness: 6,
                                        label:'',
                                        data: data['data'],
                                        borderWidth: 0,
                                        borderRadius: 50,
                                        backgroundColor: "#9BABFE",
                                    }]
                                },
                                options: {
                                    responsive: true,
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
                                            }
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            }
                                        }
                                    }
                                },
                            });

                        }else{
                            swal({
                                    title: "",
                                    text: data["data"],
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('lang.ok')}}",
                                    cancelButtonText: "{{trans('lang.cancel')}}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                        }
                    },
                });
        }

    </script>
    <script>
        var chart_4_2;
        $(document).on('change','#activation_select_chart',function(e){
            chart_4_2.destroy();
            getActivationsChardData();
        });

        function getActivationsChardData(){
            var duration = $('#activation_select_chart').val();
            $.ajax({
                    url: "{{route('admin.dashboard.activation-chart')}}",
                    type: "get",
                    dataType: "JSON",
                    data: {
                        duration:duration
                    },
                    success: function(data){
                        if(data['status'] == true){
                            const ctx_4_2 = document.getElementById('chart-4-2').getContext('2d');
                            chart_4_2 = new Chart(ctx_4_2, {
                            type: 'bar',
                            data: {
                                labels: data['month'],
                                datasets: [{
                                    maxBarThickness: 6,
                                    //   label: '# of Votes',
                                    data: data['data'],
                                    borderWidth: 0,
                                    borderRadius: 50,
                                    backgroundColor: "#9BABFE",
                                }]
                            },
                            options: {
                                responsive: true,
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
                                        }
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    }
                                }
                            },
                        });
                        }else{
                            swal({
                                    title: "",
                                    text: data["data"],
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('lang.ok')}}",
                                    cancelButtonText: "{{trans('lang.cancel')}}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                        }
                    },
                });
        }

    </script>
    <script>
        const ctx_5_1 = document.getElementById('chart-5-1').getContext('2d');

        var dataset_chart_5_1;

        console.log( {!! json_encode($update_download_array) !!} )

        if ( {!! json_encode($update_download_array[0]) !!} === 0 && {!! json_encode($update_download_array[1]) !!} === 0 ) {
            dataset_chart_5_1 = [{
                label: 'Products',
                data: ["100"],
                backgroundColor: "#f1f1f1",
                borderRadius: 50,
                hoverOffset: 4
            }];
        } else {
            dataset_chart_5_1 = [{
                label: 'Products',
                data: {!! json_encode($update_download_array) !!},
                backgroundColor: ['#147AD6', '#EC6666'],
                borderRadius: 50,
                hoverOffset: 4
            }];
        }

        const chart_5_1 = new Chart(ctx_5_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Success',
                    'Faild',
                ],
                datasets: dataset_chart_5_1,
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
                    x: {
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
        var chart_5_2;
        $(document).on('change','#download_history_chart',function(e){
            chart_5_2.destroy();
            getDownloadHistory();
        });
        function getDownloadHistory(){
            var duration = $('#download_history_chart').val();
            $.ajax({
                    url: "{{route('admin.dashboard.download-history')}}",
                    type: "get",
                    dataType: "JSON",
                    data: {
                        duration:duration
                    },
                    success: function(data){
                        if(data['status'] == true){

                            const ctx_5_2 = document.getElementById('chart-5-2').getContext('2d');
                            chart_5_2 = new Chart(ctx_5_2, {
                                type: 'line',
                                data: {
                                    labels: data['month'],
                                    datasets: data['data']
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    scales: {
                                        y: {
                                            //   display: false,
                                            beginAtZero: true,
                                            grid: {
                                                display: false
                                            },
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            },
                                        }
                                    }
                                },
                            });



                        }else{
                            swal({
                                    title: "",
                                    text: data["data"],
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('lang.ok')}}",
                                    cancelButtonText: "{{trans('lang.cancel')}}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                        }
                    },
                });
        }
    </script>
    <script>


        const ctx_7_1 = document.getElementById('chart-7-1').getContext('2d');

        var dataset_chart_7_1;

        if ( {{ $notificationsCount }} === 0 && {{ $todayNotificationsCount }} === 0 ) {
            dataset_chart_7_1 = [{
                label: 'Products',
                data: ["100"],
                backgroundColor: "#f1f1f1",
                borderRadius: 50,
                hoverOffset: 4
            }];
        } else {
            dataset_chart_7_1 = [{
                label: 'Products',
                data: [{{$notificationsCount}},{{ $todayNotificationsCount }}],
                backgroundColor: ['#147AD6', '#EC6666'],
                borderRadius: 50,
                hoverOffset: 4
            }];
        }

        const chart_7_1 = new Chart(ctx_7_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Total',
                    'Today',
                ],
                datasets: dataset_chart_7_1,
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
                    x: {
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
        var chart_7_2;
        $(document).on('change','#notification_history_chart',function(e){
            getNotificationHistory();
            chart_7_2.destroy();
        });
        function getNotificationHistory(){
            var duration = $('#notification_history_chart').val();
            $.ajax({
                    url: "{{route('admin.dashboard.notification-history')}}",
                    type: "get",
                    dataType: "JSON",
                    data: {
                        duration:duration
                    },
                    success: function(data){
                        if(data['status'] == true){
                            const ctx_7_2 = document.getElementById('chart-7-2').getContext('2d');
                             chart_7_2 = new Chart(ctx_7_2, {
                                type: 'line',
                                data: {
                                    labels: data['month'],
                                    datasets: [{
                                        data: data['data'],
                                        borderWidth: 1,
                                        borderColor: "#147AD6",
                                        backgroundColor: "#147AD6",
                                        lineTension: .35,
                                        radius: 0
                                    }]
                                },
                                options: {
                                    plugins: {
                                        legend: {
                                            display: false
                                        }
                                    },
                                    scales: {
                                        y: {
                                            //   display: false,
                                            beginAtZero: true,
                                            grid: {
                                                display: false
                                            },
                                        },
                                        x: {
                                            grid: {
                                                display: false
                                            },
                                        }
                                    }
                                },
                            });
                        }else{
                            swal({
                                    title: "",
                                    text: data["data"],
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('lang.ok')}}",
                                    cancelButtonText: "{{trans('lang.cancel')}}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                        }
                    },
                });
        }

    </script>
    <script>
        const ctx_6_1 = document.getElementById('chart-6-1').getContext('2d');

        var dataset_chart_6_1;

        if ( {{ $api_call_all_success }} === 0 && {{ $api_call_all_faild }} === 0) {
            dataset_chart_6_1 = [{
                label: 'Products',
                data: ["100"],
                backgroundColor: "#f1f1f1",
                borderRadius: 50,
                hoverOffset: 4
            }];
        } else {
            dataset_chart_6_1 = [{
                label: 'Products',
                data: [{{ $api_call_all_success }},{{ $api_call_all_faild }}],
                backgroundColor: ['#147AD6','#EC6666'],
                borderRadius: 50,
                hoverOffset: 4
            }];
        }

        const chart_6_1 = new Chart(ctx_6_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Success',
                    'Faild',
                ],
                datasets: dataset_chart_6_1,
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
                    x: {
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

        // var chart_4_3;
        // $(document).on('change','#activation_select',function(e){
        //     chart_4_3.destroy();
        //     getActivationActivity();
        // });

    //    function getActivationActivity(){
    //         var duration = $('#activation_select').val();
    //         $.ajax({
    //             url: "{{route('admin.dashboard.activation-activity')}}",
    //             type: "get",
    //             dataType: "JSON",
    //             data: {
    //                 duration:duration
    //             },
    //             success: function(data){
    //                 if(data['status'] == true){
    //                     const ctx_4_3 = document.getElementById('chart-4-3');
    //                     gradient6_2 = ctx_4_3.getContext('2d').createLinearGradient(0, 0, 0, 270);
    //                     gradient6_2.addColorStop(0, 'rgba(163, 161, 251, .85)');
    //                     gradient6_2.addColorStop(1, 'rgba(163, 161, 251, 0.01)');

    //                     chart_4_3 = new Chart(ctx_4_3, {
    //                         type: 'line',
    //                         data: {
    //                             labels: data['month'],
    //                             datasets: [{
    //                                 data: data['data'],
    //                                 fill: true,
    //                                 backgroundColor: gradient6_2,
    //                                 borderWidth: 3,
    //                                 borderColor: "#A3A1FB",
    //                                 lineTension: .35,
    //                                 radius: 0
    //                             }]
    //                         },
    //                         options: {
    //                             elements: {
    //                                 line: {
    //                                     tension: 0
    //                                 }
    //                             },
    //                             responsive: true,
    //                             plugins: {
    //                                 legend: {
    //                                     display: false
    //                                 }
    //                             },
    //                             scales: {
    //                                 y: {
    //                                     //    display: false,
    //                                     beginAtZero: true,
    //                                     grid: {
    //                                         display: false
    //                                     },
    //                                 },
    //                                 x: {
    //                                     grid: {
    //                                         display: false
    //                                     },
    //                                 }
    //                             },
    //                         }
    //                     });

    //                 }else{
    //                     swal({
    //                             title: "",
    //                             text: data["data"],
    //                             type: "error",
    //                             showCancelButton: false,
    //                             confirmButtonColor: "#DD6B55",
    //                             confirmButtonText: "{{trans('lang.ok')}}",
    //                             cancelButtonText: "{{trans('lang.cancel')}}",
    //                             closeOnConfirm: true,
    //                             closeOnCancel: true
    //                         });
    //                 }
    //             },
    //         });
    //     }
    </script>
    <script>
        var chart_6_2;
        $(document).on('change','#api_activity_chart',function(e){
            chart_6_2.destroy();
            getApiActivity();
        });

        function getApiActivity(){
            var duration = $('#api_activity_chart').val();
            $.ajax({
                url: "{{route('admin.dashboard.api-activity')}}",
                type: "get",
                dataType: "JSON",
                data: {
                    duration:duration
                },
                success: function(data){
                    if(data['status'] == true){
                        const ctx_6_2 = document.getElementById('chart-6-2');
                        gradient6_2 = ctx_6_2.getContext('2d').createLinearGradient(0, 0, 0, 270);
                        gradient6_2.addColorStop(0, 'rgba(163, 161, 251, .85)');
                        gradient6_2.addColorStop(1, 'rgba(163, 161, 251, 0.01)');

                        chart_6_2 = new Chart(ctx_6_2, {
                            type: 'line',
                            data: {
                                labels: data['month'],
                                datasets: [{
                                    data: data['data'],
                                    fill: true,
                                    backgroundColor: gradient6_2,
                                    borderWidth: 3,
                                    borderColor: "#A3A1FB",
                                    lineTension: .35,
                                    radius: 0
                                }]
                            },
                            options: {
                                elements: {
                                    line: {
                                        tension: 0
                                    }
                                },
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        //    display: false,
                                        beginAtZero: true,
                                        grid: {
                                            display: false
                                        },
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                    }
                                },
                            }
                        });

                    }else{
                        swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{trans('lang.ok')}}",
                                cancelButtonText: "{{trans('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                    }
                },
            });
        }

    </script>
    <script>

        // var chart_1_3;
        $(document).on('change','#select-chart-1-3,#chart-1-3_product-id',function(e){
            chart_1_3.destroy();
            getTotalIncome();
        });

        function getTotalIncome(){
            var duration = $('#select-chart-1-3').val();
            var product_id = $('#chart-1-3_product-id').val();
            $.ajax({
                url: "{{route('admin.dashboard.product-licenses')}}",
                type: "get",
                dataType: "JSON",
                data: {
                    duration:duration,product_id:product_id
                },
                success: function(data){
                    if(data['status'] == true){
                        const ctx_1_3_2 = document.getElementById('chart-1-3').getContext('2d');
                        chart_1_3 = new Chart(ctx_1_3_2, {
                            type: 'line',
                            data: {
                                labels: data['month'],
                                datasets: data['data']
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        //   display: false,
                                        beginAtZero: true,
                                        grid: {
                                            display: false
                                        },
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                    }
                                }
                            },
                        });

                        var html = '';
                        if(data['products']){
                            jQuery.each(data['products'], function(index, item) {
                                html += `<div class="chart-info-box  mr-3 mr-3">
                                            <span class="dot" style="background-color: `+item['color']+`"></span>
                                            <span>`+item['name']+`</span>
                                        </div>`;
                            });
                            $('.statistics-total-income-info').html(html);
                        }
                    }else{
                        swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{trans('lang.ok')}}",
                                cancelButtonText: "{{trans('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                    }
                },
            });
        }

        var chart_3_2;
        $(document).on('change','#select-chart-3-2,#chart-3-2_product-id',function(e){
            chart_3_2.destroy();
            getProductLicenses();
        });

        function getProductLicenses(){
            var duration = $('#select-chart-3-2').val();
            var product_id = $('#chart-3-2_product-id').val();
            $.ajax({
                url: "{{route('admin.dashboard.product-licenses')}}",
                type: "get",
                dataType: "JSON",
                data: {
                    duration:duration,product_id:product_id
                },
                success: function(data){
                    if(data['status'] == true){
                        const ctx_3_2 = document.getElementById('chart-3-2').getContext('2d');
                        chart_3_2 = new Chart(ctx_3_2, {
                            type: 'line',
                            data: {
                                labels: data['month'],
                                datasets: data['data']
                            },
                            options: {
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                },
                                scales: {
                                    y: {
                                        //   display: false,
                                        beginAtZero: true,
                                        grid: {
                                            display: false
                                        },
                                    },
                                    x: {
                                        grid: {
                                            display: false
                                        },
                                    }
                                }
                            },
                        });

                        var html = '';
                        if(data['products']){
                            jQuery.each(data['products'], function(index, item) {
                                html += `<div class="chart-info-box  mr-3">
                                            <span class="dot" style="background-color: `+item['color']+`"></span>
                                            <span >`+item['name']+`</span>
                                        </div>`;
                            });
                            $('.statistics-product-info').html(html);
                        }
                    }else{
                        swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{trans('lang.ok')}}",
                                cancelButtonText: "{{trans('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                    }
                },
            });
        }


    </script>
     <script>
         jQuery(document).ready(function () {
            var gdpData = {!! json_encode($data['country_stat']) !!};
            $('#vmap').vectorMap({
                map: 'world_en',
                enableZoom: true,
                showTooltip: true,
                borderOpacity: 0.01,
                borderWidth: 2,
                borderColor: '#000',
                color: '#cecdcd',
                colors:{!! json_encode($data['country_color']) !!},
                selectedColor: '#f46b49',
                series: {
                    regions: [{
                        values: gdpData,
                        scale: ['#C8EEFF', '#0071A4'],
                        normalizeFunction: 'polynomial'
                    }]
                },
                /*
                onRegionClick: function(element, code, region) {
                    var message = 'You clicked "'
                        + region
                        + '" which has the code: '
                        + code.toUpperCase();

                    alert(message);
                },

                code.toUpperCase()
                */
                onLabelShow: function (event, label, code) {
                    code = code.toUpperCase()
                    var clients = gdpData[code];
                    if(!clients){
                        clients = 0;
                    }
                    var percentage = (gdpData[code]/"{{count($clients)}}")*100;
                    if(!percentage){
                        percentage = 0;
                    }
                    var html_box = '\
                        <div class="map-tooltip">\
                            <h2 class="header">'+ label.text() + " - " + code + '</h2>\
                            <div class="content">\
                                <p class="users"> <i class="fa fa-user"></i> '+ clients + '</p>\
                                <p class="percent"> ' + percentage.toFixed(2) + '% </p>\
                            </div>\
                        </div>';
                    label.html(html_box);
                }
            });
        });

     </script>
     <script>
         const ctx_3_1 = document.getElementById('chart-3-1').getContext('2d');

         var dataset_chart_3_1;

         if ( {{ $licenses->where('usage',1)->where('date','>=',date('Y-m-d'))->count() }} === 0 && {{ $licenses->where('usage',0)->where('date','>=',date('Y-m-d'))->count() }} === 0 && {{ $licenses->where('date','<',date('Y-m-d'))->count() }} === 0) {
             dataset_chart_3_1 = [{
                 label: 'Licenses',
                 data: ["100"],
                 backgroundColor: "#f1f1f1",
                 borderRadius: 50,
                 hoverOffset: 4
             }];
         } else {
             dataset_chart_3_1 = [{
                 label: 'Licenses',
                 data: [{{ $licenses->where('usage',1)->where('date','>=',date('Y-m-d'))->count() }}, {{ $licenses->where('usage',0)->where('date','>=',date('Y-m-d'))->count() }}, {{ $licenses->where('date','<',date('Y-m-d'))->count() }}],
                 backgroundColor: ['rgb(121, 210, 222)', 'rgb(121, 210, 222, .3)','rgb(255, 184, 34, .5)'],
                 borderRadius: 50,
                 hoverOffset: 4
             }];
         }

         const chart_3_1 = new Chart(ctx_3_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Active',
                    'Inactive',
                    'Expired ',
                ],
                datasets: dataset_chart_3_1
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
                    x: {
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
         const ctx_2_1 = document.getElementById('chart-2-1').getContext('2d');

         var dataset_chart_2;

         console.log( {{$clients->where('status', 1)->count() }} )
         if ( {{ $clients->where('status' , 1)->count() }} === 0 && {{ $clients->where('status' , 0)->count()}} === 0 ){
             dataset_chart_2 = [{
                 label: 'Products',
                 data: ["100"],
                 backgroundColor: "#f1f1f1",
                 borderRadius: 50,
                 hoverOffset: 4
             }];
         } else {
             dataset_chart_2 = [{
                 label: 'Products',
                 data: ["{{ $clients->where('status' , 1)->count() }}", "{{ $clients->where('status' , 0)->count() }}"],
                 backgroundColor: ['rgb(121, 210, 222)', 'rgb(121, 210, 222, .3)'],
                 borderRadius: 50,
                 hoverOffset: 4
             }];
         }


         const chart_2_1 = new Chart(ctx_2_1, {
            type: 'doughnut',
            data: {
                labels: [
                    'Active',
                    'Inactive',
                ],
                datasets: dataset_chart_2,
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
                    x: {
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
        $(document).on('change','#top_api_select',function(e){
            getTopApiCall();
        });

        function getTopApiCall(){
            var duration = $('#top_api_select').val();
            $.ajax({
                url: "{{route('admin.dashboard.top-apicall')}}",
                type: "get",
                dataType: "JSON",
                data: {
                    duration:duration
                },
                success: function(data){
                    if(data['status'] == true){

                        $('.table-api-call').html(data.data);
                    }else{
                        swal({
                                title: "",
                                text: data["data"],
                                type: "error",
                                showCancelButton: false,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "{{trans('lang.ok')}}",
                                cancelButtonText: "{{trans('lang.cancel')}}",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            });
                    }
                },
            });
        }

     </script>
     @php
        $prod_array = array();
        $prod_color = array();
        $prod_number = array();
        if($licenses_product){
            foreach($licenses_product as $li){
                if($li->product){
                    $prod_array[] = $li->product->name;
                    $prod_color[] = $li->product->color;
                    $prod_number[] = $li->cnt;
                }
            }
        }

     @endphp

     <script>

        const ctx_1_2 = document.getElementById('chart-1-2').getContext('2d');

        var dataset_chart_2_1;

        if ( {!! json_encode($prod_number) !!}.length === 0 ) {
            dataset_chart_2_1 = [{
                label: 'Products',
                data: "100",
                backgroundColor: "#f1f1f1",
                borderRadius: 50,
                hoverOffset: 4
            }];
        } else {
            dataset_chart_2_1 = [{
                label: 'Products',
                data: {!! json_encode($prod_number) !!},
                backgroundColor: {!! json_encode($prod_color) !!},
                borderRadius: 50,
                hoverOffset: 4
            }];
        }

        const chart_1_2 = new Chart(ctx_1_2, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($prod_array) !!},
                datasets: dataset_chart_2_1
            },
            options: {
                cutout: "90%",
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        enabled: false,
                        external:  function(context) {
                    // Tooltip Element
                    let tooltipEl = document.getElementById('chartjs-tooltip');

                    // Create element on first render
                    if (!tooltipEl) {
                        tooltipEl = document.createElement('div');
                        tooltipEl.id = 'chartjs-tooltip';
                        tooltipEl.innerHTML = '<table></table>';
                        document.body.appendChild(tooltipEl);
                    }

                    // Hide if no tooltip
                    const tooltipModel = context.tooltip;
                    if (tooltipModel.opacity === 0) {
                        tooltipEl.style.opacity = 0;
                        return;
                    }

                    // Set caret Position
                    tooltipEl.classList.remove('above', 'below', 'no-transform');
                    if (tooltipModel.yAlign) {
                        tooltipEl.classList.add(tooltipModel.yAlign);
                    } else {
                        tooltipEl.classList.add('no-transform');
                    }

                    function getBody(bodyItem) {
                        return bodyItem.lines;
                    }

                    // Set Text
                    if (tooltipModel.body) {
                        const titleLines = tooltipModel.title || [];
                        const bodyLines = tooltipModel.body.map(getBody);

                        let innerHtml = '<thead>';

                        titleLines.forEach(function(title) {
                            innerHtml += '<tr><th>' + title + '</th></tr>';
                        });
                        innerHtml += '</thead><tbody>';

                        bodyLines.forEach(function(body, i) {
                            const colors = tooltipModel.labelColors[i];
                            let style = 'background:' + colors.backgroundColor;
                            style += '; border-color:' + colors.borderColor;
                            style += '; border-width: 2px';
                            const span = '<span style="' + style + '"></span>';
                            innerHtml += '<tr><td>' + span + body + '</td></tr>';
                        });
                        innerHtml += '</tbody>';

                        let tableRoot = tooltipEl.querySelector('table');
                        tableRoot.innerHTML = innerHtml;
                    }

                    const position = context.chart.canvas.getBoundingClientRect();
                    const bodyFont = Chart.helpers.toFont(tooltipModel.options.bodyFont);

                    // Display, position, and set styles for font
                    tooltipEl.style.opacity = 1;
                    tooltipEl.style.position = 'absolute';
                    tooltipEl.style.left = position.left + window.pageXOffset + tooltipModel.caretX + 'px';
                    tooltipEl.style.top = position.top + window.pageYOffset + tooltipModel.caretY + 'px';
                    tooltipEl.style.font = bodyFont.string;
                    tooltipEl.style.padding = tooltipModel.padding + 'px ' + tooltipModel.padding + 'px';
                    tooltipEl.style.pointerEvents = 'none';
                }
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
                    x: {
                        display: false,
                        grid: {
                            display: false
                        },
                    }
                }
            },
        });
     </script>

@stop
