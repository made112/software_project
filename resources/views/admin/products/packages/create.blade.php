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
                            <form action="{{ route('admin.products.packages.store', ['product' => $product->id]) }}"
                                class="add_package_form" id="add_package_form" method="post">
                                @csrf

                                {{-- Start Name --}}
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="name">{{ ucwords(trans('lang.package_name')) }}</label>
                                        <input type="text" name="name" id="name" class="name form-control"
                                            placeholder="{{ ucwords(trans('lang.package_name')) }}">
                                    </div>
                                </div>
                                {{-- End Name --}}

                                {{-- Start Description --}}
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="description">{{ ucwords(trans('lang.description')) }}</label>

                                        <textarea name="description" id="description" cols="30" rows="10" class="description ckeditor form-control"></textarea>
                                    </div>
                                </div>
                                {{-- End Description --}}

                                <div class="form-group row ">
                                    {{-- Start Type --}}
                                    <div class="col-md-3 col-lg-3">
                                        <label for="type">{{ ucwords(trans('lang.type')) }}</label>
                                        <select name="type" id="type" class="type form-control">
                                            <option value="" disabled selected>
                                                {{ __('lang.select_type') }}</option>

                                            <option value="1">
                                                Free
                                            </option>

                                            <option value="2">
                                                Paid
                                            </option>

                                        </select>
                                    </div>
                                    {{-- End Type --}}

                                    {{-- Start Duration --}}
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
                                    {{-- End Duration --}}

                                    {{-- Start Time --}}
                                    <div class="col-md-3 col-lg-3 d-none" id="time_space">
                                        <label for="type">{{ ucwords(trans('lang.time')) }}</label>
                                        <select name="time" id="time" class="type form-control">
                                            <option value="" disabled selected>
                                                {{ __('lang.time') }}</option>

                                            @for ($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}">
                                                    {{ $i }}
                                                </option>
                                            @endfor

                                        </select>
                                    </div>

                                    <div class="col-md-3 d-none" id="days_space">
                                        <label>
                                            {{ trans('lang.time') }}
                                            <span class=""></span>
                                        </label>
                                        <div class="form-valid">
                                            <input type="number" min="1" name="days" class="form-control"
                                                id="days">
                                        </div>
                                    </div>
                                    {{-- End Time --}}

                                    <div class="col-md-3 d-none" id="price_space">
                                        <label>{{ trans('lang.price') }}<span class="required"></span></label>
                                        <div class="form-valid">
                                            <input type="number" name="price" class="form-control price"
                                                id="price" min="1">
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6 col-lg-6 duration_col d-none">
                                        <label for="duration">{{ ucwords(trans('lang.duration')) }}
                                            ({{ trans('lang.days_no') }})</label>
                                        <input type="number" name="duration"
                                            placeholder="{{ ucwords(trans('lang.duration')) }}" class="form-control">
                                    </div>

                                    <div class="col-md-6 col-lg-6 duration_type_col d-none">
                                        <label
                                            for="duration_type">{{ ucwords(trans('lang.duration') . ' ' . trans('lang.type')) }}</label>
                                        <select name="duration_type" id="duration_type"
                                            class="duration_type form-control">
                                            <option value="" selected>
                                                {{ __('lang.select') . ' ' . __('lang.duration') . ' ' . __('lang.type') }}
                                            </option>
                                            @foreach ($duration_types as $type)
                                                <option value="{{ $type['id'] }}" data-days="{{ $type['days'] }}">
                                                    {{ $type['name_' . app()->getLocale()] }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
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
                                                        id="remotly_support_type" class="support_type">
                                                    {{ __('lang.remotely') }}</label>
                                            </div>

                                            <div class="col-md-12 col-lg-12 statuses d-none"
                                                id="remotly_support_type_status">

                                                <label for="remotly_support_type_status_free">
                                                    <input type="radio" name="support_type_free"
                                                        id="remotly_support_type_status_free" value="1"
                                                        class="support_type_radio">
                                                    {{ __('lang.Free') }}</label>

                                                <label for="remotly_support_type_status_paid">
                                                    <input type="radio" name="support_type_paid"
                                                        id="remotly_support_type_status_paid" value="2"
                                                        class="support_type_radio">
                                                    {{ __('lang.paid') }}</label>
                                            </div>

                                            <div class="repeater col-md-12 col-lg-12">

                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <div class="col-md-12 col-lg-12">

                                                <label for="prime_support_type">
                                                    <input type="checkbox" name="prime_support_type"
                                                        id="prime_support_type" class="support_type">
                                                    {{ __('lang.prim') }}</label>
                                            </div>
                                            <div class="col-md-12 col-lg-12 statuses d-none" id="prime_space">

                                                <label for="prime_support_type_status_free">
                                                    <input type="radio" name="prime_support_type_free"
                                                        id="prime_support_type_status_free" value="1"
                                                        class="support_type_radio">
                                                    {{ __('lang.Free') }}</label>

                                                <label for="prime_support_type_status_paid">
                                                    <input type="radio" name="prime_support_type_paid"
                                                        id="prime_support_type_status_paid" value="2"
                                                        class="support_type_radio">
                                                    {{ __('lang.paid') }}</label>
                                            </div>

                                            <div class="prime_repeater col-md-12 col-lg-12">

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

    <!-- Add Form Ajax -->
    <script>
        $('.add_package_form').on('submit', function() {
            event.preventDefault()
            var formData = new FormData(this)
            $('#load').show();
            formData.append('description', CKEDITOR.instances["description"]
                .getData())


            $.ajax({
                url: "{{ route('admin.products.packages.store', ['product' => $product->id]) }}",
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

                    swal({
                        title: "",
                        text: "{{ __('lang.error') }}",
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
            }

        });

        $('#duration_free').change(function() {
            $('#days_space').removeClass('d-none');

            $('#days').change(function() {
                $('#price_space').removeClass('d-none');

            })
        });

        $('#duration_paid').change(function() {
            if ($(this).val() == 2) {
                $('#time_space').removeClass('d-none');
                $('#time').removeClass('d-none')
                $('#time').css("pointer-events", "all");
                $('#price').css("pointer-events", "all");
                $('#price').attr('disabled', false);
            } else if ($(this).val() == 3) {
                $('#time_space').removeClass('d-none');
                $('#time').val(1);
                $('#time').css("pointer-events", "none");
                $('#price_space').removeClass('d-none');
                $('#price').css("pointer-events", "all");
                $('#price').attr('disabled', false);
            }

            $('#time').change(function() {
                $('#price_space').removeClass('d-none');
            })
        });


        $('#days').change(function() {
            if ($('#type').val() == 1) {
                $('#price').removeAttr('disabled');
                $('#price').val(0);
                $('#price').css("pointer-events", "none");
                $('#price').attr("disabled", true);
            }
        });


        $('#remotly_support_type').change(function() {
            if ($(this).is(':checked')) {
                $('#remotly_support_type_status').removeClass('d-none');
                $('#remotly_support_type_status_free').prop('checked', true);
                $('#remotly_support_type_status_paid').prop('checked', false);

            } else {
                $('#remotly_support_type_status_free').prop('checked', false);
                $('#remotly_support_type_status_paid').prop('checked', false);
                $('#remotly_support_type_status').addClass('d-none');
                $('#remotely_space').addClass('d-none');
                $('#remotely_price').val('');
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
                                id="remotely_price">
                        </div>
                    </div>
                </div>
            `)

            $('#remotely_price').val(1);

        })

        $('#remotly_support_type_status_free').change(function() {
            $('#remotly_support_type_status_paid').prop('checked', false);
            $('#remotely_space').remove();
            $('#remotely_price').val(0);
        });

        // Prim
        $('#prime_support_type').change(function() {
            if ($(this).is(':checked')) {
                $('#prime_space').removeClass('d-none');
                $('#prime_support_type_status_paid').prop('checked', false);
                $('#prime_support_type_status_free').prop('checked', true);

                $('#prime_support_type_status_paid').change(function() {
                    $('#prime_support_type_status_free').prop('checked', false);
                    $('.prime_repeater').empty()
                    $('.prime_repeater').append(`
                        <div class="row" id="prim_space">
                            <div class="col-md-3">
                                <label>{{ trans('lang.price') }}<span class="required"></span></label>
                                <div class="form-valid">
                                    <input type="number" min="1" name="prim_price" class="form-control price"
                                        id="prim_price">
                                </div>
                            </div>
                        </div>
                    `);

                    $('#prim_price').val(1);
                });

                $('#prime_support_type_status_free').change(function() {
                    $('#prime_support_type_status_paid').prop('checked', false);
                    $('#prim_space').remove();
                    $('#prim_price').val(0);
                });

            } else {
                $('#prime_space').addClass('d-none');
                $('#prim_space').remove();
                $('#prime_support_type_status_paid').prop('checked', false);
                $('#prime_support_type_status_free').prop('checked', false);
            }
        })
    </script>

    {{-- <script>
        function emptyRepeater(element) {
            element.find('.repeater, .prime_repeater').children().remove()
        }

        $('.type').on('change', function() {
            var value = $(this).val()

            if (value == "{{ $types[0]['id'] }}") {
                $('.duration_col').removeClass('d-none')
                $('.duration_type_col').addClass('d-none')
                $('.duration_repeater').children().remove()
                $('.price_subscribe').children().remove()
                $('.duration_type option[selected]').removeAttr('selected')
                $('.duration_type option').first().attr('selected', '')
            } else if (value == "{{ $types[1]['id'] }}") {
                $('.duration_type_col').removeClass('d-none')
                $('.duration_col').addClass('d-none')
            } else {
                $('.duration_col .duration_type_col').addClass('d-none')
            }
        })
    </script>


    <script>
        $('.support_type').on('change', function() {
            var element = $(this).parent().parent().parent()
            element.find('.statuses').toggleClass('d-none')
            if (!$(this).is(':checked')) {
                element.find('input[type="radio"]').prop('checked', false);
                emptyRepeater(element)
            }
        })

        function addPrice(element, name) {
            element = $(element).parent().parent().parent()

            var to = element.find('.to').last().val();
            var from = element.find('.from').last().val();
            var price = element.find('.price').last().val();

            if (to == '' || to <= from || price == "") {
                if (to == '' || to <= from) {
                    element.find('.to').last().addClass('is-invalid')
                } else {
                    element.find('.to').last().removeClass('is-invalid')
                }
                if (price == "") {
                    element.find('.price').last().addClass('is-invalid')
                } else {
                    element.find('.price').removeClass('is-invalid')
                }
            } else {
                element.find('.price').removeClass('is-invalid')
                element.find('.to').removeClass('is-invalid')

                to = parseInt(to) + 1;

                element.find('.div_delete').hide();

                html = `<div class="form-group m-form__group row price_div">
                    <div class="col-lg-12  text-right div_delete">
                                <button type="button" class="btn btn-sm btn-danger delete_price  m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air"><i class="fa fa-times"></i></button>
                            </div>
                            <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" name="` + name + `_durations[` + index + `][from]" value="` + to + `" readonly
                                    class="form-control from" id="from" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" name="` + name + `_durations[` + index + `][price]" class="form-control price"
                                    id="price" required>
                            </div>
                        </div>
                        </div>
                        `;
                element.find('.price_subscribe').append(html);
                index++

            }




        }

        $('.support_type_radio').on('change', function() {
            var element = $(this).parent().parent().parent()
            var index = 0

            if ($(this).val() == "2") {
                var name = element.find('input[type="checkbox"]').attr('name')
                html =
                    `
                    <div class="form-group m-form__group row paid_div mb-3 price_item ">

                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index + `][from]" value="1" readonly
                                    class="form-control from" id="from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index + `][price]" class="form-control price"
                                    id="price">
                            </div>
                        </div>
                    </div>
                    <div class="price_subscribe">
                    </div>`

                element.find('.repeater').append(html)
                element.find('.prime_repeater').append(html)
                $('input[name="remotly_support_type_durations[' + index + '][to]"]').val($(
                    'input[name="duration_prices[' + index + '][to]"]').val());

                $('input[name="duration_prices[0][to]"]').keyup(function() {
                    $('input[name="remotly_support_type_durations[0][to]"]').val($(this).val());
                });

                $('input[name="prime_support_type_durations[' + index + '][to]"]').val($(
                    'input[name="duration_prices[' + index + '][to]"]').val());

                $('input[name="duration_prices[' + index + '][to]"]').keyup(function() {
                    $('input[name="prime_support_type_durations[' + index + '][to]"]').val($(this).val());
                });

                index++

            } else {
                emptyRepeater(element)
            }
        })
    </script>


    <script>
        var index = 0
        $('.duration_type').on('change', function() {

            if ($('.duration_type').val() == "") {
                $('.duration_repeater').children().remove()
                $('.price_subscribe').children().remove()
                $('.duration_type option[selected]').removeAttr('selected')
                $('.duration_type option').first().attr('selected', '')
                return
            }
            if ($('.duration_repeater').children().length == 0) {
                $('.duration_repeater').append(`
                    <div class="form-group m-form__group row paid_div mb-3 duration_item ">

                        <div class="col-lg-12 text-right">
                            <button type="button"
                                class="btn btn-sm btn-primary add_price  m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="duration_prices[` + index + `][from]" value="1" readonly
                                    class="form-control from" id="from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="duration_prices[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="duration_prices[` + index + `][price]" class="form-control price"
                                    id="price">
                            </div>
                        </div>


                    </div>
                    <div class="price_subscribe">

                    </div>
                    `)

                $('input[name="remotly_support_type_status"]').attr('checked', true);
                $('.repeater').append(`
                    <div class="form-group m-form__group row paid_div mb-3 duration_item ">

                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="remotly_support_type_durations[` + index + `][from]" value="1" readonly
                                    class="form-control from" id="from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="remotly_support_type_durations[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="remotly_support_type_durations[` + index + `][price]" class="form-control price"
                                    id="price">
                            </div>
                        </div>


                    </div>
                    <div class="price_subscribe">

                    </div>
                    `)

                $('input[name="prime_support_type"]').attr('checked', true);
                $('#prime_space').removeClass('d-none');
                $('#prime_support_type_status_paid').attr('checked', true);

                $('.prime_repeater').append(`
                    <div class="form-group m-form__group row paid_div mb-3 duration_item ">

                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="prime_support_type_durations[` + index + `][from]" value="1" readonly
                                    class="form-control from" id="from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="prime_support_type_durations[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="prime_support_type_durations[` + index + `][price]" class="form-control price"
                                    id="price">
                            </div>
                        </div>


                    </div>
                    <div class="price_subscribe">

                    </div>
                    `)


                $('input[name="remotly_support_type_durations[' + index + '][to]"]').val($(
                    'input[name="duration_prices[' + index + '][to]"]').val());

                $('input[name="duration_prices[0][to]"]').keyup(function() {
                    $('input[name="remotly_support_type_durations[0][to]"]').val($(this).val());
                });

                $('input[name="prime_support_type_durations[' + index + '][to]"]').val($(
                    'input[name="duration_prices[' + index + '][to]"]').val());

                $('input[name="duration_prices[0][to]"]').keyup(function() {
                    $('input[name="prime_support_type_durations[0][to]"]').val($(this).val());
                });


                index++
            }
        })
        $(document).on('click', '.add_price', function(e) {
            e.preventDefault();
            var to = $('.duration_repeater .to').last().val();
            var from = $('.duration_repeater .from').last().val();
            var price = $('.duration_repeater .price').last().val();

            var to_support = $('.support_type_radio .to').last().val();
            var from_support = $('.support_type_radio .from').last().val();
            var price_support = $('.support_type_radio .price').last().val();

            var first_repeater_price = $('.repeater .price').last().val();
            var first_Prime_repeater_price = $('.prime_repeater .price').last().val();

            var repeater_to = $('.append_div_remotly .to').last().val();
            var repeater_price = $('.append_div_remotly .price').last().val();

            var prime_to = $('.append_div .to').last().val();
            var prime_price = $('.append_div .price').last().val();

            if (to == '' || to <= from || price == "") {
                if (to == '' || to <= from) {
                    $('.duration_repeater .to').last().addClass('is-invalid')
                } else {
                    $('.duration_repeater .to').last().removeClass('is-invalid')
                }

                if (price == "") {
                    $('.duration_repeater .price').last().addClass('is-invalid')
                } else {
                    $('.duration_repeater .price').last().removeClass('is-invalid')
                }

                if (first_repeater_price == '') {
                    $('.repeater .price').last().addClass('is-invalid')
                } else {
                    $('.repeater .price').last().removeClass('is-invalid')
                }

                if (first_Prime_repeater_price == '') {
                    $('.prime_repeater .price').last().addClass('is-invalid');
                } else {
                    $('.prime_repeater .price').last().removeClass('is-invalid');
                }

                if (repeater_to == '') {
                    $('.append_div_remotly .form-valid .to').last().addClass('is-invalid');
                } else {
                    $('.append_div_remotly .form-valid .to').last().removeClass('is-invalid')
                }

                if (repeater_price == '') {
                    $('.append_div_remotly .price').last().addClass('is-invalid');
                } else {
                    $('.append_div_remotly .price').last().removeClass('is-invalid')
                }

                if (prime_to == '') {
                    $('.append_div .to').last().addClass('is-invalid');
                } else {
                    $('.append_div .to').last().removeClass('is-invalid')
                }

                if (prime_price == '') {
                    $('.append_div .price').last().addClass('is-invalid');
                } else {
                    $('.append_div .price').last().removeClass('is-invalid')
                }


            } else {
                $('.duration_repeater .price').last().removeClass('is-invalid')
                $('.duration_repeater .to').last().removeClass('is-invalid')

                // Readonly
                $('.duration_repeater .to').last().attr('readonly', true);
                $('.duration_repeater .price').last().attr('readonly', true);

                $('.repeater .to').last().attr('readonly', true);
                $('.repeater .price').last().attr('readonly', true);

                $('.prime_repeater .to').last().attr('readonly', true);
                $('.prime_repeater .price').last().attr('readonly', true);



                to = parseInt(to) + 1;
                to_support = parseInt(to_support) + 1;
                $('.price_div .div_delete').hide();
                html = `
                <div class="form-group m-form__group row price_div">
                    <div class="col-lg-12  text-right div_delete">
                        <button type="button" class="btn btn-sm btn-danger delete_price  m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill m-btn--air"><i class="fa fa-times"></i></button>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('lang.from') }}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="number" required name="duration_prices[` + index + `][from]" value="` +
                    to + `" readonly
                                class="form-control from" id="from">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('lang.to') }}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="number" required name="duration_prices[` + index + `][to]" class="form-control to" id="to">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('lang.price') }}<span class="required"></span></label>
                        <div class="form-valid">
                            <input type="number" required name="duration_prices[` + index + `][price]" class="form-control price"
                                id="price">
                        </div>
                    </div>
                </div>`;

                var element = $('.support_type_radio').parent().parent().parent();
                var name = element.find('input[type="checkbox"]').attr('name');

                html_two =
                    `
                    <div class="form-group m-form__group row paid_div mb-3 price_item price_div append_div_remotly">
                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index +
                    `][from]" value="` + to + `" readonly
                                    class="form-control from" id="from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="` + name + `_durations[` + index + `][price]" class="form-control price"
                                    id="price">
                            </div>
                        </div>
                    </div>
                    <div class="price_subscribe">
                    </div>`

                html_three =
                    `
                    <div class="form-group m-form__group row paid_div mb-3 price_item append_div">

                        <div class="col-md-4">
                            <label>{{ trans('lang.from') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="prime_support_type_durations[` + index +
                    `][from]" value="` + to + `" readonly
                                    class="form-control from" id="from">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.to') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="prime_support_type_durations[` + index + `][to]" class="form-control to" id="to">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>{{ trans('lang.price') }}<span class="required"></span></label>
                            <div class="form-valid">
                                <input type="number" required name="prime_support_type_durations[` + index + `][price]" class="form-control price"
                                    id="price">
                            </div>
                        </div>
                    </div>
                    <div class="price_subscribe">
                    </div>`


                $('.duration_repeater .price_subscribe').append(html);
                element.find('.repeater').append(html_two)
                element.find('.prime_repeater').append(html_three)
                index++

            }

        });

        $(document).on('click', '.delete_price', function(e) {
            e.preventDefault();
            var repaeter = $(this).parent().parent().parent();

            if (repaeter.children().length > 1) {
                repaeter.find('.price_div .div_delete').eq(-2).show();
                repaeter.find('.price_div').eq(-2).show();
            }
            $(this).parent().parent().remove()
            $('.append_div_remotly').last().remove()
            $('.append_div').last().remove();

            $('.duration_repeater .to').last().attr('readonly', false);
            $('.duration_repeater .price').last().attr('readonly', false);

            $('.repeater .to').last().attr('readonly', false);
            $('.repeater .price').last().attr('readonly', false);

            $('.prime_repeater .to').last().attr('readonly', false);
            $('.prime_repeater .price').last().attr('readonly', false);

        })
    </script>
    <script>
        $(document).on('focusout', '.to, .from', function(e) {
            e.preventDefault();
            var parent = $(this).parent().parent().parent();
            var to = parseInt(parent.find('.to').val());
            var from = parseInt(parent.find('.from').val());
            if (from != '' && to != '' && from >= to) {
                swal({
                    title: "",
                    text: "{{ trans('lang.duration_to_must_greater_than_from') }}",
                    type: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ __('lang.ok') }}",
                    cancelButtonText: "{{ __('lang.cancel') }}",
                    closeOnConfirm: true,
                    closeOnCancel: true
                });
                parent.find('.to').val('');
            }


            console.log(to);
            console.log(from);
            console.log(from != '' && to != '' && from >= to);
        });
    </script>
    <script>
        $('#type').change(function() {
            var type = $(this).val();

            if (type == 1) {
                $('#remotly_support_type_status_free').attr('checked', 'checked');
                $('#prime_support_type_status_free').attr('checked', 'checked');
            }
        });
    </script> --}}

@stop
