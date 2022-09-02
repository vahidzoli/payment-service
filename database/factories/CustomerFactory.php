<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'job_title' => $this->faker->jobTitle,
            'email' => $this->faker->unique()->safeEmail,
            'name' => $this->faker->name,
            'registered_since' => $this->faker->date('l, d-M-Y'),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
