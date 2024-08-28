<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        DB::table('setting')->truncate();
        DB::table('countries')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();
        // DB::table('permissions')->truncate();

        DB::insert("INSERT INTO  `setting` (`id`, `name`, `image`, `email`, `mobile`, `address`, `user_id`, `license_code`, `time_zone`, `blacklist_domain_attempts`, `blacklist_ip_attempts`, `activation_attempts`, `download_attempts`, `created_at`, `updated_at`, `api_key`) VALUES (NULL, 'Cyberx', 'cyberx.png', 'cyberx@gmail.com', '0594488606', 'Jeddah', '1', '', '', '0', '0', '0', '0', '2022-02-14 20:17:05', NULL,'rLtt6JWvbUHDDhsZnfpAhpYk4dxYDQkbcPTyGaKp2TYqQgG7FGZ5Th_WD53Oq8Ebz6A53njUoo1w3pjU1D4vs_ZMqFiz_j0urb_BH9Oq9VZoKFoJEDAbRZepGcQanImyYrry7Kt6MnMdgfG5jn4HngWoRdKduNNyP4kzcp3mRv7x00ahkm9LAK7ZRieg7k1PDAnBIOG3EyVSJ5kK4WLMvYr7sCwHbHcu4A5WwelxYK0GMJy37bNAarSJDFQsJ2ZvJjvMDmfWwDVFEVe_5tOomfVNt6bOg9mexbGjMrnHBnKnZR1vQbBtQieDlQepzTZMuQrSuKn-t5XZM7V6fCW7oP-uXGX-sMOajeX65JOf6XVpk29DP6ro8WTAflCDANC193yof8-f5_EYY-3hXhJj7RBXmizDpneEQDSaSz5sFk0sV5qPcARJ9zGG73vuGFyenjPPmtDtXtpx35A-BVcOSBYVIWe9kndG3nclfefjKEuZ3m4jL9Gg1h2JBvmXSMYiZtp9MR5I6pvbvylU_PP5xJFSjVTIz7IQSjcVGO41npnwIxRXNRxFOdIUHn0tjQ-7LwvEcTXyPsHXcMD8WtgBh-wxR8aKX7WPSsT1O8d8reb2aR7K3rkV3K82K_0OgawImEpwSvp9MNKynEAJQS6ZHe_J_l77652xwPNxMRTMASk1ZsJL')");
        DB::table('countries')->insert(
            array(
                array(
                    'name_ar' => 'فلسطين',
                    'name_en' => 'Palestinian Territory',
                    'country_code' => '972',
                    'flag' => 'PS',
                    'status' => 1
                ),
                array(
                    'name_ar' => 'المملكة العربية السعودية',
                    'name_en' => 'Saudi Arabia',
                    'country_code' => '966',
                    'flag' => 'SA',
                    'status' => 1
                )
            )
        );

        $role = Role::create([
            'name' => 'Admin',
            'guard_name' => 'web'
        ]);

        $user = User::create([
            'username' => 'admin',
            'name' => 'أدمن',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'mobile' => '',
            'type' => 1,
            'user_id' => 1,
            'status' => 1
        ]);



        $permissions = Permission::get();
        foreach ($permissions as $permission) {
            $role->givePermissionTo($permission);
            $user->givePermissionTo($permission);
        }

        Schema::enableForeignKeyConstraints();
    }
}
