@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.api_settings')}}
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
                                <span class="m-nav__link-text text-dark"  style="font-weight:bold">{{trans('lang.settings')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text">/</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark">{{trans('lang.api_settings')}}</span>
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
                    {{trans('lang.api_settings')}}
                </h3>
                </div>
                </div>
                </div>
                    <div class="m-portlet__body">
                        <form action="{{route('admin.setting.update_api_setting')}}" class="add_settings_form" method="post">
                            @csrf
                            <div class="form-group row">

                                <div class="col-md-6 col-lg-6">
                                    <label for="api_request_rate_limiting_methond">
                                        <div class="position-relative">
                                            {{trans('lang.api_request_rate_limiting_methond')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.api_request_rate_limiting_methond') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <select name="api_request_rate_limiting_methond" class="api_request_rate_limiting_methond form-control" id="api_request_rate_limiting_methond">
                                        <option value="">{{trans('lang.api_request_rate_limiting_methond')}}</option>
                                        <option value="1" @if($data['setting']->api_request_rate_limiting_methond == 1) selected @endif>{{trans('lang.limit_per_ip_address')}}</option>
                                        <option value="2" @if($data['setting']->api_request_rate_limiting_methond == 2) selected @endif>{{trans('lang.limit_per_domain')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="api_request_rate_limit">
                                        <div class="position-relative">
                                            {{trans('lang.api_request_rate_limit')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.api_request_rate_limit') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="number" min="0" step="1" name="api_request_rate_limit" id="api_request_rate_limit" class="api_request_rate_limit form-control" value="{{$data['setting']->api_request_rate_limit}}" placeholder="{{trans('lang.api_request_rate_limit')}}">
                                </div>


                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="api_blacklisted_domain">
                                        <div class="position-relative">
                                            {{trans('lang.api_blacklisted_domain')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.api_blacklisted_domain') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="text" name="api_blacklisted_domain" id="api_blacklisted_domain" data-role="tagsinput" class="api_blacklisted_domain tagsinput" @if($data['setting']->api_blacklisted_domain)value="{{$data['setting']->api_blacklisted_domain}}" @endif >
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="api_blacklisted_ips">
                                        <div class="position-relative">
                                            {{trans('lang.api_blacklisted_ips')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.api_blacklisted_ips') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="text" name="api_blacklisted_ips" id="api_blacklisted_ips" class="api_blacklisted_ips tagsinput"  data-role="tagsinput" @if($data['setting']->api_blacklisted_ips)value="{{$data['setting']->api_blacklisted_ips}}"@endif >
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <button type="submit" class="btn btn-md px-5 text-white btn-black">{{trans('lang.save_changes')}}</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="data-content">

        <div class="row">
            <div class="col-md-4 col-lg-4">

                <div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
                    <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text" style="font-weight: bold">
                    {{trans('lang.api_key')}}
                </h3>
                </div>
                </div>
                </div>
                    <div class="m-portlet__body">
                        <form action="{{route('admin.setting.add_api_key')}}" class="add_api_key_form" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <label for="api_key">{{trans('lang.api_key')}}</label>
                                    <input type="text" name="api_key" id="api_key" class="api_key form-control" value="{{\Str::random(20)}}" placeholder="{{trans('lang.api_key')}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <label for="api_key_type">
                                        <div class="position-relative">
                                            {{trans('lang.api_key_type')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.api_key_type') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <select name="api_key_type" class="api_key_type form-control" id="api_key_type">
                                        <option value="">{{trans('lang.api_key_type')}}</option>
                                        <option value="1" selected>{{trans('lang.external')}}</option>
                                        <option value="2">{{trans('lang.internal')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <input type="checkbox" class="special_permission" id="special_permission" name="special_permission" >
                                    <label for="special_permission">
                                        <div class="position-relative">
                                            {{trans('lang.give_special_permission')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.give_special_permission') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            @can('add_api_key')
                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <button type="submit" class="btn btn-md px-5 text-white btn-black">{{trans('lang.add')}}</button>
                                </div>
                            </div>
                            @endcan

                        </form>
                    </div>
                </div>

            </div>


            <div class="col-md-8 col-lg-8">

                <div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">

                    <div class="m-portlet__body">
                        <div class="table-reponsive">
                            <table class="table table-bordered">
                                <thead class="m-datatable__head">
                                    <tr>
                                        <th>{{trans('lang.api_key')}}</th>
                                        <th>{{trans('lang.special')}}</th>
                                        <th>{{trans('lang.type')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        @can('delete_api_key')
                                        <th>{{trans('lang.delete')}}</th>
                                        @endcan
                                    </tr>
                                </thead>
                                @if($data['api_key'])
                                    @foreach($data['api_key'] as $ap)
                                        @php
                                        if($ap->special_permission == 1)
                                            {
                                            $class='btn btn-dark m-btn m-btn--icon m-btn--pill';
                                            $color='green';
                                            $icon='check';
                                            $text = trans("lang.yes");
                                        }else{
                                            $class='btn btn-info m-btn m-btn--icon m-btn--pill';
                                            $color='red';
                                            $icon='check';
                                            $text = trans("lang.no");
                                        }

                                        if($ap->api_key_type == 1)
                                            {
                                            $class2='btn btn-success m-btn m-btn--icon m-btn--pill';
                                            $color2='green';
                                            $icon2='check';
                                            $text2 = trans("lang.external");
                                        }else{
                                            $class2='btn btn-danger m-btn m-btn--icon m-btn--pill';
                                            $color2='red';
                                            $icon2='check';
                                            $text2 = trans("lang.internal");
                                        }
                                        @endphp
                                        <tr>
                                            <td>{{$ap->api_key}}</td>
                                            <td class="text-center">
                                                <a  color="{{$color}}" data-id="{{$ap->id}}" class="{{$class}} py-1"  href="javaScript:;">  <span>{{$text}}</span> </a>
                                            </td>
                                            <td class="text-center">
                                                <a  color="{{$color2}}" data-id="{{$ap->id}}" class="{{$class2}} py-1"  href="javaScript:;">  <span>{{$text2}}</span> </a>
                                            </td>
                                            <td>{{date('Y-m-d H:i',strtotime($ap->created_at))}}</td>
                                            @can('delete_api_key')
                                            <td class="text-center"><a href="#" data-id="{{$ap->id}}" class="btn btn-danger btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air
                                                delete"> <i class="fa fa-trash"></i> </a>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                @endif
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    </div>


@stop


@section('js')
<script>
    // $('.tagsinput').tagsinput();
    // $('.api_blacklisted_domain').tagsinput();
    // $('.api_blacklisted_ips').tagsinput();
    $(".add_settings_form").on("keypress", function (event) {
        var keyPressed = event.keyCode || event.which;
        if (keyPressed === 13) {
            event.preventDefault();
            return false;
        }
    });

     $('.add_settings_form').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
			var formData = new FormData(this);

            $.ajax({
                url: "{{route('admin.setting.update_api_setting')}}",
                type: "post",
                cache:false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $('#load').hide();
                    if (data["status"] == true) {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{__('lang.ok')}}",
                            cancelButtonText: "{{__('lang.cancel')}}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                        location.replace("{{route('admin.setting.api_setting')}}");
                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{__('lang.ok')}}",
                            cancelButtonText: "{{__('lang.cancel')}}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                }
            });
     })


     $('.add_api_key_form').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
			var formData = new FormData(this);
            if($('.special_permission').is(':checked')){
                formData.set('special_permission',1);
            }else{
                formData.set('special_permission',0);
            }
            $.ajax({
                url: "{{route('admin.setting.add_api_key')}}",
                type: "post",
                cache:false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    $('#load').hide();
                    if (data["status"] == true) {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{__('lang.ok')}}",
                            cancelButtonText: "{{__('lang.cancel')}}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                        location.replace("{{route('admin.setting.api_setting')}}");
                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{__('lang.ok')}}",
                            cancelButtonText: "{{__('lang.cancel')}}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                }
            });
     })

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
                url: "{{route('admin.setting.delete_api_key')}}",
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
                        location.replace("{{route('admin.setting.api_setting')}}");
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
