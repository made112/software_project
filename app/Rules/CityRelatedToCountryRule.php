<?php

namespace App\Rules;

use App\Models\City;
use App\Models\Country;
use Illuminate\Contracts\Validation\Rule;

class CityRelatedToCountryRule implements Rule
{
    public $country;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Country $country)
    {
        $this->country = $country;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return  City::find($value)->country_id == $this->country->id;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.city_related_to_country', ['country' => $this->country->country_name]);
    }
}
