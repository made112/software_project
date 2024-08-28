<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $countries = json_decode(file_get_contents(getcwd() . '/database/seeders/static_data/countries.json'),  true);

        Country::truncate();

        foreach ($countries as $country) {
            $name = json_decode($country['name'], true);
            $country['name_en'] = $name['en'];
            $country['name_ar'] = $name['ar'];
            unset($country['name']);
            $country['country_code'] = $country['phone_code'];
            unset($country['phone_code']);

            $country['status'] = $country['is_active'];
            unset($country['is_active']);
            unset($country['deleted_at']);


            Country::create($country);
        }
        Schema::enableForeignKeyConstraints();
    }
}
