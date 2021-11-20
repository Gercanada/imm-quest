<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
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
            //'invoice_id' => $this->faker->numberBetween(1,4),
            'total' => $this->faker->numberBetween(100, 10000),
            'quote_no' => $this->faker->numberBetween(1,100),
            'subject' => $this->faker->sentence(),
            //'quote_state' => $this->faker->name(),
            'subtotal' => $this->faker->numberBetween(100, 10000),
            'discount' => $this->faker->numberBetween(1,60),
            //'discount_amount' => $this->faker->name(),
            //'s_h_amount' => $this->faker->name(),
            'currency' => 'MXN',
            'accepted' => $this->faker->boolean(),
            'accepted_date' => $this->faker->date(),
            //'pte_tax_total' => $this->faker->name(),
            //'tax' => $this->faker->name(),
            //'professional_services' => $this->faker->name(),
            //'government_fee_subtotals' => $this->faker->name(),
            //'professional_fee_subtotals' => $this->faker->name(),
            //'all_sub_total' => $this->faker->name(),
            //'taxes' => $this->faker->name(),
            //'client_response_quote' => $this->faker->name(),
            //'number_of_payments' => $this->faker->name(),
            //'review' => $this->faker->name(),
        ];
    }
}
