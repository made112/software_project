@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.add_company') }}
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
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.add_company') }}</span>
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
                            <div class="m-portlet__head-caption" id="client_space">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text" style="font-weight: bold">
                                        {{ trans('lang.add_company') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.clients.add') }}" class="add_client_form" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="name">{{ trans('lang.company_name') }}</label>
                                        <input type="text" name="name" id="name" class="name form-control"
                                            placeholder="{{ trans('lang.company_name') }}" autocomplete="off">
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="client_id">{{ trans('lang.company_id') }}</label>
                                        <input type="text" name="client_id" id="client_id" class="client_id form-control"
                                            value="{{ $client_id }}" placeholder="{{ trans('lang.company_id') }}" style="pointer-events: none;">
                                    </div>

                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="email">{{ trans('lang.email') }}</label>
                                        <input type="email" name="email" id="email" class="email form-control"
                                            placeholder="{{ trans('lang.email') }}" autocomplete="off">
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="phone_number">{{ trans('lang.phone_number') }}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="tel"
                                                    value=""
                                                    placeholder="{{ __('lang.phone_number') }}"
                                                    class="form-control  phone-input"
                                                    name="mobile" id="mobile-1" onblur="getPhoneKey(this.id)">
                                                    <input type="hidden" class="form-control mobile_prefix" id="mobile-1-code" name="mobile_prefix" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="country_id">{{ trans('lang.country') }}</label>
                                        <select name="country_id" id="country_id" class="country_id form-control">
                                            @if ($data['counrty'])
                                                @foreach ($data['counrty'] as $c)
                                                    <option value="{{ $c->id }}" data-iso="{{$c->iso2}}"
                                                        @if ($c->country_code == '966') selected @endif>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="city_id">{{ ucwords(trans('lang.city')) }}</label>
                                        <select name="city_id" id="city_id" class="city_id form-control">
                                            @if ($data['cities'])
                                                @foreach ($data['cities'] as $c)
                                                    <option value="{{ $c->id }}">
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-md-6 col-lg-6">
                                        <label for="project_manager">{{ trans('lang.project_manager') }}</label>
                                        <select name="project_manager[]" id="project_manager" class="project_manager form-control" multiple>
                                            @if($data['users'])
                                                @foreach($data['users'] as $user)
                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="status">{{ trans('lang.status') }}</label>
                                        <select name="status" id="status" class="status form-control">
                                            <option value="">{{ trans('lang.status') }}</option>
                                            <option value="1">{{ trans('lang.active') }}</option>
                                            <option value="2">{{ trans('lang.inactive') }}</option>
                                        </select>
                                    </div>
                                </div>

                                 <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="image">{{ __('lang.twitter') . ' (optional)' }} </label>
                                                <input type="text" class="form-control image" name="twitter_link">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <div>
                                                <label for="image">{{ __('lang.website') . ' (optional)' }}</label>
                                                <input type="text" class="form-control image" name="website_link">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="image">{{ trans('lang.logo') . ' (optional)' }}</label>
                                        <input type="file" class="form-control image" name="image" accept="image/*">
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
            separateDialCode: true,
            utilsScript: "https://gd-workshop.com/style/site/assets/lib/intlTelInput/utils.js"
        });

        $('.phone-input').each(function() {


            iti.setCountry('SA');
            $(document).on('change','.country_id',function(e){
                var iso = $(this).find(':selected').data('iso');
                iti.setCountry(iso);
            });
        });

        $(".project_manager").select2();

        $('.add_client_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            phone_number = $('#mobile-1').val();
            country_code = iti.getSelectedCountryData().dialCode;
            formData.set('phone_number',phone_number);
            formData.set('country_code',iti.getSelectedCountryData().dialCode);
            $.ajax({
                url: "{{ route('admin.clients.add') }}",
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
                            confirmButtonText: "حسنا",
                            cancelButtonText: "الغاء",
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
        });


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

    </script>
    <script>
        $('#country_id').change(function() {
            var country_id = $(this).val();

            console.log(country_id);

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
    </script>
@stop
