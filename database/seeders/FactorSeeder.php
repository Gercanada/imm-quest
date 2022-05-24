<?php

namespace Database\Seeders;

use App\Models\Factor;
use Illuminate\Database\Seeder;

class FactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => 2,
                // 'titulo' => 'Factor 1 - ¿Qué se evalúa?',
                // 'sub_titulo' => 'Factores centrales del Capital Humano',

                'title' => 'Factor 1 - What is evaluated?',
                'sub_title' => 'Core Factors of Human Capital',
            ],
            [
                'id' => 3,
                // 'titulo' => 'Factor 2 - ¿Qué se evalúa?',
                // 'sub_titulo' => 'Transferibilidad de habilidades',

                'title' => 'Factor 2 - What is evaluated?',
                'sub_title' => 'Skill Transferability',
            ],
            [
                'id' => 4,
                // 'titulo' => 'Factor 3 - ¿Qué se evalúa?',
                // 'sub_titulo' => 'Puntos Adicionales',

                'title' => 'Factor 3 - What is evaluated?',
                'sub_title' => 'Additional Points',
            ],
            [
                'id' => 5,
                // 'titulo' => 'Factor 4 - ¿Qué se evalúa?',
                // 'sub_titulo' => 'Atributos de la pareja (en caso de que aplique)',

                'title' => 'Factor 4 - What is evaluated?',
                'sub_title' => 'spouse  Attributes (if applicable)'
            ]
        ];

        foreach ($data as $item) {
            Factor::create($item);
        }
    }
}
