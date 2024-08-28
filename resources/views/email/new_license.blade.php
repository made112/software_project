@extends('email.layouts.master')

@section('subject', __('mail.new_license_title'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.license_client_title') }}
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
                {{ __('lang.hello_user' , ['user' => object_get($client, 'name')]) }},
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ __('mail.license_client_content') }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Product : ' . object_get($license, 'product.name') }}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'License Code : ' . $license->license_code }}
            </p>
              <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Expired After : ' . $license->days . ' Days'}}
            </p>
        </td>
    </tr>


@endsection
