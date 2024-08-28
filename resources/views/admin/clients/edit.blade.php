@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.edit_company') }}
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
                                        <a href="/admin/clients" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.companies') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.edit_company') }}</span>
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
                                        {{ trans('lang.edit_company') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.clients.update') }}" class="add_client_form" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{ $clients->id }}">
                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="name">{{ trans('lang.company_name') }}</label>
                                        <input type="text" name="name" id="name" value="{{ $clients->name }}"
                                            class="name form-control" placeholder="{{ trans('lang.company_name') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="client_id">{{ trans('lang.company_id') }}</label>
                                        <input type="text" name="client_id" id="client_id" class="client_id form-control"
                                            value="{{ $clients->client_id }}" placeholder="{{ trans('lang.company_id') }}" style="pointer-events: none">
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="email">{{ trans('lang.email') }}</label>
                                        <input type="email" name="email" id="email" class="email form-control"
                                            value="{{ $clients->email }}" placeholder="{{ trans('lang.email') }}">
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="phone_number">{{ trans('lang.phone_number') }}</label>
                                            <input type="tel"
                                                value="{{$clients->phone_number}}"
                                                placeholder="{{ __('lang.phone_number') }}"
                                                class="form-control  phone-input"
                                                name="mobile" id="mobile-1" onblur="getPhoneKey(this.id)" required>
                                                <input type="hidden" value="{{ $clients->country_code }}"  class="form-control mobile_prefix"  id="mobile-1-code" name="mobile_prefix">


                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="country_id">{{ trans('lang.country') }}</label>
                                        <select name="country_id" id="country_id" class="country_id form-control">
                                            @if ($data['counrty'])
                                                @foreach ($data['counrty'] as $c)
                                                    <option value="{{ $c->id }}" data-iso="{{$c->iso2}}"
                                                        @if ($c->id == $clients->country_id) selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city_id">{{ ucwords(trans('lang.city')) }}</label>
                                        <select name="city_id" id="city_id" class="city_id form-control" required>
                                            @if ($data['cities'])
                                                @foreach ($data['cities'] as $c)
                                                    <option value="{{ $c->id }}" {{  object_get( $clients , 'city_id') == $c->id ? 'selected' : '' }}>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    @php
                                        $managers = $clients->projects_manager->pluck('manager_id')->ToArray();
                                    @endphp
                                    <div class="col-md-6 col-lg-6">
                                        <label for="project_manager">{{ trans('lang.project_manager') }}</label>
                                        <select name="project_manager[]" id="project_manager" class="project_manager form-control" multiple>
                                            @if($data['users'])
                                                @foreach($data['users'] as $user)
                                                    <option value="{{$user->id}}" @if(in_array($user->id,$managers)) selected  @endif>{{$user->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="status">{{ trans('lang.status') }}</label>
                                        <select name="status" id="status" class="status form-control">
                                            <option value="">{{ trans('lang.status') }}</option>
                                            <option value="1" @if ($clients->status == 1) selected @endif>
                                                {{ trans('lang.active') }}</option>
                                            <option value="2" @if ($clients->status == 2) selected @endif>
                                                {{ trans('lang.inactive') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="image">{{ __('lang.twitter') . ' (optional)' }}</label>
                                                <input type="text" class="form-control image" value="{{ $clients->twitter_link }}" name="twitter_link">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="image">{{ __('lang.website') . ' (optional)' }}</label>
                                                <input type="text" class="form-control image" value="{{ $clients->website_link }}"  name="website_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="image">{{ trans('lang.logo') . ' (optional)' }}</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control image" name="image" accept="image/*">
                                            <a href="{{$clients->image}}" data-fancybox="gallary" class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-image icon-lg"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
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
        var input =  document.querySelector("#mobile-1");
        var country = 'SA';
        var iti = window.intlTelInput(input, {
                initialCountry: country,
            /*
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },*/
            formatOnDisplay: false,
            utilsScript: "https://gd-workshop.com/style/site/assets/lib/intlTelInput/utils.js"
        });

        $('.phone-input').each(function() {
            @if($country)
           iti.setCountry("{{$country->iso2}}");
           @endif
           $(document).on('change','.country_id',function(e){
                var iso = $(this).find(':selected').data('iso');
                iti.setCountry(iso);
            });
        });

        $('.add_client_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            phone_number = $('#mobile-1').val();
            country_code = iti.getSelectedCountryData().dialCode;
            formData.set('phone_number',phone_number);
            formData.set('country_code',iti.getSelectedCountryData().dialCode);
            $.ajax({
                url: "{{ route('admin.clients.update') }}",
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
                        location.replace("{{ route('admin.clients.index') }}");
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


        $(".project_manager").select2();

        $('#country_id').change(function () {
            conutry_id = $(this).val();
            $.ajax({
                url: "{{ route('admin.city.select') }}",
                type: 'get',
                data: {
                    country_id: conutry_id,
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
    </script>
@stop
