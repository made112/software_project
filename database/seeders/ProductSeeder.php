<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\User;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        $user = User::first();

        $products = [
            [
                'id' => 1,
                'name' => 'Fishing',
                'product_id' => 'u2QtsPB',
                'color' => '#00000',
                'status' => 1,
                'user_id' =>  $user->id,
                'download_update' => 0,
                'details' => 'test',

            ], [
                'id' => 2,
                'name' => 'Policy Management System	',
                'product_id' => 'czwaYWf',
                'color' => '#00001',
                'status' => 1,
                'user_id' => $user->id,
                'download_update' => 0,
                'details' => 'test',
            ],
            [
                'id' => 3,
                'name' => 'LMS Wordpress',
                'product_id' => 'z9P23Z6',
                'color' => '#00002',
                'status' => 1,
                'user_id' => $user->id,
                'download_update' => 0,
                'details' => 'test',
            ],
        ];
        Products::truncate();

        Products::insert($products);

        Schema::enableForeignKeyConstraints();


        // Products::insert($product);
    }
}
