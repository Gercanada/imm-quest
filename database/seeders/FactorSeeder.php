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

        $translated = [
            [
                "title" => "Factor 1",
                "sub_title" => " - Core Human Capital factors",
                "titulo" => "Factor 1",
                "sub_titulo" => " | Capital Humano",
                "id" => 2
            ],
            [
                "title" => "Factor 2",
                "sub_title" => " - Spouse Attributes",
                "titulo" => "Factor 2",
                "sub_titulo" => " | Capital Humano de la Pareja",
                "id" => 3
            ],
            [
                "title" => "Factor 3",
                "sub_title" => " - Skills transferability",
                "titulo" => "Factor 3",
                "sub_titulo" => " | Transferencia de Habilidades",
                "id" => 4
            ],
            [
                "title" => "Factor 4",
                "sub_title" => " - Additional Points",
                "titulo" => "Factor 4",
                "sub_titulo" => " | Puntos Adicionales",
                "id" => 5
            ]
        ];



        foreach ($translated as $item) {
            Factor::create($item);
        }
    }
}
