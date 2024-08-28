@extends('admin.layout.master_layout')
@section('title')
   {{trans('lang.admins')}}
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
                                <span class="m-nav__link-text text-dark">{{trans('lang.admins')}}</span>
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
                <h5 class="font-weight-bold float-left">{{trans('lang.manage_admins')}}</h5>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-10 col-lg-10 mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="name reset-filter user_name_seach form-control" name="name" autocomplete="off" placeholder="{{trans('lang.name')}}">
                    </div>
                    <div class="col-md-3">
                        <select name="status" id="status" class="status reset-filter form-control" style="color: #999da6">
                            <option value="">{{trans('lang.status')}}</option>
                            <option value="1">{{trans("lang.active")}}</option>
                            <option value="0">{{trans("lang.inactive")}}</option>
                        </select>
                    </div>
                    <div class="col-md-2 align-self-center">
                        <button type="button" class="btn btn-md reset btn-info">{{trans('lang.reset')}}</button>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-2 mb-4 text-right">
                @can('add_users')
                <button type="button"  class="btn btn-black text-white m-btn m-btn--custom btnAddCustomer" style="line-height: 15px;
                padding-bottom: 15px;"><i class="fa fa-plus"></i> {{trans('lang.add_admin')}}</button>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="table-container" id="table-container">
                    @include('admin.users.table-data')
                </div>
            </div>
        </div>
    </div>


    </div>


    @include('admin.users.sub.add')
@stop


@section('js')
<script type="text/javascript">
$(document).ready(function(e){
    getpermission();
});

    $(document).on('click','.reset',function(e){
        e.preventDefault();
        $('.reset-filter').val('');
        var url = $(this).attr('href');
        getData(url);
    });

$(document).on('click','.permission',function(e){
    var id = $(this).data('id');
    $('.user_id').val(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        url: "/admin/users/userpermission",
        type: "post",
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
/****************************************************************************** */
function getpermission(){
    $.ajax({
        url: "/admin/users/getpermission",
        type: "get",
        dataType: "JSON",
        data:{},
        success: function(data) {
            if(data['status'] == true){
                console.log(1);
            }
        }
    });
}
/******************************************************************************************************* */
$('#activeValue').bootstrapSwitch('state', false, true);

$('#activeValue1').bootstrapSwitch('state', false, true);


function CKupdate(){
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}
/************************************************************************************************************* */
$('.user_name_seach').on('input',function(e){
    name =  $('.user_name_seach').val();
    if(name.length >= 3 || name == ''){
        var url = $(this).attr('href');
        getData(url,name);
    }
});

/***********************************************************************************************************************/
        $('body').on('click','.UpdateStats',function(){
            $('#load').show();
            $(this).addClass('disabled');
            var thisTag = $(this);
            var id = $(this).data('id');
			$.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
            	url: "/admin/users/UpdateStats",
                type: "POST",
                dataType: "JSON",
                data:{id:id},
                success: function(data) {
                    $('#load').hide();
                    if(data["status"] == true){
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
                }
            });
            $(thisTag).removeClass('disabled');
            $('.loadImg').addClass('hidden');
        });
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

    $(document).on('change','.status',function(e){
        var url = $(this).attr('href');
        getData(url);
    });


    function getData(url,name) {
        $('#load').show();
        status = $('.status').val();
        name = $('.name').val();
        $.ajax({
            url : url,
            data:{name:name,status:status}
        }).done(function (data) {
            $("#table-container").empty().html(data);
            $('#load').hide();
        });
    }
</script>

<script type="text/javascript">
    function clear(){
        $('#addNewpageForm').find(".user_name").val('');
        $('#addNewpageForm').find(".email").val('');
        $('#addNewpageForm').find(".photo").val('');
        $('#addNewpageForm').find(".password").val('');
        $('#addNewpageForm .type').val('');
        $('.country_code').val('').trigger('change');
        $('#addNewpageForm').find(".mobile").val('');
        $('#addNewpageForm').find(".name_profile").val('');
        $('#addNewpageForm').find('.rowIdUpdate').val(0);
    }

    $(document).ready(function () {
        /*************************************************/
        $(document).on('click', '.btnAddCustomer', function () {
            clear();
            $('#add_page .modal-title').html("{{trans('lang.add_admin')}}");
            $('#add_page').modal('show');
        });

        //
        $(document).on('click', '.group_per', function () {
            var check = $(this).is(':checked');
            // var uncheck = $(this).is(':unchecked');
            var id = $(this).data('id');
            $('.' + id).each(function () {
                $(this).prop('checked', check);
            });
        });

        $(document).on('click','.password-modal',function(e){
            clear();
            $('#changepassword #loading').show();
            id = $(this).data('id');
            $.ajax({
                url: "/admin/users/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#changepassword #loading').hide();
					if(data['status'] == true){
                        $('.password').val('');
						$(".confirm_password").val('');
                        $('#changepassword .name').val(data['data']['name']);
                        $('.mobile').val(data['data']['mobile']);
                        $('.user_name').val(data['data']['user_name']);
                        $('.userIdUpdate').val(data['data']['id']);
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
                complete: function () {
                    $('#changepassword').modal('show');
                }
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
                url: "/admin/users/edit",
                type: "get",
                dataType: "JSON",
                data: {
                    id: id
                },
                success: function(data){
                    $('#addNewpageForm #loading').hide();
					if(data['status'] == true){
                        $('.name_profile').val(data['data']['name']);
                        $('.mobile').val(data['data']['mobile']);
                        $(".email").val(data['data']['email']);
                        $('.user_name').val(data['data']['username']);
                        $('.type').val(data['data']['type']);
                        $('.country_code').val(data['data']['country_code']).trigger('change');
						if(data['data']['status'] == 1){
							$('#activeValue').bootstrapSwitch('state', true, true);
						}else{
							$('#activeValue').bootstrapSwitch('state', false, true);
						}
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
                    url: "/admin/users/add",
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
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".name").val('');
                            $('#addNewpageForm').find(".email").val('');
                            $('#addNewpageForm').find(".mobile").val('');
                            $('#addNewpageForm').find(".password").val('');
                            $('#addNewpageForm').find(".fullname").val('');
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
                    url: "/admin/users/update",
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
                            $('#addNewpageForm').find(".status").val('');
                            $('#addNewpageForm').find(".name").val('');
                            $('#addNewpageForm').find(".email").val('');
                            $('#addNewpageForm').find(".password").val('');
                            $('#addNewpageForm').find(".fullname").val('');
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
                    url: "/admin/users/delete",
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
                            window.history.pushState("", "", url);
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

    $('#changepasswordform').on('submit', function(e){
            e.preventDefault();
            $('#changepasswordform #loading').show();
			var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
                $.ajax({
                    url: "/admin/users/changepassword",
                    type: "post",
					cache:false,
					contentType: false,
					processData: false,
                    data: formData,
                    success: function (data) {
                        $('#changepasswordform #loading').hide();
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
                            $('#changepasswordform').find(".password").val('');
                            $('#changepasswordform').find(".confirm_password").val('');
                            $('#changepasswordform').find(".userIdUpdate").val('');
                            $("#changepassword").modal("hide");
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
                    url: "/admin/users/permission",
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
                            $("#changepassword").modal("hide");
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
