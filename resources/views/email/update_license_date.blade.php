@extends('email.layouts.master')

@section('subject')

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 18px; margin: 0; ; font-weight: bold; font-family:Almarai;">
                {{ __('mail.update_license_date_title') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px;; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/email_manager.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="padding-bottom: 0; border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 14px;  font-weight: bold; margin-bottom: 26px">
                {{ __('lang.hello_user', ['user' => $user->name]) }} ,
            </p>
            <p style="color:#595874; font-size: 14px; line-height: 28px; margin: 0">
                {{ __('mail.update_license_date_content', ['license' => $license->name, 'date' => $license->date ,'product' => $license->product->name]) }}
            </p>
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">
                {{ __('lang.to_know_read_more') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" text-align: center; padding-bottom: 35px;">
            <p style="color:#595874; font-size: 14px; line-height: 28px; margin: 0">
                Please login to your product to see more details about this version.
            </p>
        </td>
    </tr>
@endsection
