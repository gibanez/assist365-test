<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Passenger>
 */
class PassengerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'       => $this->faker->firstName(),
            'last_name'        => $this->faker->lastName(),
            'document_type'    => $this->faker->randomElement(['DNI', 'Passport']),
            'document_number'  => $this->faker->unique()->numerify('########'),
            'birth_date'       => $this->faker->date('Y-m-d', '-18 years'),
            'gender'           => $this->faker->randomElement(['male', 'female', 'other']),
            'email'            => $this->faker->unique()->safeEmail(),
            'phone'            => $this->faker->phoneNumber(),
            'nationality'      => $this->faker->country(),
            'address'          => $this->faker->address(),
        ];
    }
}
