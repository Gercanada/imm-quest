<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChecklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 2,
            'case_id' => $this->faker->numberBetween(1, 5),
            'title' => $this->faker->sentence(),
            'subject' => $this->faker->sentence(),
            'check_list_no' => $this->faker->numberBetween(1, 100),
            'applicant_full_name' => $this->faker->name(),
            //'related_to' => $this->faker->name(),
            //'active_items' => $this->faker->name(),
            //'pending_items' => $this->faker->name(),
            //'completed_items' => $this->faker->name(),
            //'check_list_type' => $this->faker->name(),
            'completed' => $this->faker->numberBetween(88, 100)
        ];
    }
}
