@extends('email.layouts.master')

@section('subject', __('mail.update_product_title'))

@section('content')
    <!-- todo title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.update_product_title') }}
            </p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 20px; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/email_manager.png') }}" alt="">
        </td>
    </tr>
    <!-- info -->
    <tr>
        <td style="border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 16px; font-weight: bold; font-family:Almarai; ">
                {{ __('lang.hello_user', ['user' => object_get($user, 'name')]) }},
            </p>
            <p style="color:#383B37; font-size: 16px; font-family:Almarai; ">
                {{ __('mail.update_product_content', ['product_name' => $product->name])}}
            </p>
        </td>
    </tr>


@endsection