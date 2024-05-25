<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'label'     => 'Morning',
                'starts_at' => '06:00',
                'ends_at'   => '14:00',
            ],
            [
                'label'     => 'Evening',
                'starts_at' => '14:00',
                'ends_at'   => '22:00',
            ],
            [
                'label'     => 'Night',
                'starts_at' => '22:00',
                'ends_at'   => '06:00',
            ],
                
        ];

        Shift::upsert($data, ['label']);
    }
}
