@extends('email.layouts.master')

@section('subject', __('mail.new_package'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 18px; margin: 0; ; font-weight: bold; font-family:Almarai;">
                {{ __('mail.new_package') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px;; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/email_success.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="padding-bottom: 0; border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 14px; font-weight: bold; margin-bottom: 26px">
                {{ __('lang.hello_user' , ['user' => $user->name]) }},
            </p>
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
                {{ __('mail.new_package_email_content') }}
            </p>
            <p style="color:#595874; font-size: 14px; font-weight: bold; line-height: 28px; margin: 0">
                {{ 'Package Name : ' . $package->name }}
            </p>
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
                {{ __('lang.to_know_read_more') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" text-align: center; padding-bottom: 35px;">
            <a href="{{URL::to('/home')}}"
               style="display: inline-block; margin: auto; margin-top: 20px; text-align: center; width: 200px; height: 50px; line-height: 50px; background: #595874; text-decoration: none; border-radius: 5px; color: #fff;">
                Visit Website
            </a>
        </td>
    </tr>
@endsection
