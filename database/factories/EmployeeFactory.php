<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $fname = $this->faker->firstName($gender = ['male', 'female'][array_rand(['', ''])]),
            'surname' => $sname = $this->faker->lastName(),
            'email' => strtolower("$fname.$sname@example.com"),
            'phone' => $this->faker->unique()->phoneNumber(),
            'is_active' => $this->faker->boolean(90),
            'gender' => $gender,
        ];
    }
}
