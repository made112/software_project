@extends('email.layouts.master')

@section('subject', __('mail.new_client_admin_title'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.new_client_admin_title') }}
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
                {{ __('lang.hello_user', ['user' => object_get($setting, 'name')]) }},
            </p>
            <p style="color:#595874; font-size: 14px; font-family:Almarai; ">
                {{ __('mail.new_client_admin_content') }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Client ID : ' . $client->client_id }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Client Name : ' . $client->name }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Client Email : ' . $client->email }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" text-align: center; padding-bottom: 15px;">
            <a href="{{ route('admin.clients.show', ['id' => $client->id]) }}"
                style="    display: inline-block;
                            margin: auto; margin-top: 20px; text-align: center;
                            width: 200px; height: 50px; line-height: 50px;
                            background: #595874; text-decoration: none;
                            border-radius: 5px; color: #fff;">
                View Company
            </a>
        </td>
    </tr>
@endsection