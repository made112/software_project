<?php

namespace Database\Seeders;

use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            [
                'id'=>1,
                'name_en' => 'question',
                'name_ar' => 'سؤال',
                'color' => '#00000',
                'created_by' => 1,
            ], [
                'id'=>2,
                'name_en' => 'bug',
                'name_ar' => 'خطأ',
                'color' => '#00000',
                'created_by' => 1
            ],
            [
                'id'=>3,
                'name_en' => 'future',
                'name_ar' => 'اضافة',
                'color' => '#00000',
                'created_by' => 1
            ],

        ];
        TicketType::truncate();
        TicketType::insert($type);
    }
}
