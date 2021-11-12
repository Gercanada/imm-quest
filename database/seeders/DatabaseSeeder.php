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
         //\App\Models\CPCase::factory(60)->create();
        // \App\Models\Checklist::factory(40)->create();
         $this->call(UserTableSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
