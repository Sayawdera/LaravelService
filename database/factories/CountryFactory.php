<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_info' => [
                'Country' => $this->faker->country(),
                'Regions' => $this->faker->city(),
                'Street' => $this->faker->streetAddress(),
            ],
            'parent_id' => $this->faker->numberBetween(),
        ];
    }
}
