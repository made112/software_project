<?php


return [
    'product_status' => 'Product status is checked before responding to any API requests, marking a product inactive will return all API calls related to this product with a \'product not found or is inactive\' response.',
    'product_downloading_updates' => 'When checked, updates for this product can only be downloaded by providing a valid license and if that license\'s update expiration date has not passed.',
    'version_name' => 'The system will be comparing the version values so make sure you follow a pattern in your version names.',
    'main_file' => 'These files will be extracted/replaced in the application root so structure it accordingly also make sure you include the updated helper file which has the \'current_version\' value changed to the new version.',
    'sql_file' => 'Add your update SQL file here, It will automatically get imported into your client\'s database during the update process.',
    'publish_version' => 'This version will become available to your clients as soon as you add it. You can also publish it later from the manage versions page.',
    'use_limit' => 'License use limits define how many times a license can be used for activating the given product (e.g if use limit of a license is set to 10 then the given license can be used to activate a product 10 times before the license becomes invalid provided that other conditions like domain, IP, parallel use, expiry etc. are fulfilled)',
    'parallel_use_limit' => 'Parallel license use limits define how many active and valid activations can exist for a license at any given time (e.g if parallel uses of a license is set to 2 then the given license can be used to activate and run two instances of a product simultaneously, for activating a 3rd instance one of the current activation has to be marked as inactive)',
    'license_expire_days' => 'License expiration days define in how many days the license will automatically expire after its first activation, useful for creating time based trial licenses.',
    'license_expiration_date' => 'Product updates can\'t be installed/downloaded from activation(s) of this license code after the provided updates end date.',
    'activation_attempts' => 'Checking it will allow recording/adding of failed activations attempts, if unchecked failed attempts will be only visible in activity logs and not on activations page.',
    'download_attempts' => 'Checking it will allow recording/adding of failed update download attempts, if unchecked failed attempts will be only visible in activity logs and not on update downloads page.',
    'api_request_rate_limiting_methond' => 'API rate limiting can be done per API Key or per IP Address.',
    'api_request_rate_limit' => 'Rate limiting API, allows you to limit the number of requests the API processes every hour from any specific API Key or IP Address.',
    'api_blacklisted_domain' => 'If provided, these domains will be prevented from accessing the LicenseBox API.',
    'api_blacklisted_ips' => 'If provided, these IP addresses will be prevented from accessing the LicenseBox API.',
    'api_key_type' => 'Make sure you use the right API Key for the right purpose, never use the internal API in a client-side implementation.',
    'give_special_permission' => 'Selecting this option will give this API key special permission to access the LicenseBox API, thus bypassing any set API restrictions (like rate limit, domain blacklist, IP blacklist etc.) useful if you don\'t want your personal API keys to be restricted.',
    'email_method' => 'Choose the email method LicenseBox will use for sending automated emails to clients.',
    'from_email' => 'This email address will be used as \'From/Reply-To\' address when sending emails, Please note that some web hosts only allow sending of emails from an registered email address.',


];
