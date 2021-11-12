<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CLItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'case_id' => $this->faker->numberBetween(1,5),
            'chech_list_id' => $this->faker->numberBetween(1,8),
            'subject' => $this->faker->sentence(),
            'cli_item_no' => $this->faker->numberBetween(1,999),
            'catagory_id' => $this->faker->numberBetween(1,3),
            //'required_to' => $this->faker->name(),
            //'required_by' => $this->faker->name(),
            'comments' => $this->faker->paragraph($nbSentences = 3, $variableNbSentences = true),
            //'help_link' => $this->faker->link(),
            'status' =>  $this->faker->numberBetween(0,1),
            //'cli_file' => $this->faker->name(),
        ];
    }
}
