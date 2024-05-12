<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Generalist',
                'description' => 'Can perform different tasks, helps in team building.',
            ],
            [
                'name' => 'Baker',
                'description' => 'Good specially with sweets.'
            ],
            [
                'name' => 'Cook',
                'description' => 'Preparing meals.',
            ],
            [
                'name' => 'Service',
                'description' => 'Communicates/interfaces with the customer.',
            ],
            [
                'name' => 'Groceries',
                'description' => 'Buys quality products.'
            ]
        ];

        Skill::upsert(array_map(fn($row) => [...$row, 'is_active' => true], $data), ['name']);
    }
}
