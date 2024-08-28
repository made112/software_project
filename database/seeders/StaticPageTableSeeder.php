<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StaticPageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::Insert("INSERT INTO `software`.`static_page` (`id`, `title`, `details`, `slug`, `photo`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `flag`) VALUES (NULL, 'Title  privacy', '<p>details&nbsp;privacy 1</p>\r\n\r\n<p>&nbsp;</p>', 'privacy', '', '1', '1', '2022-05-17 00:04:10', '2022-05-17 00:08:29', NULL, '1')");
        \DB::Insert("INSERT INTO `software`.`static_page` (`id`, `title`, `details`, `slug`, `photo`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `flag`) VALUES (NULL, 'Terms Conditions', '<p>Terms Conditions</p>', 'terms-conditions', '', '1', '1', '2022-05-17 00:09:37', '2022-05-17 00:09:37', NULL, '1')");
        \DB::Insert("INSERT INTO `software`.`static_page` (`id`, `title`, `details`, `slug`, `photo`, `user_id`, `status`, `created_at`, `updated_at`, `deleted_at`, `flag`) VALUES (NULL, 'Unsubscribe', '<p>Unsubscribe Details</p>', 'unsubscribe', '', '1', '1', '2022-05-17 00:10:03', '2022-05-17 00:10:03', NULL, '1')");

    }
}
