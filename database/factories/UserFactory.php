<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->sentence(),
            'user_name' => $this->faker->userName(),
            'prefered_name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'nationalities' => $this->faker->country(),
            'avatar' => 'https://lorempixel.com/200/200',
            'password' => bcrypt('12345678'),
            'phone_country_code' => $this->faker->numberBetween(11,99),
            'mobile_phone' => $this->faker->phoneNumber(),
            'watsapp_no' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'watsapp_update_option' => '1',

            'has_passport' => '1',
            'passport_expiration_date' => $this->faker->dateTime($min = 'now', $timezone = null),
            'rating' => $this->faker->numberBetween($min = 1, $max = 10),
            //'email_verified_at' => now(),
            //'remember_token' => Str::random(10)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
