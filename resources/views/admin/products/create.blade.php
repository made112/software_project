@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.add_product')}}
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
                            <a href="/admin/products" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark"  style="font-weight:bold">{{trans('lang.products')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text">/</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark">{{trans('lang.add_product')}}</span>
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
                    {{trans('lang.add_product')}}
                </h3>
                </div>
                </div>
                </div>
                    <div class="m-portlet__body">
                        <form action="{{route('admin.products.add')}}" class="add_product_form" method="post">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <label for="name">{{trans('lang.product_name')}}</label>
                                    <input type="text" name="name" id="name" class="name form-control" placeholder="{{trans('lang.name')}}" >
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-4 col-lg-4">
                                    <label for="status">
                                        <div class="position-relative">
                                            {{trans('lang.product_status')}}
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.product_status') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <select name="status" class="status form-control" id="status" >
                                        <option value="">{{trans('lang.product_status')}}</option>
                                        <option value="1">{{trans('lang.active')}}</option>
                                        <option value="2">{{trans('lang.inactive')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="product_id" style="margin-top:6px">{{trans('lang.product_id')}}</label>
                                    <input type="text" name="product_id" id="product_id" class="product_id form-control" value="{{$product_id}}" placeholder="{{trans('lang.product_id')}}" style="pointer-events: none;">
                                </div>
                                <div class="col-md-4 col-lg-4">
                                    <label for="coloris" style="margin-top:6px">{{trans('lang.color')}}</label>
                                    <input type="text" id="coloris" name="color" class="coloris form-control color" placeholder="{{trans('lang.color')}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <label for="name">{{trans('lang.product_details')}} ({{trans('lang.optional')}})</label>
                                    <textarea name="details" id="details" class="details form-control" cols="30" rows="5" placeholder="{{trans('lang.product_details')}}"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <input type="checkbox" class="download_update" id="download_update" name="download_update" >
                                    <label for="download_update">
                                        <div class="position-relative">
                                            Make license check compulsory for downloading update
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.product_downloading_updates') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
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
     $('.add_product_form').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
			var formData = new FormData(this);
            if($('.download_update').is(':checked')){
                formData.set('download_update',1);
            }else{
                formData.set('download_update',0);
            }
            $.ajax({
                url: "{{route('admin.products.add')}}",
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
                        location.replace("{{route('admin.products.index')}}");
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
