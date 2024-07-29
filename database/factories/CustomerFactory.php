<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_number' => fake()->randomNumber(8, true),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'address' => fake()->streetAddress(),
            'phone' => fake()->e164PhoneNumber(),
            'email' => fake()->unique()->safeEmail()
        ];
    }
}
