<!DOCTYPE html>

<html lang="ar">



<!-- begin::Head -->

<head>

    <meta charset="utf-8" />

    <title>@yield("title")</title>

    <meta name="description" content="">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!--end::Web font -->
    <!--begin::Page Vendors Styles -->
    <link href="{{ asset('admin-assets/assets/demo/demo1/assets/demo/default/base/style.bundle.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/assets/demo/demo1/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('admin-assets/assets/demo/demo1/assets/vendors/base/vendors.bundle.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('admin-assets/assets/demo/demo1/assets/demo/default/base/scripts.bundle.js') }}"
        type="text/javascript"></script>

    <link href="{{ asset('admin-assets/assets/app/styleFont.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/assets/app/card-widget.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin-assets/jquery.fancybox.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css" />
    <link rel="stylesheet" href="{{ asset('/admin-assets/chat-app/assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin-assets/assets/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('/admin-assets/assets/colors-main/dist/coloris.min.css') }}">

    <script src="{{ asset('/admin-assets/assets/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js') }}"></script>

    <!--end::Base Styles -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ URL::to('/') }}/admin-assets/assets/soft.svg" />

    <style>
        @import "https://unpkg.com/flickity@2/dist/flickity.min.css";

        @import "{{ asset('admin-assets/assets/intlTelInput/intlTelInput.min.css') }}";

    </style>
    <style>
        .bg-light-success {
            background-color: #c9f7f5 !important;
        }
        .clr-field{
            width: 100%;
        }
        /* .datepicker{
            width: 100%
        } */
        .label-info {
            background-color: #5bc0de;
        }
        a#m_aside_header_menu_mobile_toggle {
            display: none !important;
        }
        .bootstrap-tagsinput .label {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }

        .bootstrap-tagsinput {
            display: block;
            width: 100%;
            height: calc(2.95rem + 2px);
            padding: 0.85rem 1.15rem;
            font-size: 1rem;
            line-height: 1.25;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-color: #ebedf2;
            box-shadow: none !important;
        }

        .card.card-custom {
            -webkit-box-shadow: 0 0 30px 0 rgb(82 63 105 / 5%);
            box-shadow: 0 0 30px 0 rgb(82 63 105 / 5%);
            border: 0;
        }

        .m-body .m-content {
            padding: 0px 30px !important;
            background: #c9c9c94d;
        }

        .profile-img img {
            height: 100%;
            width: 100%;
            border-radius: 50%;
        }

        @media (min-width: 1025px) {

            .m-header-menu .m-menu__nav>.m-menu__item.m-menu__item--tabs>.m-menu__link {

                padding: 0px 24px;

            }

        }


        @media (max-width: 767px) {
            .modal-header {
                display: block;
                text-align: center
            }

            .modal .modal-content .modal-header .modal-title {
                margin-bottom: 18px;
            }

        }



        .modal {
            overflow-y: auto !important;
        }

        .modal .modal-dialog {
            position: relative;
        }

        #loading {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: absolute;
            display: none;
            opacity: 0.8;
            z-index: 100000;
            background-color: #fff;
            z-index: 199;
            text-align: center;
        }

        #load {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: fixed;
            display: block;
            opacity: 0.8;
            z-index: 100000;
            background-color: #fff;
            z-index: 199;
            text-align: center;
        }

        #loading-image {
            position: absolute;
            top: 50%;
            z-index: 200;
            right: 50%;
            z-index: 200;
        }

        @media (min-width: 1025px) {

            .m-header-menu .m-menu__nav>.m-menu__item.m-menu__item--tabs.m-menu__item--active>.m-menu__link .m-menu__link-text:hover {

                color: #ec3853;

            }

        }

        .active_sub_menu {

            background: #f1f1f5;

            border-radius: 3rem;

        }
        .reset,.delete-multiple{
            padding: 9px 14px;
            width: 100%;
        }
        .user_data {

            padding-top: 28px !important;

            line-height: 22px;

            text-align: justify;

            margin-left: 10px;

            color: #fff;

        }

        .user_data a {

            color: #fff;

        }

        .m-header--minimize-on .user_data {

            padding-top: 14px !important;

            color: #181c32 !important;

        }



        .m-header--minimize-on .user_data a {

            color: #181c32 !important;

        }

        /* .swal2-icon.swal2-success [class^=swal2-success-line][class$=long] {
            right: .5em;
            left: 0;
            -webkit-transform: rotate(135deg);
            transform: rotate(135deg);
        }

        .swal2-icon.swal2-success [class^=swal2-success-line][class$=tip] {
            right: unset;
            left: .875em;
            width: 1.5625em;
            -webkit-transform: rotate(50deg);
            transform: rotate(50deg);
        } */

        /* */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered,
        .select2-container--default .select2-selection--multiple {
            height: calc(2.95rem + 2px) !important;
            padding: 0.45rem 1.15rem !important;
            width: 100% !important;
            border-color: #ebedf2 !important;
            color: #575962;
        }

        .select2-container--default .select2-selection--single {
            height: calc(2.95rem + 2px) !important;
            border-color: #ebedf2 !important;
            color: #575962;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 23px !important;
        }

        .datepicker.datepicker-orient-top{
            z-index: 1000000 !important;
        }
        body .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__heading .m-menu__link-text,body .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item>.m-menu__link .m-menu__link-text{
            font-size: 13px !important;
        }
    </style>

    <style type="text/css">
        /*@font-face {*/

        /*  font-family: Cairo-Light;*/

        /*  src: url('/assets/fonts/Cairo-Light.ttf');*/

        /*}*/

        /*body,h1,h2,h3,h4,h5,h6,p,a,span,th,td,table,button,input::placeholder,textarea::placeholder,select,option,btn {*/

        /*    font-family: Cairo-Light !important;*/

        /*}*/

        .m-subheader .m-subheader__title {

            font-size: 16px !important;

            font-weight: bold !important;

        }

        .table thead th {

            font-weight: bold;

        }

        label {

            font-weight: 600;

        }

        select {

            padding: 0 1rem !important;

        }

        .btn.btn-light-primary {

            color: #6993ff;

            background-color: #e1e9ff;

            border-color: transparent;

        }

        .btn.btn-light-primary.focus:not(.btn-text),
        .btn.btn-light-primary:focus:not(.btn-text),
        .btn.btn-light-primary:hover:not(.btn-text):not(:disabled):not(.disabled) {

            color: #fff;

            background-color: #6993ff;

            border-color: transparent;

        }

        .btn.btn-light-primary i {

            color: #6993ff;

        }

        .btn.btn-icon i {

            padding: 0;

            margin: 0;

        }

        .ki-bold-more-ver:before {

            content: "";

        }

        .ki:before {

            font-family: Ki;

            font-style: normal;

            font-weight: 400;

            font-variant: normal;

            line-height: 1;

            text-decoration: inherit;

            text-rendering: optimizeLegibility;

            text-transform: none;

            -moz-osx-font-smoothing: grayscale;

            -webkit-font-smoothing: antialiased;

            font-smoothing: antialiased;

        }

        .btn.btn-light-primary.focus:not(.btn-text) i,
        .btn.btn-light-primary:focus:not(.btn-text) i,
        .btn.btn-light-primary:hover:not(.btn-text):not(:disabled):not(.disabled) i {

            color: #fff;

        }

        ul.pagination {

            justify-content: center;

        }

        .required {

            color: red;

        }

        p.namecompany {

            color: #fff !important;

        }

        .m-header--minimize-off p.namecompany {

            color: #fff !important;

        }

        .m-header--minimize-on p.namecompany {



            color: #e0315c !important;

        }


        @media (min-width: 1025px) {
            .m-dropdown.m-dropdown--align-center .m-dropdown__wrapper {
                margin-left: -350px !important;
            }
        }

        .m-topbar .m-topbar__nav.m-nav>.m-nav__item.m-topbar__notifications.m-topbar__notifications--img.m-dropdown--arrow .m-dropdown__arrow {
            right: 2% !important;
            left: unset !important;
        }

        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--active::before {
            position: absolute;
            content: '';
            top: 0;
            left: 7%;
            height: 100%;
            width: 100%;
            background: #f2f3f8;
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }

        .btn-black {
            background-color: #2c2e3e;
            border-color: #2c2e3e;
        }

        .data-content {
            padding: 0 30px;
        }

        .m-aside-menu .m-menu__nav>.m-menu__item>.m-menu__link {
            height: 36px !important;
            margin-bottom: 15px !important;
        }

        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__link .m-menu__link-text {
            color: #2c2e3e !important;
            font-size: 13px !important;
        }

        .m-aside-menu.m-aside-menu--skin-dark .m-menu__nav>.m-menu__item.m-menu__item--active>.m-menu__link .m-menu__link-icon {
            color: #2c2e3e !important;
            font-size: 16px !important;
        }

    </style>

    <style>
        /* change_pic */

        .change_pic {
            position: relative;
            width: 120px;
            height: 120px;
            margin: auto;
            border: none;
        }

        .change_pic .profile-user-pic {
            width: 120px;
            height: 120px;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0.5rem 1.5rem 0.5rem rgb(0 0 0 / 8%);
        }

        .change_pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .change_pic .btn {
            position: absolute;
            top: -10px;
            right: -10px;
            padding: 0;
            width: 25px;
            height: 25px;
            min-height: 25px;
            line-height: 20px;
            font-size: 12px;
            border-radius: 50%;
            background: #fff;
            color: #3F4254;
            box-shadow: 0px 9px 16px 0px rgb(24 28 50 / 25%)
        }

        [ dir="rtl"] .change_pic .btn {
            right: auto;
            left: -10px;
        }

        .change_pic #remove_pic {
            top: auto;
            bottom: -15px;
            color: #fff;
            background: rgb(209 71 71) !important
        }


        .tooltip-inner {
            background: #43425d
        }

        .bs-tooltip-auto[data-popper-placement^=right] .tooltip-arrow::before,
        .bs-tooltip-end .tooltip-arrow::before {
            border-right-color: #43425d;
        }

        .bs-tooltip-auto[data-popper-placement^=left] .tooltip-arrow::before,
        .bs-tooltip-end .tooltip-arrow::before {
            border-left-color: #43425d;
        }

        body .m-header-menu .m-menu__nav.submenu_logo{
            display: none;
        }
        body.m-aside-left--minimize .m-header-menu .m-menu__nav.submenu_logo{
            display: table-row;
        }
        body{
            overflow-x: hidden;
        }

        .m-body .m-content,
        .m-content--skin-light2 .m-body {
           background-color: #f5f6fa !important;
        }
    </style>

    @yield("css")

