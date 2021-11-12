<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
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
            'quote_id' => $this->faker->numberBetween(1,3),
            'subtotal' => $this->faker->numberBetween(100,1000),
            'subject' => $this->faker->sentence(),
            'invoice_date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'discount_percent' => $this->faker->numberBetween(10,60),
            'currency' => 'MXN',
        ];
    }
}
