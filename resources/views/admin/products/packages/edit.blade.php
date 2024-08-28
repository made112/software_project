@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.packages') }}
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
                                        <a href="{{ route('admin.products.index') }}" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.products') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{ route('admin.products.index') }}" class="m-nav__link ">
                                            <span
                                                class="m-nav__link-text text-dark">{{ trans('lang.add_new') . ' ' . __('lang.package') }}</span>
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
                                        {{ trans('lang.add_new') . ' ' . __('lang.package') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form
                                action="{{ route('admin.products.packages.update', ['product' => $product->id, 'package' => $package]) }}"
                                class="edit_package_form" id="edit_package_form" method="post">
                                @csrf

                                {{-- Start Name --}}
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="name">{{ ucwords(trans('lang.package_name')) }}</label>
                                        <input required type="text" name="name" id="name"
                                            class="name form-control"
                                            placeholder="{{ ucwords(trans('lang.package_name')) }}"
                                            value="{{ $package->name }}">
                                    </div>
                                </div>
                                {{-- End Name --}}

                                {{-- Start Description --}}
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="description">{{ ucwords(trans('lang.description')) }}</label>

                                        <textarea required name="description" id="description" cols="30" rows="10"
                                            class="description ckeditor form-control">

                                            {{ $package->description }}
                                        </textarea>
                                    </div>
                                </div>
                                {{-- End Description --}}

                                <div class="form-group row ">
                                    {{-- Start Type --}}
                                    <div class="col-md-3 col-lg-3">
                                        <label for="type">{{ ucwords(trans('lang.type')) }}</label>
                                        <select required name="type" id="type" class="type form-control">
                                            <option value="" disabled selected>
                                                {{ __('lang.select_type') }}</option>

                                            <option value="1" @if ($package->type == 1) selected @endif>
                                                Free
                                            </option>

                                            <option value="2" @if ($package->type == 2) selected @endif>
                                                Paid
                                            </option>

                                        </select>
                                    </div>
                                    {{-- End Type --}}

                                    {{-- Start Duration --}}
                                    @if ($package->type == 1)
                                        <div class="col-md-3 col-lg-3" id="duration_space_free">
                                            <label>{{ ucwords(trans('lang.duration')) }}</label>
                                            <select name="duration_free" id="duration_free" class="type form-control">
                                                <option value="0" disabled selected>
                                                    {{ __('lang.duration') }}</option>

                                                <option value="1" @if ($package->duration == 1) selected @endif>
                                                    Days
                                                </option>

                                            </select>
                                        </div>
                                    @elseif($package->type == 2)
                                        <div class="col-md-3 col-lg-3" id="duration_space_paid">
                                            <label for="type">{{ ucwords(trans('lang.duration')) }}</label>
                                            <select name="duration_paid" id="duration_paid" class="type form-control">
                                                <option value="" disabled selected>
                                                    {{ __('lang.duration') }}
                                                </option>

                                                <option value="2" @if ($package->duration == 2) selected @endif>
                                                    monthly
                                                </option>

                                                <option value="3" @if ($package->duration == 3) selected @endif>
                                                    Anual
                                                </option>

                                            </select>
                                        </div>
                                    @endif

                                    <div class="col-md-3 col-lg-3 d-none" id="duration_space_paid">
                                        <label for="type">{{ ucwords(trans('lang.duration')) }}</label>
                                        <select name="duration_paid" id="duration_paid" class="type form-control">
                                            <option value="" disabled selected>
                                                {{ __('lang.duration') }}
                                            </option>

                                            <option value="2">
                                                monthly
                                            </option>

                                            <option value="3">
                                                Anual
                                            </option>

                                        </select>
                                    </div>

                                    <div class="col-md-3 col-lg-3 d-none" id="duration_space_free">
                                        <label>{{ ucwords(trans('lang.duration')) }}</label>
                                        <select name="duration_free" id="duration_free" class="type form-control">
                                            <option value="0" disabled selected>
                                                {{ __('lang.duration') }}</option>

                                            <option value="1">
                                                Days
                                            </option>

                                        </select>
                                    </div>
                                    {{-- End Duration --}}

                                    {{-- Start Time --}}
                                    @if ($package->type == 2)
                                        <div class="col-md-3 col-lg-3" id="time_space">
                                            <label for="type">{{ ucwords(trans('lang.time')) }}</label>
                                            <select name="time" id="time" class="type form-control">
                                                <option value="" disabled selected>
                                                    {{ __('lang.time') }}</option>

                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}"
                                                        @if ($package->time == $i) selected @endif>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    @elseif($package->type == 1)
                                        <div class="col-md-3" id="days_space">
                                            <label>
                                                {{ trans('lang.time') }}
                                                <span class="required"></span>
                                            </label>
                                            <div class="form-valid">
                                                <input type="number" min="1" name="days" class="form-control"
                                                    id="days" value="{{ $package->duration_days }}">
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-3 col-lg-3 d-none" id="time_space">
                                        <label for="type">{{ ucwords(trans('lang.time')) }}</label>
                                        <select name="new_time" id="new_time" class="type form-control">
                                            <option value="" disabled selected>
                                                {{ __('lang.time') }}</option>

                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}"
                                                    @if ($package->time == $i) selected @endif>
                                                    {{ $i }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-md-3 d-none" id="days_space">
                                        <label>
                                            {{ trans('lang.time') }}
                                            <span class="required"></span>
                                        </label>
                                        <div class="form-valid">
                                            <input type="number" name="new_days" class="form-control" id="new_days">
                                        </div>
                                    </div>
                                    {{-- End Time --}}

                                    @if ($package->type == 1) {{-- Free --}}
                                        <div class="col-md-3" id="price_space">
                                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                                            <div class="form-valid">
                                                <input type="number" min="1" name="price" class="form-control price"
                                                    id="price" value="0">
                                            </div>
                                        </div>
                                    @elseif($package->type == 2) {{-- Paid --}}
                                        <div class="col-md-3" id="price_space">
                                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                                            <div class="form-valid">
                                                <input type="number" min="1" name="price"
                                                    class="form-control price" id="price"
                                                    value="{{ $package->type_price }}">
                                            </div>
                                        </div>
                                    @endif

                                </div>

                                <div class="duration_repeater">

                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="">{{ __('lang.support_type') . ' (optional)' }}</label>

                                        <div class="form-group row">
                                            <div class="col-md-12 col-lg-12">

                                                <label for="remotly_support_type">
                                                    <input type="checkbox" name="remotly_support_type"
                                                        id="remotly_support_type" class="support_type"
                                                        @if ($package->support_type) checked @endif>
                                                    {{ __('lang.remotely') }}</label>
                                            </div>

                                            <div class="col-md-12 col-lg-12 statuses @if(!$package->support_type) d-none @endif" id="remotly_support_type_status" >

                                                <label for="remotly_support_type_status_free">
                                                    <input type="radio" name="support_type_free"
                                                        id="remotly_support_type_status_free" value="1"
                                                        class="support_type_radio"
                                                        @if ($package->support_type == 1) checked @endif>
                                                    {{ __('lang.Free') }}</label>

                                                <label for="remotly_support_type_status_paid">
                                                    <input type="radio" name="support_type_paid"
                                                        id="remotly_support_type_status_paid" value="2"
                                                        class="support_type_radio"
                                                        @if ($package->support_type == 2) checked @endif>
                                                    {{ __('lang.paid') }}
                                                </label>
                                            </div>

                                            <div class="repeater col-md-12 col-lg-12">

                                                @if ($package->support_type == 2)
                                                    <div class="row" id="remotely_space">
                                                        <div class="col-md-3">
                                                            <label>{{ trans('lang.price') }}
                                                                <span class="required"></span>
                                                            </label>
                                                            <div class="form-valid">
                                                                <input type="number" min="1" name="remotely_price"
                                                                    class="form-control price" id="remotely_price"
                                                                    @if($package->support_price) value="{{ $package->support_price }}" @else value="1" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-md-12 col-lg-12">

                                                <label for="prime_support_type">
                                                    <input type="checkbox" name="prime_support_type"
                                                        id="prime_support_type" class="support_type"
                                                        @if ($package->prime_type) checked @endif>
                                                    {{ __('lang.prim') }}</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 statuses @if( !$package->prime_type ) d-none @endif" id="prime_space">

                                                <label for="prime_support_type_status_free">
                                                    <input type="radio" name="prime_support_type_free"
                                                        id="prime_support_type_status_free" value="1"
                                                        class="support_type_radio"
                                                        @if ($package->prime_type == 1) checked @endif>
                                                    {{ __('lang.Free') }}
                                                </label>

                                                <label for="prime_support_type_status_paid">
                                                    <input type="radio" name="prime_support_type_paid"
                                                        id="prime_support_type_status_paid" value="2"
                                                        class="support_type_radio"
                                                        @if ($package->prime_type == 2) checked @endif>
                                                    {{ __('lang.paid') }}
                                                </label>
                                            </div>

                                            <div class="prime_repeater col-md-12 col-lg-12">

                                                @if ($package->prime_type == 2)
                                                    <div class="row" id="prim_space">
                                                        <div class="col-md-3">
                                                            <label>
                                                                {{ trans('lang.price') }}
                                                                <span class="required"></span>
                                                            </label>
                                                            <div class="form-valid">
                                                                <input type="number" min="1" required name="prim_price"
                                                                    class="form-control price" id="prim_price" @if( $package->prime_price ) value="{{ $package->prime_price }}" @else value="1" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
                                            class="btn btn-md px-5 text-white btn-black add_package_button">{{ trans('lang.submit') }}</button>
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

    <!-- Update Form Ajax -->
    <script>
        $('.edit_package_form').on('submit', function() {
            event.preventDefault()
            var formData = new FormData(this)
            $('#load').show();
            formData.append('description', CKEDITOR.instances["description"].getData())
            $.ajax({
                url: "{{ route('admin.products.packages.update', ['product' => $product->id, 'package' => $package]) }}",
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
                            "{{ route('admin.products.packages.index', ['product' => $product->id]) }}"
                        );
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
                },
                error: function(data) {
                    $('#load').hide();

                    let errors = [];

                    $.each(data.responseJSON.errors, function(key, value) {
                        //errors['errors'] = value;
                        $.each(value, function(key_two, value_two) {
                            errors.push(value_two);
                        } )
                    }) ,
                    console.log(errors);
                    swal({
                        title: "",
                        text: errors,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ __('lang.ok') }}",
                        cancelButtonText: "{{ __('lang.cancel') }}",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    });
                }
            });
        })
    </script>

    <script>
        $('#type').change(function() {
            $('#days_space').addClass('d-none');
            $('#time_space').addClass('d-none');
            $('#price_space').addClass('d-none');
            $('#duration_free').val(0);


            if ($(this).val() == 1) {
                $('#duration_space_free').removeClass('d-none');
                $('#duration_space_paid').addClass('d-none');
            } else if ($(this).val() == 2) {
                $('#duration_space_free').addClass('d-none');
                $('#duration_space_paid').removeClass('d-none');
                $('#price').css('pointer-events', 'all');
            }

        });

        if ($('#duration_free').val() == 1) {
            $('#price').attr('disabled', true)
        }
        $('#duration_free').change(function() {
            $('#days_space').removeClass('d-none');


            $('#new_days').change(function() {
                $('#price_space').removeClass('d-none');
                $('#price').attr("readonly", true);
                $('#price').attr('min', 0);
                $('#price').val(0);
            })
        });

        $('#time').change(function() {
            $('#new_time').val($(this).val());
            $('#price_space').removeClass('d-none');
        })

        $('#days').change(function() {
            $('#new_days').val($(this).val());
            $('#price_space').removeClass('d-none');
            $('#price').val(0);
        })

        if ($('#duration_paid').val() == 3) {
            $('#time').css("pointer-events", "none");
        }

        $('#duration_paid').change(function() {
            if ($(this).val() == 2) {
                $('#time_space').removeClass('d-none');
                $('#new_time').removeClass('d-none');
                $('#new_time').css("pointer-events", "all");
                $('#time').css("pointer-events", "all");
                $('#price').attr('disabled', false)
                $('#price').val(1);

            } else if ($(this).val() == 3) {
                $('#time_space').removeClass('d-none');
                $('#new_time').val(1);
                $('#new_time').css("pointer-events", "none");
                $('#time').val(1);
                $('#time').css("pointer-events", "none");
                $('#price_space').removeClass('d-none');
                $('#price').val(1);
                $('#price').attr('disabled', false)
            }

            $('#new_time').change(function() {
                $('#price_space').removeClass('d-none');
            })
        });


        $('#days').change(function() {
            if ($('#type').val() == 1) {
                $('#price').removeAttr('disabled');
                $('#price').val(0);
                $('#price').css("pointer-events", "none");
                $('#price').attr('disabled', true);
                $('#price').attr('min', 0);
            }
        })

        $('#remotly_support_type').change(function() {
            if ($(this).is(':checked')) {
                $('#remotly_support_type_status').removeClass('d-none');
                $('#remotly_support_type_status_free').prop('checked', true);
                $('#remotly_support_type_status_paid').prop('checked', false);
                $('#remotely_price').val('1');
            } else {
                $('#remotly_support_type_status_free').prop('checked', false);
                $('#remotly_support_type_status').addClass('d-none');
                $('#remotely_space').addClass('d-none');
                $('#remotely_price').val('1');
                $('#remotly_support_type_status_paid').prop('checked', false);
            }
        })

        $('#remotly_support_type_status_paid').change(function() {

            $('#remotly_support_type_status_free').prop('checked', false);

            $('.repeater').html(`
                <div class="row" id="remotely_space">
                    <div class="col-md-3">
                        <label>{{ trans('lang.price') }}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="number" min="1" name="remotely_price" class="form-control price"
                                id="remotely_price" value="{{ $package->support_price }}">
                        </div>
                    </div>
                </div>
            `)
            var val = $('#remotely_price').val( {{ $package->support_price }} );

            if (val){
                $('#remotely_price').val( {{ $package->support_price }} );
            }else if( !val ){
                $('#remotely_price').val(1);
            }

        })

        $('#remotly_support_type_status_free').change(function() {
            $('#remotly_support_type_status_paid').prop('checked', false);
            $('#remotely_space').addClass('d-none');
        });

        // Prim
        $('#prime_support_type').change(function() {
            if ($(this).is(':checked')) {
                $('#prime_space').removeClass('d-none');
                $('#prime_support_type_status_free').prop('checked', true);
                $('#prime_support_type_status_paid').prop('checked', false);
            } else {
                $('#prime_support_type_status_paid').prop('checked', false);
                $('#prime_space').addClass('d-none');
                $('#prim_space').remove();
            }
        })

        $('#prime_support_type_status_paid').change(function() {
            $('#prime_support_type_status_free').prop('checked', false);
            $('.prime_repeater').empty()
            $('.prime_repeater').append(`
                <div class="row" id="prim_space">
                    <div class="col-md-3">
                        <label>
                            {{ trans('lang.price') }}
                            <span class="required"></span>
                        </label>
                        <div class="form-valid">
                            <input type="number" min="1" name="prim_price" class="form-control price" id="prim_price" value="{{ $package->prime_price }}">
                        </div>
                    </div>
                </div>
            `);

            var prime_price = $('#prim_price').val({{ $package->prime_price }});

            if ( prime_price ) {
                $('#prim_price').val({{ $package->prime_price }});
            }else{
                $('#prim_price').val(1);
            }
        });

        $('#prime_support_type_status_free').change(function() {
            $('#prime_support_type_status_paid').prop('checked', false);
            $('#prim_space').remove();
        });
    </script>

@stop
