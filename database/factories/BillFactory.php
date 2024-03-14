<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bill>
 */
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'house_id' => \App\Models\House::factory(),
            'description' => $this->faker->sentence(),
            'amount' => $this->faker->randomFloat(2, 1, 1000),
            'currency' => $this->faker->randomElement(['USD', 'TZS', 'KES']),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'type' => $this->faker->randomElement(['rent', 'utilities', 'taxes', 'other']),
            'shared' => $this->faker->boolean(),
        ];
    }
}
