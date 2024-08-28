@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.api_calls')}}
@stop
@section('css')
<style>
body .datepicker-dropdown.dropdown-menu{
    z-index: 1000 !important;
}
.div-delete-multiple{
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
                                <span class="m-nav__link-text text-dark">{{trans('lang.api_calls')}}</span>
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
                <h5 class="font-weight-bold float-left">{{trans('lang.api_calls')}}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12 col-lg-12 mb-4 text-left">
                <div class="row">
                    <div class="col-md-3">
                        <select name="status" id="status" class="status reset-filter form-control" style="color: #999da6">
                            <option value="">{{trans('lang.status')}}</option>
                            <option value="1">{{trans('lang.success')}}</option>
                            <option value="0">{{trans('lang.faild')}}</option>
                        </select>
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
                        <select name="function" id="function" class="function reset-filter form-control">
                            <option value="">{{trans('lang.function')}}</option>
                            <option value="{{\App\Models\ApiCall::GetLastVersion}}">Get Last Version</option>
                            <option value="{{\App\Models\ApiCall::CheckAvailabilityLicense}}">Check Availability License</option>
                            <option value="{{\App\Models\ApiCall::ActivateLicense}}">Activate License</option>
                            <option value="{{\App\Models\ApiCall::DeactivateLicense}}">Deactivate License</option>
                            <option value="{{\App\Models\ApiCall::CheckUpdate}}">Check Update</option>
                            <option value="{{\App\Models\ApiCall::UpdateDownloads}}">Update Downloads</option>
                            <option value="{{\App\Models\ApiCall::ViewPackage}}">View Package</option>
                            <option value="{{\App\Models\ApiCall::SignIn}}">Sign In</option>
                            <option value="{{\App\Models\ApiCall::SignOut}}">Sign Out</option>
                        </select>
                    </div>

                    <div class="col-md-3 mt-3">
                        <input type="text" class="from form-control reset-filter date-picker" name="from" autocomplete="off"
                            placeholder="{{ trans('lang.from') }}" readonly>
                    </div>
                    <div class="col-md-3 mt-3">
                        <input type="text" class="to form-control reset-filter date-picker" name="to" autocomplete="off"
                            placeholder="{{ trans('lang.to') }}" readonly>
                    </div>
                    <div class="col-md-2 mt-3 align-self-center">
                        <button type="button" class="btn btn-md reset btn-info">{{trans('lang.reset')}}</button>
                    </div>

                    <div class="col-md-2 mt-3 align-self-center div-delete-multiple">
                        <button type="button" class="btn btn-md  btn-danger delete-multiple">Delete</button>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="table-container" id="table-container">
                    @include('admin.api_calls.table-data')
                </div>
            </div>
        </div>
    </div>


    </div>


    @include('admin.api_calls.sub.view_errors')
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

    $(document).on('click','.reset',function(e){
        e.preventDefault();
        $('.reset-filter').val('');
        $('.client_id,.product_id').val('').trigger('change');
        var url = $(this).attr('href');
        getData(url);
    });

    function getData(url) {
        status = $('.status').val();
        name = $('.name').val();
        function_type = $('.function').val();
        client_id = $('.client_id').val();
        product_id = $('.product_id').val();
        from = $('.from').val();
        to = $('.to').val();
        $.ajax({
            url : url,
            data:{status:status,name:name,client_id:client_id,product_id:product_id,function:function_type,from:from,to:to}
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }

    $(document).on('change', '.from,.to', function(e) {
        var url = $(this).attr('href');
        getData(url);
    });

    $(document).on('change','.status,.client_id,.product_id,.function',function(e){
        var url = $(this).attr('href');
        getData(url);
    });

    $(document).on('input','.name',function(e){
        var name = $(this).val();
        if(name == '' || name.length >= 3){
            var url = $(this).attr('href');
            getData(url);
        }
    });

    $(document).on('click','.delete',function(e){
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
                    url: "{{route('admin.api-calls.delete')}}",
                    type: "post",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data){
                        if(data['status'] == true){
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
			})
	});
</script>
<script>
    $(".product_id").select2({
        minimumInputLength: 2,
        allowClear: true,
        placeholder: "{{trans('lang.products')}}",
        ajax: {
            url: "{{route('admin.products.select')}}",
            dataType: 'json',
            delay: 250,
            type: "get",
            data: function (term) {
                return {
                    term: term.term
                };
            },
            processResults: function (response) {
                if(response){
                return {
                    results:response
                };
                }
            },
            cache: true
        }
    });

    $(".client_id").select2({
        minimumInputLength: 2,
        allowClear: true,
        placeholder: "{{trans('lang.company')}}",
        ajax: {
            url: "{{route('admin.clients.select')}}",
            dataType: 'json',
            delay: 250,
            type: "get",
            data: function (term) {
                return {
                    term: term.term,
                    product_id:$('.product_id').val()
                };
            },
            processResults: function (response) {
                if(response){
                return {
                    results:response
                };
                }
            },
            cache: true
        }
    });
</script>
<script>
     $(document).on("change" , ".all_under_collection" , function () {
        $('.div-delete-multiple').css('display','none');
        if($(this).is(":checked")) {
            $('.div-delete-multiple').css('display','block');
            $("#table-container .under_collection").each(function (index) {
                $(this).prop("checked" , true);
            });
        }else {
            $("#table-container .under_collection").each(function (index) {
                $(this).prop("checked" , false);
            });
        }
    });

    $(document).on("change" , "#table-container  .under_collection" , function () {
        $('.div-delete-multiple').css('display','none');
        if ($('#table-container .under_collection:checked').length) {
            $('.div-delete-multiple').css('display','block');
        }
    })

    $(document).on('click','.delete-multiple',function(e){
        e.preventDefault();
        activities = []
        $('#table-container .under_collection:checked').each((index, element) => {
            activities.push(element.value)
        });

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
                    url: "{{ route('admin.api-calls.delete') }}",
                    type: "post",
                    dataType: "JSON",
                    data: {
                        id: activities
                    },
                    success: function(data){
                        if(data['status'] == true){
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
                            $('.div-delete-multiple').css('display','none');
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
			})

    });
</script>
@stop
