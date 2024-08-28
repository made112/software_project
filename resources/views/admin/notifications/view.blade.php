@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.view_notifications')}}
@stop
@section('css')
<style>
    /* .div_date{
        display: none;
    } */
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
                            <a href="/admin/notifications" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark"  style="font-weight:bold">{{trans('lang.notifications')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text">/</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark">{{trans('lang.view_notifications')}}</span>
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
                    {{trans('lang.view_notifications')}}
                </h3>
                </div>
                </div>
                </div>
                    <div class="m-portlet__body">
                      
                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="name">{{trans('lang.notification_type')}}</label>
                                    <select name="notification_type" class="notification_type form-control" disabled id="notification_type">
                                        <option value="">{{trans('lang.notification_type')}}</option>
                                        <option value="1" @if($notifications->notification_type == 1) selected @endif>{{trans('lang.update')}}</option>
                                        <option value="2" @if($notifications->notification_type == 2) selected @endif>{{trans('lang.new_content')}}</option>
                                        <option value="3" @if($notifications->notification_type == 3) selected @endif>{{trans('lang.expired')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3 col-lg-3">
                                    <label for="status">{{trans('lang.status')}}</label>
                                    <select name="status" id="status" disabled class="status form-control">
                                        <option value="">{{trans('lang.status')}}</option>
                                        <option value="1" @if($notifications->status == 1) selected @endif>{{trans('lang.publish_now')}}</option>
                                        <option value="2" @if($notifications->status == 2) selected @endif>{{trans('lang.schedule_date')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-3 col-lg-3 div_date">
                                    <label for="date">{{trans('lang.date')}}</label>
                                    <input type="text" class="date form-control datetimepicker" disabled style="width:100%" autocomplete="off" value="{{$notifications->date}}" placeholder="{{trans('lang.date')}}" name="date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="product_id">{{trans('lang.product')}}</label>
                                    <select name="product_id" id="product_id" disabled class="product_id form-control">
                                        <option value="">{{trans('lang.product')}}</option>
                                        @if($notifications->product)
                                            <option value="{{$notifications->product->id}}" selected>{{$notifications->product->name}}</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="client_id">{{trans('lang.client')}}</label>
                                    <select name="client_id[]" multiple id="client_id" disabled class="client_id form-control">
                                        <option value="">{{trans('lang.client')}}</option>
                                        @if($notifications->clients)
                                            @foreach($notifications->clients as $clients)
                                            <option value="{{$clients->client->id}}" selected>{{$clients->client->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small>{{trans('lang.empty_send_all_clients')}}</small>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="notification_title">{{trans('lang.notification_title')}}</label>
                                    <input type="text" name="notification_title" disabled value="{{$notifications->notification_title}}" id="notification_title" class="notification_title form-control" placeholder="{{trans('lang.notification_title')}}">
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label for="channel_id">{{trans('lang.channel_id')}}</label>
                                    <select name="channel_id" id="channel_id" disabled class="channel_id form-control">
                                        <option value="">{{trans('lang.channel_id')}}</option>
                                        <option value="1" @if($notifications->channel_id == 1) selected @endif>{{trans('lang.email')}}</option>
                                        {{-- <option value="2" @if($notifications->channel_id == 2) selected @endif>{{trans('lang.mobile')}}</option> --}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12">
                                    <label for="name">{{trans('lang.notification_content')}}</label>
                                    <textarea name="notification_content" id="notification_content" disabled class="notification_content form-control ckeditor" cols="30" rows="5" placeholder="{{trans('lang.notification_content')}}">{{$notifications->notification_content}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <a  href="{{URL::to('/')}}/admin/notifications" class="btn btn-md px-5 text-white btn-black">{{trans('lang.back')}}</a>
                                </div>
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
    $(".client_id").select2({
    minimumInputLength: 2,
    multiple:true,
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
@stop
