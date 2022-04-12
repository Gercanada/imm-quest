<?php

namespace Database\Seeders;

use App\Models\Factor;
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


        $data = [
            [
                'id' => 1,
                'title' => 'Factor 1 - ¿Qué se evalúa?',
                'sub_title' => 'Factores centrales del Capital Humano',
            ],
            [
                'id' => 2,
                'title' => 'Factor 2 - ¿Qué se evalúa?',
                'sub_title' => 'Transferibilidad de habilidades',
            ],
            [
                'id' => 3,
                'title' => 'Factor 3 - ¿Qué se evalúa?',
                'sub_title' => 'Puntos Adicionales',
            ],
            [
                'id' => 4,
                'title' => 'Factor 4 - ¿Qué se evalúa?',
                'sub_title' => 'Atributos de la pareja (en caso de que aplique)',
            ]
        ];

        foreach ($data as $item) {
            Factor::create($item);
        }
    }
}