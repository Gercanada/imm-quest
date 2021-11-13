<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>1,
            'case_id'=>$this->faker->numberBetween(1,5),
            'invoice_id'=>$this->faker->numberBetween(1,3),
            'subject'=>$this->faker->sentence(),
            'payments_no'=>$this->faker->numberBetween(),
            'currency'=>'MXN',
            'amount'=>$this->faker->numberBetween(1000,10000),
            'payment_date'=>$this->faker->date(),
            'payment_method'=>'card'
        ];
    }
}
