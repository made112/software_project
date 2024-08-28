@extends('admin.layout.master_layout')
@section('title')
    {{ trans('lang.email_settings') }}
@stop


@section('page-content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <!-- END: Subheader -->
        <div class="m-content mb-4">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-subheader p-0 ">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">

                                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                                    <li class="m-nav__item m-nav__item--home">
                                        <a href="#" class="m-nav__link m-nav__link--icon">
                                            <i class="m-nav__link-icon la la-home text-dark"></i>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="/admin/dashboard" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.dashboard') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text text-dark"
                                                style="font-weight:bold">{{ trans('lang.settings') }}</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span class="m-nav__link-text">/</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="#" class="m-nav__link ">
                                            <span
                                                class="m-nav__link-text text-dark">{{ trans('lang.email_settings') }}</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>

                            <div class="m-demo__preview  m-demo__preview--btn">


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="data-content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="m-portlet m-portlet--mobile" id="m_blockui_2_portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text" style="font-weight: bold">
                                        {{ trans('lang.email_settings') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <form action="{{ route('admin.setting.update_email_setting') }}" id="email_settings_form"
                                class="add_settings_form" method="post">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label for="email_method">
                                            <div class="position-relative">
                                                {{ trans('lang.email_method') }}
                                                <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.email_method') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <select name="email_method" id="email_method" class="form-control">
                                            @foreach ($emailMethods as $method)
                                                <option value="{{ $method['id'] }}"
                                                    {{ !is_null(object_get($emailSettings, 'email_method')) &&object_get($emailSettings, 'email_method') == $method['id']? 'selected': '' }}>
                                                    {{ $method['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('email_method')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label for="api_blacklisted_domain">
                                            <div class="position-relative">
                                                {{ trans('lang.from_email') }}
                                                <label role="button" data-toggle="tooltip" data-placement="right" title="{{ __('tooltip.from_email') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                        <path id="Icon_awesome-question-circle" data-name="Icon awesome-question-circle" d="M14.563,7.563a7,7,0,1,1-7-7A7,7,0,0,1,14.563,7.563ZM7.75,2.877a3.656,3.656,0,0,0-3.29,1.8.339.339,0,0,0,.077.459l.979.743a.339.339,0,0,0,.47-.06c.5-.64.85-1.01,1.617-1.01.577,0,1.29.371,1.29.93,0,.423-.349.64-.918.959-.664.372-1.543.835-1.543,1.994V8.8a.339.339,0,0,0,.339.339H8.353A.339.339,0,0,0,8.692,8.8V8.767c0-.8,2.348-.837,2.348-3.011A3.22,3.22,0,0,0,7.75,2.877Zm-.188,7a1.3,1.3,0,1,0,1.3,1.3A1.3,1.3,0,0,0,7.563,9.877Z" transform="translate(-0.563 -0.563)" fill="#43425d"/>
                                                    </svg>
                                                </label>
                                            </div>
                                        </label>
                                        <input type="text" name="from_email" id="from_email"
                                            placeholder="{{ trans('lang.from_email') }}" class="form-control"
                                            value="{{ object_get($emailSettings, 'from_email', old('from_email')) }}">
                                        @error('from_email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="license_expiring_email_title">{{ trans('lang.license_expiration_email_title') }}</label>
                                        <input type="text" name="license_expiring_email_title"
                                            id="license_expiring_email_title"
                                            placeholder="{{ trans('lang.license_expiration_email_title') }}"
                                            class="form-control"
                                            value="{{ object_get($emailSettings, 'license_expiring_email_title', old('license_expiring_email_title')) }}">
                                        @error('license_expiring_email_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="license_expiring_email_title">{{ trans('lang.support_ending_email_title') }}</label>
                                        <input type="text" name="support_ending_email_title" id="support_ending_email_title"
                                            placeholder="{{ trans('lang.support_ending_email_title') }}"
                                            class="form-control"
                                            value="{{ object_get($emailSettings, 'support_ending_email_title', old('support_ending_email_title')) }}">
                                        @error('support_ending_email_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="license_expiring_email_template">{{ trans('lang.license_expiring_email_template') }}</label>
                                        <textarea type="text" name="license_expiring_email_template"
                                            id="license_expiring_email_template"
                                            placeholder="{{ trans('lang.license_expiring_email_template') }}"
                                            class="form-control ckeditor">
                                                                                    {{ object_get($emailSettings, 'license_expiring_email_template', old('license_expiring_email_template')) }}
                                                                            </textarea>
                                        @component('admin.setting.email_variables')
                                        @endcomponent
                                        @error('license_expiring_email_template')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="support_ending_email_template">{{ trans('lang.support_ending_email_template') }}</label>
                                        <textarea type="text" name="support_ending_email_template"
                                            id="support_ending_email_template"
                                            placeholder="{{ trans('lang.support_ending_email_template') }}"
                                            class="form-control ckeditor">
                                                                                    {{ object_get($emailSettings, 'support_ending_email_template', old('support_ending_email_template')) }}
                                                                            </textarea>
                                        @component('admin.setting.email_variables')
                                        @endcomponent
                                        @error('support_ending_email_template')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-md-6 col-lg-6 checkbox-inline">
                                        <label class="checkbox checkbox-rounded" for="license_expired_notification">
                                            <input type="checkbox" name="license_expired_notification"
                                                id="license_expired_notification"
                                                {{ object_get($emailSettings, 'license_expired_notification', old('license_expired_notification'))? 'checked': '' }} />
                                            <span></span>
                                            {{ trans('lang.license_expired_notification') }}
                                        </label>
                                        @error('license_expired_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 col-lg-6 checkbox-inline">
                                        <label class="checkbox checkbox-rounded" for="support_end_email_notification">
                                            <input type="checkbox" name="support_end_email_notification"
                                                id="support_end_email_notification"
                                                {{ object_get($emailSettings, 'support_end_email_notification', old('support_end_email_notification'))? 'checked': '' }} />
                                            <span></span>
                                            {{ trans('lang.support_end_email_notification') }}
                                        </label>
                                        @error('support_end_email_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="update_license_expiring_email_title">{{ trans('lang.update_license_expiring_email_title') }}</label>
                                        <input type="text" name="update_license_expiring_email_title"
                                            id="update_license_expiring_email_title"
                                            placeholder="{{ trans('lang.update_license_expiring_email_title') }}"
                                            class="form-control"
                                            value="{{ object_get($emailSettings,'update_license_expiring_email_title',old('update_license_expiring_email_title')) }}">
                                        @error('update_license_expiring_email_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="update_support_ending_email_title">{{ trans('lang.update_support_ending_email_title') }}</label>
                                        <input type="text" name="update_support_ending_email_title"
                                            id="update_support_ending_email_title"
                                            placeholder="{{ trans('lang.update_support_ending_email_title') }}"
                                            class="form-control"
                                            value="{{ object_get($emailSettings, 'update_support_ending_email_title', old('update_support_ending_email_title')) }}">
                                        @error('update_support_ending_email_title')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="update_license_expiring_email_template">{{ trans('lang.update_license_expiring_email_template') }}</label>
                                        <textarea type="text" name="update_license_expiring_email_template"
                                            id="update_license_expiring_email_template"
                                            placeholder="{{ trans('lang.update_license_expiring_email_template') }}"
                                            class="form-control ckeditor">
                                                                                    {{ object_get($emailSettings,'update_license_expiring_email_template',old('update_license_expiring_email_template')) }}
                                                                            </textarea>
                                        @component('admin.setting.email_variables')
                                        @endcomponent
                                        @error('update_license_expiring_email_template')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 col-lg-6">
                                        <label
                                            for="update_support_ending_email_template">{{ trans('lang.update_support_ending_email_template') }}</label>
                                        <textarea type="text" name="update_support_ending_email_template"
                                            id="update_support_ending_email_template"
                                            placeholder="{{ trans('lang.update_support_ending_email_template') }}"
                                            class="form-control ckeditor">
                                                                                    {{ object_get($emailSettings,'update_support_ending_email_template',old('update_support_ending_email_template')) }}
                                                                            </textarea>
                                        @component('admin.setting.email_variables')
                                        @endcomponent
                                        @error('update_support_ending_email_template')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>

                                <div class="form-group row ">
                                    <div class="col-md-6 col-lg-6 checkbox-inline">
                                        <label class="checkbox checkbox-rounded" for="update_license_expired_notification">
                                            <input type="checkbox" name="update_license_expired_notification"
                                                id="update_license_expired_notification"
                                                {{ object_get($emailSettings, 'update_license_expired_notification', old('update_license_expired_notification'))? 'checked': '' }} />
                                            <span></span>
                                            {{ trans('lang.update_license_expired_notification') }}
                                        </label>
                                        @error('update_license_expired_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="col-md-6 col-lg-6 checkbox-inline">
                                        <label class="checkbox checkbox-rounded"
                                            for="update_support_end_email_notification">
                                            <input type="checkbox" name="update_support_end_email_notification"
                                                id="update_support_end_email_notification"
                                                {{ object_get($emailSettings,'update_support_end_email_notification',old('update_support_end_email_notification'))? 'checked': '' }} />
                                            <span></span>
                                            {{ trans('lang.update_support_end_email_notification') }}
                                        </label>
                                        @error('update_support_end_email_notification')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                    </div>
                                </div>
                                
                                @can('update_email_setings')
                                <div class="form-group row">
                                    <div class="col-md-12 col-lg-12 text-center">
                                        <button type="submit"
                                            class="btn btn-md px-5 text-white btn-black">{{ trans('lang.save_changes') }}</button>
                                    </div>
                                </div>
                                @endcan

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>


@stop

@section('js')

    <script>
        $("#email_settings_form").on("keypress", function(event) {
            var keyPressed = event.keyCode || event.which;
            if (keyPressed === 13) {
                event.preventDefault();
                return false;
            }
        });

        $('#email_settings_form').on('submit', function() {
            event.preventDefault()
            $('#load').show();

            let formData = new FormData(this)
            console.log(CKEDITOR.instances["license_expiring_email_template"].getData());

            formData.append('license_expiring_email_template', CKEDITOR.instances["license_expiring_email_template"]
                .getData())
            formData.append('support_ending_email_template', CKEDITOR.instances["support_ending_email_template"]
                .getData())
            formData.append('update_license_expiring_email_template', CKEDITOR.instances[
                "update_license_expiring_email_template"].getData())
            formData.append('update_support_ending_email_template', CKEDITOR.instances[
                "update_support_ending_email_template"].getData())

            $.ajax({
                url: "{{ route('admin.setting.update_email_setting') }}",
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function(data) {
                    $('#load').hide();
                    if (data["status"] == true) {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                        // location.replace("{{ route('admin.setting.email_setting') }}");
                    } else {
                        swal({
                            title: "",
                            text: data["data"],
                            type: "error",
                            showCancelButton: false,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "{{ __('lang.ok') }}",
                            cancelButtonText: "{{ __('lang.cancel') }}",
                            closeOnConfirm: true,
                            closeOnCancel: true
                        });
                    }
                },
                error: function(data) {
                    $('#load').hide();

                    swal({
                        title: "",
                        text: "{{ __('lang.error') }}",
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "{{ __('lang.ok') }}",
                        cancelButtonText: "{{ __('lang.cancel') }}",
                        closeOnConfirm: true,
                        closeOnCancel: true
                    });
                }
            });

        })

        $('.mail-template-variable').on('click', function() {
            var variable = $(this).data('text')
            var textarea = $(this).parent().parent().find('textarea')
            var areaId = textarea.attr('id')

            CKEDITOR.instances[areaId].insertHtml(variable);

        })
    </script>
@endsection
