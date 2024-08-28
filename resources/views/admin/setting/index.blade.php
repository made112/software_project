@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.general_settings')}}
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
                                <span class="m-nav__link-text text-dark">{{trans('lang.general_settings')}}</span>
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
                    {{trans('lang.general_settings')}}
                </h3>
                </div>
                </div>
                </div>
                    <div class="m-portlet__body">
                        <form action="{{route('admin.setting.update')}}" class="add_settings_form" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="email">{{ucwords(trans('lang.email'))}}</label>
                                    <input type="email" name="email" id="email" class="email form-control" value="{{$data['setting']->email}}" placeholder="{{ucwords(trans('lang.email'))}}">
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="mobile">{{ucwords(trans('lang.mobile'))}}</label>
                                    <input type="tel" name="mobile" id="mobile" class="mobile form-control" value="{{$data['setting']->mobile}}" placeholder="{{ucwords(trans('lang.mobile'))}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="license_code">{{trans('lang.license_code')}}</label>
                                    <input type="text" name="license_code" id="license_code" class="license_code form-control" value="{{$data['setting']->license_code}}" placeholder="{{trans('lang.license_code')}} {[X]}{[X]}{[X]}-{[Y]}{[Y]}{[Y]}-{[Z]}{[Z]}{[Z]}">
                                    <label>{[X]} = any number from 0-9, {[Y]} = any letter from a-z, {[Z]} any number from 0-9 or any letter from a-z</label>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="time_zone">{{trans('lang.time_zone')}}</label>
                                    <select name="time_zone" class="time_zone form-control" id="time_zone">
                                        <option value="">{{trans('lang.time_zone')}}</option>
                                        @if($data['tzlist'])
                                            @foreach($data['tzlist'] as $key=>$tz)
                                                <option value="{{$key}}" @if($key == $data['setting']->time_zone) selected @endif>{{$tz}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="blacklist_domain_attempts">{{trans('lang.blacklist_domain_attempts')}}</label>
                                    <input type="number" name="blacklist_domain_attempts" id="blacklist_domain_attempts" class="blacklist_domain_attempts form-control" value="{{$data['setting']->blacklist_domain_attempts}}" placeholder="{{trans('lang.blacklist_domain_attempts')}}">
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="blacklist_ip_attempts">{{trans('lang.blacklist_ip_attempts')}}</label>
                                    <input type="number" name="blacklist_ip_attempts" id="blacklist_ip_attempts" class="blacklist_ip_attempts form-control" value="{{$data['setting']->blacklist_ip_attempts}}" placeholder="{{trans('lang.blacklist_ip_attempts')}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label  class="d-block">{{trans('lang.activation_attempts')}}</label>
                                    <input type="checkbox" class="activation_attempts" id="activation_attempts" name="activation_attempts" @if($data['setting']->activation_attempts == 1) checked @endif>
                                    <label for="activation_attempts">
                                        <div class="position-relative">
                                            {{trans('lang.add')}} {{trans('lang.activation_attempts')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.license_expiration_date') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label  class="d-block">{{trans('lang.download_attempts')}}</label>
                                    <input type="checkbox" class="download_attempts" id="download_attempts" name="download_attempts" @if($data['setting']->download_attempts == 1) checked @endif>
                                    <label for="download_attempts">

                                        <div class="position-relative">
                                            {{trans('lang.add')}} {{trans('lang.download_attempts')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.download_attempts') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="twitter">{{trans('lang.twitter')}}</label>
                                    <input type="url" id="twitter" class="form-control url twitter" name="twitter" value="{{$data['setting']->twitter}}">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="instagram">{{trans('lang.instagram')}}</label>
                                    <input type="url" id="instagram" class="form-control url instagram" name="instagram" value="{{$data['setting']->instagram}}">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="linkedin">{{trans('lang.linkedin')}}</label>
                                    <input type="url" id="linkedin" class="form-control url linkedin" name="linkedin" value="{{$data['setting']->linkedin}}">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="remain_days_license">{{ trans('lang.remain_days_license') }}</label>
                                    <input type="number" id="remain_days_license" class="form-control remain_days_license" name="remain_days_license" value="{{$data['setting']->remain_days_license}}">
                                </div>

                                <div class="col-md-4 col-lg-4">
                                    <label for="freshdesk">{{ __('lang.freshdesk_api_key')}}</label>
                                    <input type="text" id="freshdesk" class="form-control url twitter" name="freshdesk_api_key" value="{{ $data['setting']->freshdesk_api_key }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <button type="submit" class="btn btn-md px-5 text-white btn-black">{{trans('lang.submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


    </div>


@stop


@section('js')
<script>
     $('.add_settings_form').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
			var formData = new FormData(this);
            if($('.activation_attempts').is(':checked')){
                formData.set('activation_attempts',1);
            }else{
                formData.set('activation_attempts',0);
            }

            if($('.download_attempts').is(':checked')){
                formData.set('download_attempts',1);
            }else{
                formData.set('download_attempts',0);
            }

            $.ajax({
                url: "{{route('admin.setting.update')}}",
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
                            confirmButtonText: "حسنا",
                            cancelButtonText: "الغاء",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                        location.replace("{{route('admin.setting.index')}}");
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
</script>
@stop
