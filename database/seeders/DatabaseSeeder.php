<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::factory()->count(10)->create();
        $this->call([
            FactorSeeder::class,
            SubfactorSeeder::class,
            CriterionSeeder::class
        ]);
    }
}