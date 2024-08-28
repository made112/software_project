@extends('email.layouts.master')

@section('subject', __('mail.welcome_to_cyberx'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.welcome_to_cyberx') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/email_success.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 16px; font-weight: bold; font-family:Almarai; ">
                {{ __('mail.new_client_title', ['user' => object_get($client, 'name')]) }},
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Your client ID is : ' . $client->client_id }}
            </p>
            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0; font-family:Almarai;">
                {{ __('mail.do_not_share_information') }}
            </p>
{{--            <p style="color:#383B37; font-size: 14px; line-height: 28px; margin: 0">--}}
{{--                {{ __('lang.to_know_read_more') }}--}}
{{--            </p>--}}
        </td>
    </tr>
{{--    <tr>--}}
{{--        <td style=" text-align: center; padding-bottom: 35px;">--}}
{{--            <a href="{{ route('admin.clients.show', ['id' => $client->id]) }}"--}}
{{--                style="--}}
{{--                background: #595874;--}}
{{--                border: none;--}}
{{--                margin-top: 20px;--}}
{{--                padding: 10px 20px;--}}
{{--                color: #fff;--}}
{{--                border-radius: 10px;--}}
{{--                text-decoration: none;--}}
{{--                display: inline-block ">--}}
{{--                View Company--}}
{{--            </a>--}}
{{--        </td>--}}
{{--    </tr>--}}
@endsection
