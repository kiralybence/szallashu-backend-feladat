<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'companyName' => $this->faker->company,
            'companyRegistrationNumber' => $this->faker->numerify('######-####'),
            'companyFoundationDate' => $this->faker->date,
            'country' => $this->faker->country,
            'zipCode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'streetAddress' => $this->faker->streetAddress,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'companyOwner' => $this->faker->name,
            'employees' => $this->faker->numberBetween(1, 999),
            'activity' => $this->faker->word,
            'active' => $this->faker->boolean,
            'email' => $this->faker->email,
            'password' => $this->faker->password,
        ];
    }
}