</head>



<!-- begin::Body -->

<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <div class="m-grid m-grid--hor m-grid--root m-page">
        @include('admin.layout.subheader')
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            @include('admin.layout.top_menu')

            @yield("page-content")
        </div>
        <!-- end::Footer -->

    </div>

</body>



<div id="load">
    <img id="loading-image" src="/admin-assets/assets/ajax-loader.gif" alt="Loading..." />
</div>
<!--end::Base Scripts -->

<!--begin::Page Vendors Scripts -->
<!--end::Page Vendors Scripts -->

<!--begin::Page Snippets -->

<!--end::Page Snippets -->

<!-- begin::Page Loader -->

<script>
    $(document).ready(function(e) {
        $("#load").hide();
        $('#loading').hide();
    });
    $(window).on('load', function() {

        $('body').removeClass('m-page--loading');

    });
</script>

{{-- <script src="{{asset('admin_assets/ckeditor/ckeditor.js')}}" type="text/javascript"></script> --}}

{{-- <script src="{{asset('admin_assets/ckeditor/styles.js')}}" type="text/javascript"></script> --}}

{{-- <script src="{{asset('admin_assets/jquery.fancybox.min.js')}}"></script> --}}
<script src="{{ asset('admin-assets/assets/app/ckeditors/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin-assets/jquery.fancybox.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/admin-assets/assets/colors-main/dist/coloris.min.js') }}"></script>
<script>
    $('.date-picker').datepicker({

        uiLibrary: 'bootstrap4',

        format: "yyyy-mm-dd",

        language: "ar",

        startDate: new Date(),

        rtl: true,

        autoclose: true,
        todayHighlight: true

    });
    Coloris({
      el: '.coloris',
      swatches: [
        '#264653',
        '#2a9d8f',
        '#e9c46a',
        '#f4a261',
        '#e76f51',
        '#d62828',
        '#023e8a',
        '#0077b6',
        '#0096c7',
        '#00b4d8',
        '#48cae4'
      ]
    });
