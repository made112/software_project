@extends('admin.layout.master_layout')
@section('title')
{{trans('lang.edit_license')}}
@stop
@section('css')
<style>
    /* .div_file{
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
                            <a href="/admin/licenses" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark"  style="font-weight:bold">{{trans('lang.licenses')}}</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text">/</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link ">
                                <span class="m-nav__link-text text-dark">{{trans('lang.edit_license')}}</span>
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
                    {{trans('lang.edit_license')}}
                </h3>
                </div>
                </div>
                </div>
                    <div class="m-portlet__body">
                        <form action="{{route('admin.licenses.update')}}" class="add_licenses_form" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$id}}">
                            <div class="form-group row">
                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="client_id">{{trans('lang.company')}}</label>
                                    <select name="client_id" id="client_id" class="client_id form-control">
                                        <option value="">{{trans('lang.company')}}</option>
                                        @if($licenses->client)
                                        <option value="{{$licenses->client->id}}" selected>{{$licenses->client->name}}</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="product_id">{{trans('lang.license_for_product')}}</label>
                                    {{-- <button type="button" class="btn btn-dark text-white btn-sm m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air btn_add_product_to_client">
                                        <i class="fa fa-plus"></i>
                                    </button> --}}
                                    <select name="product_id" id="product_id" class="product_id form-control" readonly>
                                        <option value="">{{trans('lang.product')}}</option>
                                        @if($licenses->product)
                                        <option value="{{$licenses->product->id}}" selected>{{$licenses->product->name}}</option>
                                        @endif
                                    </select>
                                </div>


                            </div>

                            <div class="form-group row  ">
                                <div class="col-md-6 col-lg-6">
                                    <label for="license_code">{{trans('lang.license_code')}}</label>
                                    <input type="text" name="license_code" id="license_code" value="{{$licenses->license_code}}" class="license_code form-control" placeholder="{{trans('lang.license_code')}}" style="pointer-events: none;" readonly>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label>{{ trans('lang.package') }}</label>
                                    <span id="add_package">

                                        </span>
                                    <select name="product_package_id" class="form-control" id="license_package" style="pointer-events: none">
                                        <option value="{{ $licenses->product_package->id }}">
                                            {{ $licenses->product_package->name }}
                                        </option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row  ">
                                {{-- Price Type ( Package ) --}}
                                <div class="col-md-6 col-lg-6">
                                    <label>{{ trans('lang.package_price_type') }}</label>
                                    <select name="price_type" class="price_type form-control" id="package_price_type" style="pointer-events: none">
                                        @if( $licenses->product_package->type == 1 )
                                            <option value="">Free</option>
                                        @elseif( $licenses->product_package->type == 2 )
                                            <option value="">Paid</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <label>{{ trans('lang.package_duration') }}</label>
                                    <select name="price_type" class="price_type form-control" id="package_duration" style="pointer-events: none">
                                        @if( $licenses->product_package->duration == 1 )
                                            <option value="">{{ 'Days' }}</option>
                                        @elseif($licenses->product_package->duration == 2)
                                            <option value="">{{ 'Monthly' }}</option>
                                        @elseif($licenses->product_package->duration == 3)
                                            <option value="">{{ 'Anual' }}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row ">

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="license_type">{{trans('lang.license_type')}}</label>
                                    <select name="type" class="license_type form-control" id="license_type" readonly>
                                        <option value="">{{trans('lang.license_type')}}</option>
                                        <option value="1" @if($licenses->type == 1) selected @endif>{{trans('lang.online')}}</option>
                                        <option value="2" @if($licenses->type == 2) selected @endif>{{trans('lang.offline')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="payment_type">{{trans('lang.payment_type')}}</label>
                                    <select name="payment_type" id="payment_type" class="form-control payment_type" readonly>
                                        <option value="">{{trans('lang.payment_type')}}</option>
                                        @if($payment_type)
                                            @foreach($payment_type as $key=>$pay)
                                                <option value="{{$key}}" @if($key==$licenses->payment_type) selected @endif>{{$pay}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <div class="col-md-6 col-lg-6">
                                    <label for="support_type">{{ trans('lang.support_type') }}</label>
                                    <select name="package_support_type" class="support_type form-control" id="support_type" style="pointer-events: none">
                                        @if( $licenses->package_support_type == 2 )
                                            <option>Remotely</option>
                                        @elseif( $licenses->package_support_type == 3 )
                                            <option>Prime</option>
                                        @elseif( $licenses->package_support_type == 1 || $licenses->package_support_type == 0 || !$licenses->package_support_type)
                                            <option>No Support</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6 mb-3" style="pointer-events: none">
                                    <label for="price">{{trans('lang.price')}}</label>
                                    <input type="number" min="0" step="1" name="price" id="price" class="price form-control" value="{{$licenses->price}}" placeholder="{{trans('lang.price')}}" readonly>
                                </div>

                            </div>

                            <div class="form-group row div_limit"  @if($licenses->type == 2) style="display:none" @endif>
                                <div class="col-md-6 col-lg-6">
                                    <label for="parallel_use_limit">
                                        <div class="position-relative">
                                            {{trans('lang.total_parallel_use_limit')}} ({{trans('lang.leave_empty_unlimited_parallel_uses')}})
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.parallel_use_limit') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="number" name="parallel_use_limit" id="parallel_use_limit" value="{{$licenses->parallel_use_limit}}"  class="parallel_use_limit form-control" placeholder="{{trans('lang.total_parallel_use_limit')}}" readonly>
                                </div>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="use_limit">
                                        <div class="position-relative">
                                            {{trans('lang.total_license_use_limit')}} ({{trans('lang.leave_empty_unlimited_uses')}})
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.use_limit') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="number" name="use_limit" id="use_limit" value="{{$licenses->use_limit}}"  class="use_limit form-control" placeholder="{{trans('lang.total_license_use_limit')}}" readonly>
                                </div>


                            </div>

                            <div class="form-group row" style="pointer-events: none">
                                <div class="col-md-6 col-lg-6">
                                    <label for="license_expiration_date">
                                        <div class="position-relative">
                                            {{trans('lang.license_expiration_date')}} ({{trans('lang.optional')}})
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.license_expire_days') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="text" name="date" id="license_expiration_date" @if($licenses->type == 2) disabled @endif  value="{{$licenses->date}}" style="width:100%" class="date datepicker license_expiration_date form-control" placeholder="{{trans('lang.license_expiration_date')}}" readonly>
                                </div>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="license_expiration_days">{{trans('lang.license_expiration_days')}} ({{trans('lang.optional')}})</label>
                                    <input type="number" name="days" id="license_expiration_days" value="{{$licenses->days}}"  @if($licenses->type == 1) style="pointer-events: none" @endif class="license_expiration_days days form-control" placeholder="{{trans('lang.license_expiration_days')}}" readonly>
                                </div>
                            </div>

                            <div class="form-group row" style="pointer-events: none">
                                <div class="col-md-6 col-lg-6">
                                    <label for="support_type">{{trans('lang.support_type')}}</label>
                                    <select name="support_type" class="support_type form-control" id="support_type" readonly>
                                        <option value="">{{trans('lang.support_type')}}</option>
                                        <option value="1" @if($licenses->support_type == 1) selected @endif>{{trans('lang.on_prims')}}</option>
                                        <option value="2" @if($licenses->support_type == 2) selected @endif>{{trans('lang.remotely')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="license_domains">{{trans('lang.license_domains')}} ({{trans('lang.optional')}})</label>
                                    <input type="text" name="domains" id="license_domains" data-role="tagsinput" value="{{$licenses->domains}}" class="license_domains form-control tagsinput" placeholder="{{trans('lang.license_domains')}}" readonly>
                                </div>

                            </div>

                            <div class="form-group row div_limit" @if($licenses->type == 2) style="display:none" @endif>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="license_ip">{{trans('lang.license_ip')}} ({{trans('lang.optional')}})</label>
                                    <input type="text" name="ip" id="license_ip" data-role="tagsinput"  value="{{$licenses->ip}}"  class="license_ip form-control tagsinput" placeholder="{{trans('lang.license_ip')}}">
                                </div>

                                <div class="col-md-6 col-lg-6 mb-3" style="pointer-events: none">
                                    <label for="machine_id">{{trans('lang.machine_id')}} ({{trans('lang.optional')}})</label>
                                    <input type="text" name="machine_id" id="machine_id" class="machine_id form-control" value="{{$licenses->machine_id}}" placeholder="{{trans('lang.machine_id')}}" readonly>
                                </div>

                            </div>

                            <div class="form-group row">

                                <div class="col-md-6 col-lg-6">
                                    <label for="invoice_no">{{trans('lang.invoice_no')}} ({{trans('lang.optional')}})</label>
                                    <input type="text" name="invoice_no" id="invoice_no" class="invoice_no form-control" value="{{$licenses->invoice_no}}"  placeholder="{{trans('lang.invoice_no')}}">
                                </div>

                                <div class="col-md-6 col-lg-6 mb-3 div_file" @if($licenses->type == 1) style="display:none" @endif >
                                    <label for="file">{{trans('lang.license_file')}} ({{trans('lang.optional')}})</label>
                                    <input type="file" name="file" id="file" class="file form-control">
                                </div>

                                <div class="col-md-6 col-lg-6" style="pointer-events: none">
                                    <label for="grace_end_days">
                                        <div class="position-relative">
                                            {{trans('lang.grace_end_days')}} ({{trans('lang.optional')}})
                                            <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.license_expiration_date') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                </svg>
                                            </label>
                                        </div>
                                    </label>
                                    <input type="number" name="grace_end_days" id="grace_end_days"  class="grace_end_days form-control" value="{{$licenses->grace_end_days}}" placeholder="{{trans('lang.grace_end_days')}}" readonly>
                                </div>

                            </div>


                            <div class="form-group row" style="pointer-events: none">
                                <div class="col-md-12 col-lg-12">
                                    <label for="name">{{trans('lang.comments')}} ({{trans('lang.optional')}})</label>
                                    <textarea name="comments" id="comments" class="details form-control" cols="30" rows="5" placeholder="{{trans('lang.comments')}}">{{$licenses->comments}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row" style="pointer-events: none">
                                <div class="col-md-12 col-lg-12">
                                    <input type="checkbox" class="block" id="block" name="block" @if($licenses->block == 1) checked @endif>
                                    <label for="block">
                                        {{trans('lang.block_license')}}
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

    @include('admin.modals.products.search')
@stop


@section('js')

<script>
    $(".add_licenses_form").on("keypress", function (event) {
        var keyPressed = event.keyCode || event.which;
        if (keyPressed === 13) {
            event.preventDefault();
            return false;
        }
    });

     $('.add_licenses_form').on('submit', function(e){
            e.preventDefault();
            $('#load').show();
			var formData = new FormData(this);
            if($('.block').is(':checked')){
                formData.set('block',1);
            }else{
                formData.set('block',0);
            }
            var license_expiration_date = $('.license_expiration_date').val();
            var license_expiration_days = $('.license_expiration_days').val();
            formData.set('date',license_expiration_date);
            formData.set('days',license_expiration_days);
            $.ajax({
                url: "{{route('admin.licenses.update')}}",
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
                        location.replace("{{route('admin.licenses.index')}}");
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
<script>
    $(".product_id").select2({
        minimumInputLength: 2,
        ajax: {
            url: "{{route('admin.products.select')}}",
            dataType: 'json',
            delay: 250,
            type: "get",
            data: function (term) {
                return {
                    term: term.term,client_id:$('.client_id').val()
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

    $(document).on('change','.license_type',function(e){
        var id = $(this).val();
        $('.div_file').hide();
        $('.div_limit').hide();
        $('.file').val('');
        $('.license_ip').tagsinput('removeAll');;
        $('.machine_id').val('');
        $('.parallel_use_limit').val('');
        $('.use_limit').val('');
        $('.license_expiration_date').attr('disabled',true);
        $('.license_expiration_days').attr('disabled',true);
        if(id == 1){
            $('.div_limit').css('display','flex');
            $('.license_expiration_date').removeAttr('disabled');
        }else if(id == 2){
            $('.div_file').show();
            $('.license_expiration_days').removeAttr('disabled');
        }
    });

    $(document).on('input','.license_expiration_days',function(e){
        var days = parseInt($(this).val());
        if(!days){
            days = 0;
            $('.license_expiration_days').val(days);
        }
        var date = new Date();
        date.setDate(date.getDate() + days);
        var date = setDateFormat(date)
        $('.license_expiration_date').val(date);
    });

    $(document).on('change','.license_expiration_date',function(e){
        var todate = $(this).val();
        var fromdate = new Date();
        var diff = getDiffDate(fromdate,todate);
        $('.license_expiration_days').val(Math.round(diff));
    });

    $('.datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: "yyyy-mm-dd",
        language: "ar",
        rtl: true,
        autoclose: true,
        todayHighlight: true,
        startDate: new Date()
    });
    </script>
@stop
