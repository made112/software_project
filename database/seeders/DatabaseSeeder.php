<?php

namespace Database\Seeders;

use App\Models\Download;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Download::factory(50)->create();
        $this->call([PermissionUserSeeder::class, AdminUserSeeder::class]);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(PrioritySeeder::class);


        $this->call(ProductSeeder::class);
    }
}
