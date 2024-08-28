@extends('admin.layout.master_layout')
@section('title')
    {{trans('lang.groups')}}
@stop
@section('css')
    <style>
        .m-checkbox.m-checkbox--brand.m-checkbox--solid>span:after {
            transform: rotate(45deg);
        }
    </style>
@endsection

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
                                            <span class="m-nav__link-text text-dark" style="font-weight:bold">{{trans('lang.dashboard')}}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{trans('lang.status')}}</span>
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
                    <h5 class="font-weight-bold float-left">{{trans('lang.manage_status')}}</h5>
                    <div class="clearfix"></div>
                </div>
                <div class="col-md-10 col-lg-10 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" class="name_filter reset-filter user_name_seach form-control" name="name" autocomplete="off" placeholder="{{trans('lang.name')}}">
                        </div>

                        <div class="col-md-2 align-self-center">
                            <button type="button" class="btn btn-md reset btn-info">{{trans('lang.reset')}}</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-lg-2 mb-4 text-right">

                    <button type="button"  class="btn btn-black text-white m-btn m-btn--custom btnAddGroup" style="line-height: 15px;
                padding-bottom: 15px;">
                        <i class="fa fa-plus"></i>
                        {{trans('lang.add_status')}}
                    </button>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="table-container" id="table-container">
                        @include('admin.status.table-data')
                    </div>
                </div>
            </div>
        </div>

        @include('admin.status.sub.add')
    </div>

@stop


@section('js')

    <script>
        $('#role').select2();
    </script>
    <script type="text/javascript">

        function getData(url,name) {
            $('#load').show();
            name_filter = $('.name_filter').val();
            $.ajax({
                url : url,
                data:{name:name_filter}
            }).done(function (data) {
                $('#load').hide();
                $("#table-container").empty().html(data);
            });
        }
        $(document).ready(function () {

            function clear(){
                $('#addNewpage').find(".name").val('');
                $('#addNewpage').find(".name_ar").val('');
                $('#addNewpage').find(".color").val('');

                $('#addNewpage').find('.rowIdUpdate').val(0);
            }

            $(document).on('click', '.btnAddGroup', function () {
                $(".name").val('');
                $(".name_ar").val('');
                $(".color").val('');
                $('.rowIdUpdate').val(0);

                $('#add_page .modal-title').html("{{ trans('lang.add_type') }}");
                $('#add_page').modal('show');
            });


            // Start Update Modal For Edit
            $(document).on('click', '.updateDetails', function () {
                console.log('ss')
                clear();
                $('#addNewpage #loading').show();
                $('#addNewpage').find('.rowIdUpdate').val(0);
                var id = $(this).data('id');

                $('.rowIdUpdate').val(id);

                $.ajax({
                    url: "/admin/status/edit",
                    type: "get",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function (data) {
                        $('#addNewpage #loading').hide();
                        if (data['status'] == true) {
                            $('.name').val(data['data']['name_en']);
                            $('.name_ar').val(data['data']['name_ar']);
                            var arr = [];

                        }
                    },
                    complete: function () {
                        $('#add_page').modal('show');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        swal({title: 'حدث خطأ غير معروف، الرجاء المحاولة فيما بعد', type: "error"});
                    }
                });

                $('#add_page .modal-title').html("{{trans('lang.edit_data')}}");

            });
            // End Update Modal For Edit


            // Start Create Or Update
            $('.addNewpage').on('submit', function (e) {
                console.log('ss');
                $('#addNewpage #loading').show();
                e.preventDefault();
                var formData = new FormData(this);
                $(".name").val('');
                $(".name_ar").val('');

                var id = $(".rowIdUpdate").val(); // If Value = 0 => Create - If value != 0 => Update
                if (id == 0) {
                    // Create Function
                    $.ajax({
                        url: "/admin/status/add",
                        type: "post",
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formData,
                        success: function (data) {
                            $('#addNewpage #loading').hide();
                            if (data["status"] == true) {
                                swal({
                                    title: "",
                                    text: data["data"],
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('lang.ok')}}",
                                    cancelButtonText: "{{trans('lang.cancel')}}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                                var url = $('.addNewpage').attr('href');

                                getData(url);

                                clear();

                                $('#addNewpage').find(".name").val(''); // Name In English
                                $('#addNewpage').find(".name_ar").val('');  // Name In Arabic
                                $('#addNewpage').find(".role").val('');
                                $("#addNewpage .rowIdUpdate").val(0);


                                $("#add_page").modal("hide");
                            } else {
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
                        }
                    });
                } else {
                    console.log(id)
                    // Update
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "/admin/status/update",
                        type: "POST",
                        dataType: "JSON",
                        data: formData,

                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#addNewpage #loading').hide();
                            if (data["status"] == true) {
                                swal({
                                    title: "",
                                    text: data["data"],
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: "#DD6B55",
                                    confirmButtonText: "{{trans('lang.ok')}}",
                                    cancelButtonText: "{{trans('lang.cancel')}}",
                                    closeOnConfirm: true,
                                    closeOnCancel: true
                                });
                                var url = $(this).attr('href');
                                getData(url);
                                clear();
                                $('#addNewpage').find(".name").val(''); // Name In English
                                $('#addNewpage').find(".name_ar").val('');  // Name In Arabic
                                $('#addNewpage').find(".role").val('');
                                $('#addNewpage').find('.rowIdUpdate').val(0);

                                $("#add_page").modal("hide");
                            } else {
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
                        }
                    });
                }

            });
            // End Create Or Update

            // Delete function
            $(document).on('click', '.delete', function (e) {
                var id = $(this).data('id');
                Swal.fire({
                    title: '',
                    text: "{{trans('lang.are_you_sure')}}",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{trans('lang.ok')}}",
                    cancelButtonText: "{{trans('lang.cancel')}}",
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "/admin/status/delete",
                            type: "post",
                            dataType: "JSON",
                            data: {
                                id: id
                            },
                            success: function (data) {
                                if (data['status'] == true) {
                                    Swal.fire(
                                        '',
                                        data.data,
                                        'success'
                                    )
                                    var url = $(this).attr('href');
                                    getData(url);
                                    window.history.pushState("", "", url);
                                } else {
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
                })
            });
        });
    </script>

    {{-- Filter Functionality --}}
    <script>

        $(document).on('input','.name_filter',function(e){
            var name = $(this).val();
            if(name == '' || name.length >= 3){
                var url = $(this).attr('href');
                getData(url);
            }
        });
    </script>

    <script>
        $('.reset').click(function() {
            $('.name_filter').val('');
            if(name == '' || name.length >= 3){
                var url = $(this).attr('href');
                getData(url);
            }
        })
    </script>

@stop