</script>

<script>
    $('[data-toggle="tooltip"]').tooltip();
</script>


<script>
    $('.country_code').select2({
        placeholder: "{{ ucwords(__('lang.select') . ' ' . trans('lang.country')) }}"
    });
    $('.country_id').select2({
        placeholder: "{{ ucwords(__('lang.select') . ' ' . trans('lang.country')) }}"
    });
    $('.city_id').select2({
        placeholder: "{{ ucwords(__('lang.select') . ' ' . trans('lang.city')) }}",
        allowClear: true,
    });

    {{--$('.country_id').on('change', function() {--}}
    {{--    if ($('.city_id').length > 0) {--}}
    {{--        $('.city_id').find('option').remove().end()--}}
    {{--        $('#select2-city_id-results.select2-results__options').remove()--}}

    {{--        $.ajax({--}}
    {{--            url: "{{ route('admin.city.select') }}",--}}
    {{--            type: "get",--}}
    {{--            data: {--}}
    {{--                country_id: $('.country_id').val()--}}
    {{--            },--}}
    {{--            success: function(data) {--}}
    {{--                var response = JSON.parse(data)--}}

    {{--                // console.log(response);--}}
    {{--                response.map((city, index) => {--}}
    {{--                    var newOption = new Option(city.name, city.id, false, false);--}}
    {{--                    $('#city_id').append(newOption).trigger('change');--}}
    {{--                })--}}
    {{--            }--}}
    {{--        });--}}
    {{--    }--}}

    {{--})--}}
    $('.time_zone').select2();
</script>
<script>
    /*------------------------------------
        Change Pic User From Profile
    ----------------------------------------*/

    $('#remove_pic').hide();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#profile-user-pic').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#change_pic").change(function() {
        if ($('#change_pic').val() != "") {
            $('#remove_pic').show();
        } else {
            $('#remove_pic').hide();
        }
        readURL(this);
    });


    $('#remove_pic').click(function() {
        $('#change_pic').val('');
        $(this).hide();
        $('#profile-user-pic').attr('src',
            "{{ asset('uploads/default-image.png') }}"
        );
    });
