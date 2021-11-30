<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Lars',
            'description' => 'CP user',
            'user_name' => 'lars_goetia',
            'prefered_name' => 'Lars',
            'last_name' => 'Goetia',
            'nationalities' => 'mexican',
            'avatar' => 'https://lorempixel.com/200/200',
            'password' => bcrypt('12345678'),
            'phone_country_code' => '52',
            //'mobile_phone' => '2999644288',
            'watsapp_no' => '2999644288',
            'email' => 'goetia@gmail.com',
            'phone' => '2999644288',
            'watsapp_update_option' => 'y',
            'vtiger_contact_id' => '12x77'
        ]);
    }
}
