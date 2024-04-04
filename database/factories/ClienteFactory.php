<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber(),
            'birthdate' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'address' => $this->faker->streetAddress,
            'complement' => $this->faker->city,
            'neighborhood' => $this->faker->state,
            'postal_code' => $this->faker->postcode,
        ];
    }
}