</script>
<script>
    @if (session()->has('success'))
        swal({
        title: "",
        text: "{{ session('success') }}",
        type: "success",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ __('lang.accept') }}",
        cancelButtonText: "{{ __('lang.cancel') }}",
        closeOnConfirm: true,
        closeOnCancel: true
        });
    @elseif (session()->has('error'))
        swal({
        title: "{{ session('error') }}",
        text: data["data"],
        type: "error",
        showCancelButton: false,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "{{ __('lang.ok') }}",
        cancelButtonText: "{{ __('lang.cancel') }}",
        closeOnConfirm: true,
        closeOnCancel: true
        });
    @endif

    function setDateFormat(date) {
        DateObj = new Date(date);
        var day = DateObj.getDate();
        var month = DateObj.getMonth() + 1;
        var fullYear = DateObj.getFullYear().toString();
        var setformattedDate = '';
        setformattedDate = fullYear + '-' + getDigitToFormat(month) + '-' + getDigitToFormat(day);
        return setformattedDate;
    }

    function getDigitToFormat(val) {
        if (val < 10) {
            val = '0' + val;
        }
        return val.toString();
    }

    function getDiffDate(fromdate, todate) {
        var dt1 = new Date(fromdate);
        var dt2 = new Date(todate);
        var time_difference = dt2.getTime() - dt1.getTime();
        var result = time_difference / (1000 * 60 * 60 * 24);
        return result;
    }
</script>
<script src=" {{ asset('admin-assets/assets/intlTelInput/intlTelInput.min.js') }}"></script>
<script>
     $('[type="tel"]').keyup(function(e) {
        $(this).attr('maxlength', '9');
        $(this).attr('minlength', '9');
        // if (/\D/g.test(this.value)) {
        //     this.value = this.value.replace(/\D/g, '');
        // }
        var value = $(this).val();
        // value = value.replace(/^(0*)/, "");
        $(this).val(value);
    });

    function getPhoneKey(id) {
        var input = document.querySelector('#' + id);
        var iti = window.intlTelInputGlobals.getInstance(input);
        var countryData = iti.getSelectedCountryData();
        var isoCountry = countryData.iso2.toUpperCase()
        $('#' + id + "-code").val(iti.getSelectedCountryData().dialCode);
        $('#' + id + "-country").val(iti.getSelectedCountryData().iso2);
        $("#" + id).attr("data-country", iti.getSelectedCountryData().iso2);
        $(".country_id option[data-iso='" + isoCountry + "']").prop("selected", true).trigger('change');
    }

</script>
<script>
    var token = "{{ csrf_token() }}";
    $('#client_id').change(function() {
       var client_id = $(this).val();

       $.ajax({
           url: '{{ route('getEmail') }}',
           type: 'POST',
           data: {
               _token: token,
               client_id: client_id,
           },
           success: function(data) {
               $('#client_select').empty();
               $('#client_select').append( data.client.email);
           },
           error: function(data){
               alert(data)
           }
       })
    });
</script>
<script>
    var token = "{{ csrf_token() }}";
    $('#product_id').change(function() {
        var product_id = $(this).val();
        var client_id = $('#client_id').val();

        $.ajax({
            url: '{{ route('getContact') }}',
            type: 'POST',
            data: {
                _token: token,
                product_id: product_id,
                client_id: client_id,
            },
            success: function(data) {
                $.each(data.clients, function(One_key, One_value) {
                    $.each(One_value, function(two_key, two_value) {
                        $('#product_select').append('<span>'+ two_value.user.name + '(' + two_value.user.email +') , </span>')
                    })
                })
            },
            error: function(data){
                alert(data)
            }
        })
    });
</script>

@yield("js")



</body>

</html>
