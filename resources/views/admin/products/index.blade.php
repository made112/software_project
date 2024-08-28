@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.products')}}
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
                                <span class="m-nav__link-text text-dark">{{trans('lang.products')}}</span>
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
                <h5 class="font-weight-bold float-left">{{trans('lang.manage_products')}}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12 col-lg-9 mb-4">
                <div class="fillter-box">
                    <div>
                        <select name="status" id="status" class="status form-control reset-filter" style="color: #999da6">
                            <option value="">{{trans('lang.status')}}</option>
                            <option value="1">{{trans('lang.active')}}</option>
                            <option value="2">{{trans('lang.inactive')}}</option>
                        </select>
                    </div>
                    <div>
                        <input type="text" class="name form-control reset-filter" name="name" autocomplete="off" placeholder="{{trans('lang.name')}}">
                    </div>
                    <div>
                        <input type="text" class="from form-control date-picker reset-filter" name="from" autocomplete="off"
                            placeholder="{{ trans('lang.from') }}" readonly>
                    </div>
                    <div>
                        <input type="text" class="to form-control date-picker reset-filter" name="to" autocomplete="off"
                            placeholder="{{ trans('lang.to') }}" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-3 mb-4 text-right">
				<button type="button" class="btn btn-md reset w-auto btn-info mr-2">{{trans('lang.reset')}}</button>
                @can('add_products')
                <a href="{{route('admin.products.create')}}" class="btn btn-md btn-black text-white"><i class="fa fa-plus"></i> {{trans('lang.add_product')}}</a>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="table-container" id="table-container">
                    @include('admin.products.table-data')
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

    $(document).on('click','.reset',function(e){
        e.preventDefault();
        $('.reset-filter').val('');
        var url = $(this).attr('href');
        getData(url);
    });
    function getData(url) {
        status = $('.status').val();
        name = $('.name').val();
        from = $('.from').val();
        to = $('.to').val();
        $.ajax({
            url : url,
            data:{status:status,name:name,from:from,to:to}
        }).done(function (data) {
            $("#table-container").empty().html(data);
        });
    }

    $(document).on('change','.status',function(e){
        var url = $(this).attr('href');
        getData(url);
    });

    $(document).on('change', '.from,.to', function(e) {
        var url = $(this).attr('href');
        getData(url);
    });

    $(document).on('input','.name',function(e){
        var name = $(this).val();
        if( name == '' || name.length >= 3){
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
                url: "{{route('admin.products.delete')}}",
                type: "post",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
					if(data['status'] == true){
						Swal.fire(
						'',
						data["data"],
						'success'
						)
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
    $(document).on('click', '.update_status', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#load').show();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.products.update_status') }}",
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
                        var url = $(this).attr('href');
						getData(url);
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
                }
            });
        });
</script>
@stop
