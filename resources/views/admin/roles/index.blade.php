@extends('admin.layout.master_layout')
@section('title')
   {{trans('lang.roles')}}
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
                                <span class="m-nav__link-text text-dark">{{trans('lang.roles')}}</span>
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
                <h5 class="font-weight-bold">{{trans('lang.manage_roles')}}</h5>
            </div>
            <div class="col-md-10 col-lg-10 mb-4">
                {{-- <div class="row">
                    <div class="col-md-3">
                        <select name="status" id="status" class="status form-control">
                            <option value="">{{trans('lang.status')}}</option>
                            <option value="1">{{trans('lang.active')}}</option>
                            <option value="2">{{trans('lang.inactive')}}</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="name form-control" name="name" autocomplete="off" placeholder="{{trans('lang.name')}}">
                    </div>
                </div> --}}
            </div>
            <div class="col-md-2 col-lg-2 mb-4 text-right">
                @can('add_roles')
                <button type="button"  class="btn btn-black text-white m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
                padding-bottom: 15px;"><i class="fa fa-plus"></i> {{trans('lang.add_role')}}</button>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="table-container" id="table-container">
                    @include('admin.roles.table-data')
                </div>
            </div>
        </div>
    </div>


    </div>


    @include('admin.roles.sub.add')
@stop


@section('js')
<script type="text/javascript">

$(document).on('click','.permission',function(e){
    var id = $(this).data('id');
    $('.user_id').val(id);
    $.ajax({
        url: "/admin/roles/permission",
        type: "get",
        dataType: "JSON",
        data:{id:id},
        success: function(data) {
            $('#permission-body').html(data['data']);
        },
        complete:function(data){
            $('#permission_users').modal('show');
        }
    });

})
</script>

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
    $('#load').show();
    $.ajax({
        url : url,
        data:{}
    }).done(function (data) {
        $("#table-container").empty().html(data);
        $('#load').hide();
    });
}
</script>
<script type="text/javascript">
    function clear(){
        $('#addNewpageForm').find(".name").val('');
        $('#addNewpageForm').find('.rowIdUpdate').val(0);
    }

    $(document).on('click', '.btnAddCustomer', function () {
        clear();
        $('#add_page .modal-title').html("{{trans('lang.add_role')}}");
        $('#add_page').modal('show');
    });


    $(document).ready(function () {
        /*************************************************/
        $(document).on('click', '.group_per', function () {
            var check = $(this).is(':checked');
            var id = $(this).data('id');
            $('.' + id).each(function () {
                $(this).prop('checked', check);
            });
        });

        /*************************************************/
        $(document).on('click', '.updateDetails', function () {
            clear();
            $('#addNewpageForm #loading').show();
			$('#addNewpageForm').find('.rowIdUpdate').val(0);
            var id = $(this).data('id');
            $('.rowIdUpdate').val(id);
            $.ajax({
                url: "/admin/roles/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#addNewpageForm #loading').hide();
					if(data['status'] == true){
                        $('.name').val(data['data']['name']);
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
        /*************************************************/
        $('.addNewpageForm').on('submit', function(e){
            $('#addNewpageForm #loading').show();
            e.preventDefault();
			var formData = new FormData(this);
           
            var id = $(".rowIdUpdate").val();
            if (id == 0) {
                $.ajax({
                    url: "/admin/roles/add",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#addNewpageForm #loading').hide();
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
                            $("#addNewpageForm .rowIdUpdate").val(0);
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
				$.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/roles/update",
                    type: "POST",
                    dataType: "JSON",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#addNewpageForm #loading').hide();
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
							$('#addNewpageForm').find('.rowIdUpdate').val(0);
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
//	}
        });
        /****************************************************/
    });
/**************************************************************************************************************************/
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
                    url: "/admin/roles/delete",
                    type: "post",
                    dataType: "JSON",
                    data: {
                        id: id
                    },
                    success: function(data){
                        if(data['status'] == true){
                            Swal.fire(
                            '',
                            data.data,
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
    /*************************************************************************************************************************/

    $('#permission_users_form').on('submit', function(e){
            e.preventDefault();
            $('#permission_users_form #loading').show();
			var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/roles/permission",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#permission_users_form #loading').hide();
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
                            $('#permission_users').modal('hide');
                            var url = $(this).attr('href');
                            getData(url);
                            $('#permission_users_form').find(".permissions").val('');
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
            
    });
</script>
@stop