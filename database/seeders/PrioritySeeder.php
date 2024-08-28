<?php

namespace Database\Seeders;

use App\Models\TicketPriority;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priority  = [
            [
                'id'=>1,
                'name_en' => 'low',
                'name_ar' => 'منخفضة',
                'color' => '#00000',
                'created_by' => 1,
            ], [
                'id'=>2,
                'name_en' => 'medium',
                'name_ar' => 'متوسطة',
                'color' => '#00000',
                'created_by' => 1
            ],
            [
                'id'=>3,
                'name_en' => 'high',
                'name_ar' => 'مرتفعة',
                'color' => '#00000',
                'created_by' => 1
            ],
            [
                'id'=>4,
                'name_en' => 'agent',
                'name_ar' => 'وكيل',
                'color' => '#00000',
                'created_by' => 1
            ],

        ];
        TicketPriority::truncate();
        TicketPriority::insert($priority);
    }
}
