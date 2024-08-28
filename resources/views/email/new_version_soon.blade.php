@extends('email.layouts.master')

@section('subject', __('mail.new_product_version_title'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.new_product_version_title') }}</p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/email_success.png') }}"alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 16px; font-weight: bold; font-family:Almarai; ">
                {{ __('lang.hello_user', ['user' => $reciever->name]) }}
            </p>
            <p style="color:#595874; font-size: 14px; font-family:Almarai; ">
                {{ __('lang.new_version_soon_email_content') }}
{{--                {{ __('lang.new_version_soon_email_content' , ['product' => $version->product->name ,'date'=> $version->date]) }}--}}
            </p>
{{--            <h4>--}}
{{--                Version : {{  $version->name }}--}}
{{--            </h4>--}}

            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Product : ' . $product->name }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Version Name : ' . $product->last_version->name }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Version Date : ' . $product->last_version->date }}
            </p>

            {{--            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">--}}
{{--                {{ __('lang.to_know_read_more') }}--}}
{{--            </p>--}}
        </td>
    </tr>
{{--    <tr>--}}
{{--        <td style=" text-align: center; padding-bottom: 35px;">--}}
{{--            <a href="{{URL::to('/')}}" style="--}}
{{--                            display: inline-block;--}}
{{--                            margin: auto; margin-top: 20px; text-align: center;--}}
{{--                            width: 200px; height: 50px; line-height: 50px;--}}
{{--                            background: #383B37; text-decoration: none;--}}
{{--                            border-radius: 5px; color: #fff;">--}}
{{--                Visit Website--}}
{{--            </a>--}}
{{--        </td>--}}
{{--    </tr>--}}
@endsection
