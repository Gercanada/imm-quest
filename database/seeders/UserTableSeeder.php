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
            'user_name' => 'lars_goetia',
            'last_name' => 'Goetia',
            'avatar' => 'https://lorempixel.com/200/200',
            'password' => bcrypt('password'),
            'email' => 'goetia@gmail.com'
        ]);
    }
}