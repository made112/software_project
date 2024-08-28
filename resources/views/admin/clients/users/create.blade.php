@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.add_user') }}
@stop
@section('css')

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
                                        <a href="/admin/clients/{{$client->id}}" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.clients') }}</span>
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
                                                style="font-weight:bold">{{ object_get($client, 'name') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark">{{ trans('lang.add_user') }}</span>
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
                                        {{ trans('lang.add_user') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.clients.users.store', ['clientId' => $client->id]) }}"
                                class="add_user_form" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-2 col-form-label" for="image">{{ trans('lang.image') }}</label>


                                    <div class="profile-user change_pic mx-0">
                                        <div class="profile-user-pic">
                                            <img src="{{ asset('admin-assets/assets/app/media/img/users/client.png') }}" id="profile-user-pic" alt="">
                                        </div>
                                        <label for="change_pic" class="file-upload btn mb-0">
                                            <i class="fa fa-pencil-alt"></i>
                                        </label>
                                        <button type="button" id="remove_pic" class="btn"><i class="fas fa-times"></i></button>
                                    </div>
                                    <input id="change_pic" name="image" type="file" class="d-none form-control">



                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="first_name">{{ trans('lang.first_name') }}</label>
                                        <input type="text" name="first_name" id="first_name" class="first_name form-control"
                                            placeholder="{{ trans('lang.first_name') }}">
                                    </div>
                                    <div class="col-md-6 col-lg-6">
                                        <label for="last_name">{{ trans('lang.last_name') }}</label>
                                        <input type="text" name="last_name" id="last_name" class="last_name form-control"
                                            placeholder="{{ trans('lang.last_name') }}">
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="client_id">{{ trans('lang.client_id') }}</label>
                                        <input type="text" name="client_id" disabled id="client_id"
                                            class="client_id form-control" value="{{ $client->client_id }}"
                                            placeholder="{{ trans('lang.client_id') }}">
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="email">{{ trans('lang.email') }}</label>
                                        <input type="email" name="email" id="email" class="email form-control"
                                            placeholder="{{ trans('lang.email') }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="job_title">{{ trans('lang.job_title') }}</label>
                                        <input type="text" name="job_title" id="job_title" class="email form-control"
                                            placeholder="{{ trans('lang.job_title') }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12">
                                        <label for="product_id">{{ trans('lang.product') }}</label>
                                        <select name="products[]" id="product_id" multiple class="product_id form-control">
                                            @if (count($client->products))
                                                @foreach ($client->products as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ object_get($product, 'name') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="phone_number">{{ trans('lang.phone_number') }}</label>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="tel"
                                                       value=""
                                                       placeholder="{{ __('lang.phone_number') }}"
                                                       class="form-control  phone-input"
                                                       name="mobile" id="mobile-1" onblur="getPhoneKey(this.id)" required>
                                                <input type="hidden" class="form-control mobile_prefix" value="966"  id="mobile-1-code" name="mobile_prefix">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="country_id">{{ trans('lang.country') }}</label>
                                        <select name="country_id" id="country_id" class="country_id form-control">
                                            @if (count($countries))
                                                @foreach ($countries as $c)
                                                    <option value="{{ $c->id }}" data-iso="{{$c->iso2}}" data-code="{{$c->country_code}}"
                                                        @if ($c->country_code == '966') selected @endif>
                                                        {{ object_get($c, 'name_' . app()->getLocale()) }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city_id">{{ ucwords(trans('lang.city')) }}</label>
                                        <select name="city_id" id="city_id" class="city_id form-control"
                                            required>
                                            @if (count($cities))
                                                @foreach ($cities as $c)
                                                    <option value="{{ $c->id }}"
                                                        {{ object_get($client, 'city_id') == $c->id ? 'selected' : '' }}>
                                                        {{ $c->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <div class="col-md-6 col-lg-6">
                                        <label for="status">{{ trans('lang.status') }}</label>
                                        <select name="status" id="status" class="status form-control">
                                            <option value="">{{ trans('lang.status') }}</option>
                                            <option value="1">{{ trans('lang.active') }}</option>
                                            <option value="2">{{ trans('lang.inactive') }}</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="gender">{{ trans('lang.gender') }}</label>
                                        <select name="gender" id="gender" class="gender form-control">
                                            <option value="">{{ trans('lang.gender') }}</option>
                                            @if($gender)
                                                @foreach($gender as $key=>$g)
                                                <option value="{{$key}}">{{$g}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    {{-- <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="phone_number">{{ trans('lang.phone_number') }}</label>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="country_code" id="country_code"
                                                    class="country_code form-control">
                                                    @if (count($countries))
                                                        @foreach ($countries as $c)
                                                            <option value="{{ $c->country_code }}"
                                                                @if ($c->country_code == '966') selected @endif>
                                                                {{ $c->country_code }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" name="phone_number" id="phone_number"
                                                    class="phone_number form-control"
                                                    placeholder="{{ trans('lang.phone_number') }}">
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>


                                {{-- <div class="form-group row">



                                </div> --}}

                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
                                            class="btn btn-md px-5 btn-dark">{{ trans('lang.submit') }}</button>
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
        $('#product_id').select2({
            placeholder: "{{ __('lang.select') }} {{ __('lang.product') }}",
            allowClear: true
        });

        var input =  document.querySelector("#mobile-1");
        var country = 'SA';
        var iti = window.intlTelInput(input, {
            initialCountry: country,
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

        $('.add_user_form').on('submit', function(e) {
            e.preventDefault();
            $('#load').show();
            var formData = new FormData(this);
            phone_number = $('#mobile-1').val();
            country_code = iti.getSelectedCountryData().dialCode;
            formData.set('phone_number',phone_number);
            formData.set('country_code',iti.getSelectedCountryData().dialCode);
            $.ajax({
                url: "{{ route('admin.clients.users.store', ['clientId' => $client->id]) }}",
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
                        location.replace("{{ route('admin.clients.show', ['id' => $client->id]) }}");
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
    <script>
        $(document).on('change','.country_id',function(e){
            var code = $(this).find(':selected').data('code');
            $('#country_code').val(code).trigger('change');
        });
    </script>
    <script>
         $('.phone-input').each(function() {
            $(document).on('change','.country_id',function(e){
                var iso = $(this).find(':selected').data('iso');
                iti.setCountry(iso);
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
@stop
