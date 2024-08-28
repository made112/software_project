<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'id' => 1,
                'name_en' => 'Gaza',
                'name_ar' => 'غزة',
                'country_id' => Country::where('country_code', '972')->first()->id
            ], [
                'id' => 2,
                'name_en' => 'Reyad',
                'name_ar' => 'الرياض',
                'country_id' => Country::where('country_code', '966')->first()->id
            ]
        ];
        Schema::disableForeignKeyConstraints();
        City::truncate();
        City::insert($cities);
        Schema::enableForeignKeyConstraints();
    }
}
