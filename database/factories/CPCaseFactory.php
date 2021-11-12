<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CPCaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'applications_created' => '0',
            'gob_main_application_no' => '?',
            'open_date' => $this->faker->date(),
            'no_of_applications' => '?',
            'subcategory' => '?',
            'type' => '?',
            'stream' => '?',
            'invoice' => '?',
            'ticket_no' => '?',
            'status' => '?',
            'category' => '?',
            'title' => $this->faker->sentence(),
        ];
    }
}
