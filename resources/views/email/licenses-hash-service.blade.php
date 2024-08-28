@extends('email.layouts.master')

@section('subject',trans('lang.license_information'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 18px; margin: 0; ; font-weight: bold; font-family:Almarai;">
                <img src="{{ asset('email_assets/assets/img/check.png') }}">
                {{trans('lang.license_information')}}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px;; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/admin_license.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="padding-bottom: 0; border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 14px; margin-bottom: 26px">
                {{ __('lang.license_code')}} {{$data['license_code']}} ,
            </p>
            <p style="color:#383B37; font-size: 14px; margin-bottom: 26px">
                {{ __('lang.product_id')}} {{$data['product_id']}} ,
            </p>
            <p style="color:#383B37; font-size: 14px; margin-bottom: 26px">
                {{ __('lang.license_expiration_date')}} {{$data['date']}} ,
            </p>

        </td>
    </tr>
    <tr>
        <td style=" text-align: center; padding-bottom: 35px;">
            <a href="{{URL::to('/')}}" style="
                        display: inline-block;
                        margin: auto; margin-top: 20px; text-align: center;
                        width: 200px; height: 50px; line-height: 50px;
                        background: #595874; text-decoration: none;
                        border-radius: 5px; color: #fff;">
                Visit Website
            </a>
        </td>
    </tr>
@endsection
