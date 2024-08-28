<?php

namespace Database\Seeders;

use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'id'=>1,
                'name_en' => 'new',
                'name_ar' => 'جديدة',
                'color' => '#00000',
                'created_by' => 1
            ], [
                'id'=>2,
                'name_en' => 'opened',
                'name_ar' => 'مفتوحة',
                'color' => '#00000',
                'created_by' => 1
            ],
            [
                'id'=>3,
                'name_en' => 'updated',
                'name_ar' => 'محدثة',
                'color' => '#00000',
                'created_by' => 1
            ],
            [
                'id'=>4,
                'name_en' => 'deleted',
                'name_ar' => 'محذوفة',
                'color' => '#00000',
                'created_by' => 1
            ],
            [
                'id'=>5,
                'name_en' => 'restored',
                'name_ar' => 'مسترجعة',
                'color' => '#00000',
                'created_by' => 1
            ]
        ];
        TicketStatus::truncate();
        TicketStatus::insert($status);
    }
}
