<div class="mt-2">
    <button class="btn btn-success btn-sm mail-template-variable" type="button" id="client_attribute"
        data-text="{{ App\Models\EmailSetting::MAIL_TEMPLATE_VARIABLES['client_name'] }}">{{ __('lang.client') }}
    </button>
    <label>
        {{ __('lang.client_template_variable') }}
    </label>
    <button class="btn btn-success btn-sm mail-template-variable" type="button" id="product_attribute"
        data-text="{{ App\Models\EmailSetting::MAIL_TEMPLATE_VARIABLES['product_name'] }}">{{ __('lang.product') }}
    </button>
    <label>
        {{ __('lang.product_template_variable') }}
    </label>
</div>
