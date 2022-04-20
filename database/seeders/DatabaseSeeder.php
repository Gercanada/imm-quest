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

        //Seeder
        $this->call([
            UserTableSeeder::class,
            FactorSeeder::class,
            SubfactorSeeder::class,
            CriterionSeeder::class
        ]);
    }
}