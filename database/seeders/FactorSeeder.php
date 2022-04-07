<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('factors')->insert([
            'id'=>1,
            'title' => 'Factor 1 - ¿Qué se evalúa?',
            'description' => 'Factores centrales del Capital Humano',
        ]);
        DB::table('factors')->insert([
            'id'=>2,
            'title' => 'Factor 2 - ¿Qué se evalúa?',
            'description' => 'Transferibilidad de habilidades',
        ]);
        DB::table('factors')->insert([
            'id'=>3,
            'title' => 'Factor 3 - ¿Qué se evalúa?',
            'description' => 'Puntos Adicionales',
        ]);
        DB::table('factors')->insert([
            'id'=>4,
            'title' => 'Factor 4 - ¿Qué se evalúa?',
            'description' => 'Atributos de la pareja (en caso de que aplique)',
        ]);
    }
}
