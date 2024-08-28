@extends('email.layouts.master')

@section('subject', __('mail.new_version'))

@section('content')
    <!-- title -->
    <tr>
        <td style=" padding-bottom: 10px; text-align: center;">
            <p style="color:#595874; font-size: 16px; margin: 0; font-weight: bold; font-family:Almarai;">
                {{ __('mail.edit_version') }}</p>
        </td>
    </tr>
    <tr>
        <td style=" padding-bottom: 20px; padding-top: 15px; text-align: center;">
            <img src="{{ asset('email_assets/assets/img/email_success.png') }}" alt="">
        </td>
    </tr>

    <tr>
        <td style="border-radius: 5px; background-color: #F5F6FA; padding: 30px; ">
            <p style="color:#383B37; font-size: 16px; font-weight: bold; font-family:Almarai; ">
                {{ __('lang.hello_user', ['user' => object_get($user, 'name')]) }},
            </p>
            <p style="color:#595874; font-size: 14px; font-family:Almarai; ">
                {{ 'Version ( ' . $version->name . ' ) Has Been Updated'}}
            </p>
            <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                {{ 'Product : ' . $product->name }}
            </p>
            @if( $product->last_version )
                <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                    {{ 'Version Name : ' . $product->last_version->name }}
                </p>

                <p style="color:#595874; font-size: 16px; font-weight: 400; font-family:Almarai; ">
                    {{ 'Version Date : ' . $product->last_version->date }}
                </p>
            @endif

        </td>
    </tr>
@endsection
