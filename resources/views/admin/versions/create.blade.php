@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.add_version') }}
@stop
@section('css')
    <style>
        .close{
            position: absolute;
            top: 40px;
            right: 25px;
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
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/products" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.products') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/versions/{{$product_id}}" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.versions') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.add_version') }}</span>
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
                                        {{ trans('lang.add') }} {{ $product->name }} {{ trans('lang.version') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.versions.add') }}" class="add_version_form" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="name">
                                            <div class="position-relative">
                                                {{ trans('lang.version_name') }}
                                                <label role="button" data-toggle="tooltip" data-placement="right"
                                                    title="{{ __('tooltip.version_name') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle"
                                                            data-name="Icon awesome-question-circle"
                                                            d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z"
                                                            transform="translate(-0.563 -0.563)" fill="#43425d" />
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="text" name="name" id="name" class="name form-control"
                                            placeholder="{{ trans('lang.version_name') }}" >
                                    </div>
                                    <div class="col-md-3 col-lg-3 date_div" >
                                        <div class="float-left">
                                            <label for="name" style="margin-top:6px">{{ trans('lang.publish_date') }}</label>
                                        </div>
                                        <div class="float-right">
                                            <input type="checkbox" class="publish_version" checked id="publish_version"
                                            name="publish_version">
                                            <label for="publish_version">
                                                <div class="position-relative">
                                                    {{ trans('lang.publish_now') }}
                                                    <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.publish_version') }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                            <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                        </svg>
                                                    </label>
                                                </div>
                                            </label>
                                        </div>
                                        <input type="text" name="date" id="date" disabled class="date date-picker form-control" value="{{date('Y-m-d')}}"
                                            placeholder="{{ trans('lang.publish_date') }}" >
                                    </div>
                                    <div class="col-md-3 col-lg-3 align-self-end">

                                    </div>
                                </div>
                                <input type="hidden" name="product_id" value="{{ $product_id }}">
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="name">{{ trans('lang.notification_summry') }}</label>
                                        <input type="text" name="notification_summry" id="notification_summry"
                                            class="notification_summry form-control"
                                            placeholder="{{ trans('lang.notification_summry') }}" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                       <label for="name">
                                            <div class="position-relative">
                                                Branch
                                            </div>
                                        </label>
                                        <input type="text" name="branch" id="name" class="name form-control" placeholder="Branch" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="name">{{ trans('lang.change_log') }}</label>
                                        <textarea name="change_log" id="change_log" class="change_log form-control ckeditor" cols="30" rows="5"
                                            placeholder="{{ trans('lang.change_log') }}" ></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="name">
                                            <div class="position-relative">
                                                {{ trans('lang.main_files') }} ({{ trans('lang.optional') }})
                                                <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.main_file') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="file" name="main_files" id="main_files" class="main_files form-control"
                                            placeholder="{{ trans('lang.main_files') }}">

                                        <button type="button" class="close" aria-label="Close" id="clear_main">
                                            <span aria-hidden="true">&times;</span>
                                        </button>

                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="name">
                                            <div class="position-relative">
                                                {{ trans('lang.sql_files') }}  ({{ trans('lang.optional') }})
                                                <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.sql_file') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="file" name="sql_files" id="sql_files" class="sql_files form-control"
                                            placeholder="{{ trans('lang.sql_files') }}">
                                        <button type="button" class="close" aria-label="Close" id="clear_sql">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
{{--
                                <div class="form-group row">

                                </div> --}}
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <input type="checkbox" class="block" id="block" name="block" >
                                        <label for="block">
                                            {{trans('lang.block_version')}}
                                        </label>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button onClick="CKupdate();" type="submit"
                                            class="btn btn-md px-5 text-white btn-black">{{ trans('lang.submit') }}</button>
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
        function CKupdate() {
            for (instance in CKEDITOR.instances)
                CKEDITOR.instances[instance].updateElement();
        }

        $('.add_version_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            if ($('.publish_version').is(':checked')) {
                formData.set('publish_version', 1);
                var date = $('.date').val();
                formData.set('date',date);
            } else {
                formData.set('publish_version', 2);
            }
            if($('.block').is(':checked')){
                formData.set('block',1);
            }else{
                formData.set('block',0);
            }
            $.ajax({
                url: "{{ route('admin.versions.add') }}",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $('#load').hide();
                    if (data["status"] == true) {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                        location.replace(
                            "{{ route('admin.versions.index', ['product_id' => $product_id]) }}");
                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                }
            });
        })
    </script>
    <script>
        $(document).on('change','.publish_version',function(e){
            if($(this).is(':checked')){
                $('.date').datepicker("setDate", new Date() );
                $('.date_div .date').prop('disabled',true);
            }else{
                $(this).removeAttr('checked');
                // $('.date_div').show();
                $('.date_div .date').prop('disabled',false);
                $('.date').val('');
            }
        })
    </script>

    <script>
        $('#clear_sql').click(function() {
            $('#sql_files').val('');
        });
        clear_main
        $('#clear_main').click(function() {
            $('#main_files').val('');
        });

    </script>
@stop
