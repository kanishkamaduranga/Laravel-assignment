<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RepairShopsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->streetName(),
            'email'     =>$this->faker->email,
            'tp'        => $this->faker->phoneNumber,
            'latitude'  =>$this->faker->randomFloat(6, 1, 50),
            'longitude' =>$this->faker->randomFloat(6, 1, 50),
        ];
    }
}
