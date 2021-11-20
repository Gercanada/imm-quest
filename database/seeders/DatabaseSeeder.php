<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //\App\Models\User::factory(10)->create();
         //Factory
         \App\Models\CPCase::factory(5)->create();
         \App\Models\Quote::factory(3)->create();
         \App\Models\Invoice::factory(3)->create();
         \App\Models\Category::factory(3)->create();
         \App\Models\Checklist::factory(8)->create();
         \App\Models\CLItem::factory(8)->create();
         \App\Models\Payment::factory(2)->create();


         //Seeder
         //$this->call(UserTableSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
