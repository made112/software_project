@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.account_settings') }}
@stop
@section('css')
    <style>
        @import "https://unpkg.com/flickity@2/dist/flickity.min.css";

        @import "{{ asset('admin-assets/assets/intlTelInput/intlTelInput.min.css') }}";

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
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.settings') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span
                                                class="m-nav__link-text text-dark">{{ trans('lang.account_settings') }}</span>
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
                                        {{ trans('lang.account_settings') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.setting.update_account') }}" enctype="multipart/form-data"
                                method="post" id="account_settings_form">
                                @csrf


                                <div class="form-group row">
                                    <label for="user_photo" class="col-2 col-form-label">
                                        {{ __('lang.image') }}
                                    </label>
                                    <div class="col-10">

                                        <div class="profile-user change_pic mx-0">
                                            <div class="profile-user-pic">
                                                @if($user->photo)
                                                <img src="{{ object_get($user, 'photo') }}" id="profile-user-pic" alt="">
                                                @else
                                                <img src="{{URL::to('/')}}/admin-assets/assets/default-image.png" id="profile-user-pic" alt="">
                                                @endif
                                            </div>
                                            <label for="change_pic" class="file-upload btn mb-0">
                                                <i class="fa fa-pencil-alt"></i>
                                            </label>
                                            <button type="button" id="remove_pic" class="btn"><i
                                                    class="fas fa-times"></i></button>
                                        </div>
                                        <input id="change_pic" name="user_photo" type="file" accept="image/*" class="d-none form-control">
                                        @error('user_photo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="name" class="col-2 col-form-label">
                                        {{ __('lang.full_name') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="name"
                                            value="{{ old('name', object_get($user, 'name')) }}"
                                            placeholder="{{ __('lang.full_name') }}" class="form-control" id="name">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="username" class="col-2 col-form-label">
                                        {{ __('lang.user_name') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="username"
                                            value="{{ old('username', object_get($user, 'username')) }}"
                                            placeholder="{{ __('lang.username') }}" class="form-control" id="username">
                                        @error('username')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
{{--
                                <div class="form-group row">
                                    <label for="company_id" class="col-2 col-form-label">
                                        {{ __('lang.company_id') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="text" disabled
                                            value="{{ old('company_id', object_get($user, 'company_id')) }}"
                                            placeholder="{{ __('lang.company_id') }}" class="form-control"
                                            id="company_id">
                                        @error('company_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div> --}}


                                <div class="form-group row">
                                    <label for="email" class="col-2 col-form-label">
                                        {{ __('lang.email') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="text" name="email"
                                            value="{{ old('email', object_get($user, 'email')) }}"
                                            placeholder="{{ __('lang.email') }}" class="form-control" id="email">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="mobile" class="col-2 col-form-label">{{ __('lang.mobile') }}</label>
                                    <div class="col-10">

                                        <input type="tel"
                                            data-country="{{ old('mobile_country', object_get($user, 'mobile_country')) }}"
                                            value="{{ old('mobile', object_get($user, 'mobile')) }}"
                                            placeholder="{{ __('lang.mobile') }}"
                                            class="form-control  phone-input @error('mobile') is-invalid @enderror"
                                            name="mobile" id="mobile-1" onblur="getPhoneKey(this.id)" required>
                                        <input type="hidden" class="form-control"
                                            value="{{ old('mobile_prefix', object_get($user, 'mobile_prefix')) }}"
                                            id="mobile-1-code" name="mobile_prefix">
                                        <input type="hidden" class="form-control"
                                            value="{{ old('mobile_country', object_get($user, 'mobile_country')) }}"
                                            id="mobile-1-country" name="mobile_country">

                                        @if ($errors->has('mobile'))
                                            <div class="invalid-feedback d-block"> {{ $errors->first('mobile') }} </div>
                                        @endif
                                        @if ($errors->has('mobile_prefix'))
                                            <div class="invalid-feedback d-block"> {{ $errors->first('mobile_prefix') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="country_code" class="col-2 col-form-label">
                                        {{ ucwords(trans('lang.city')) }}</label>

                                    <div class="col-10">
                                        <select name="city_id" id="city_id" class="city_id form-control" required>
                                            @if (count($cities))
                                                @foreach ($cities as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ object_get($user, 'city_id') == $c->id ? 'selected' : '' }}>
                                                        {{ $c->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('city_id')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
                                            class="btn btn-md px-5  btn-dark">{{ trans('lang.save_changes') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">

                    <div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text" style="font-weight: bold">
                                        {{ trans('lang.change_password') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.setting.change_appsword') }}" enctype="multipart/form-data"
                                method="post" id="reset_password_form">
                                @csrf
                                <div class="form-group row">
                                    <label for="current_password" class="col-2 col-form-label">
                                        {{ __('lang.current_password') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="password" placeholder="{{ __('lang.current_password') }}"
                                            name="current_password" class="form-control" id="current_password">
                                        @error('current_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-2 col-form-label">
                                        {{ __('lang.password') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="password" placeholder="{{ __('lang.password') }}" name="password"
                                            class="form-control" id="password">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="confirm_password" class="col-2 col-form-label">
                                        {{ __('lang.confirm_password') }}
                                    </label>
                                    <div class="col-10">
                                        <input type="password" placeholder="{{ __('lang.confirm_password') }}"
                                            name="password_confirmation" class="form-control" id="confirm_password">
                                        @error('confirm_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
                                            class="btn btn-md px-5 btn-dark">{{ trans('lang.save_changes') }}</button>
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

        $(document).on("click",".iti__country", function(){
            var country_id = $(this).data("country-code");

            $.ajax({
                url: "{{ route('admin.city.select') }}",
                type: 'get',
                data: {
                    country_id: country_id,
                },
                dataType: 'JSON',
                success: function(data) {
                    $("#city_id").select2("val", "");
                    $('#city_id').empty().trigger('change');
                    data.cities.map((city, index) => {
                        var newOption = new Option(city.name, city.id, false, false);
                        $('#city_id').append(newOption).trigger('change');
                    })
                },
                error: function(data) {
                    console.log('Nothing');
                },

            })
        });


        $('.phone-input').each(function() {
            var input = document.querySelector("#" + this.id);
            var country = $("#" + this.id).data("country");
            var iti = window.intlTelInput(input, {
                initialCountry: country,
                /*
                geoIpLookup: function(success, failure) {
                    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        success(countryCode);
                    });
                },*/
                separateDialCode: true,
                utilsScript: "https://gd-workshop.com/style/site/assets/lib/intlTelInput/utils.js"
            });
        });


        $("#country_code").select2({
            minimumInputLength: 2,
            placeholder: "{{ __('lang.country_code') }}",
            ajax: {
                url: "{{ route('admin.country.select') }}",
                dataType: 'json',
                data: function(params) {
                    return {
                        country_name: params.term
                    }
                },
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.name_ar + ' - ' + item.name_en,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    </script>


    <script>
        $("#account_settings_form , #reset_password_form").on("keypress", function(event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        $('#reset_password_form').on('submit', function() {
            event.preventDefault()
            $('#load').show();
            let formData = new FormData(this)

            $.ajax({
                url: "{{ route('admin.setting.change_appsword') }}",
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
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                        });

                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
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
                        confirmButtonText: "{{ __('lang.ok') }}",
                        cancelButtonText: "{{ __('lang.cancel') }}",
                    });
                }
            });
        })

        $('#account_settings_form').on('submit', function() {
            event.preventDefault()
            $('#load').show();
            let formData = new FormData(this)

            $.ajax({
                url: "{{ route('admin.setting.update_account') }}",
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
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                        });

                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
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
                        confirmButtonText: "{{ __('lang.ok') }}",
                        cancelButtonText: "{{ __('lang.cancel') }}",
                    });
                }
            });
        })
    </script>
@endsection
