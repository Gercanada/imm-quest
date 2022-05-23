<?php

namespace Database\Seeders;

use App\Models\Subfactor;
use Illuminate\Database\Seeder;

class SubfactorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                "id" => 2,
                "subfactor" => "Age",

                "subfactor_es" => "Edad",
                "factor_id" => 2
            ],
            [
                "id" => 3,
                "subfactor" => "Education",

                "subfactor_es" => "Educación",
                "factor_id" => 2
            ],
            [
                "id" => 4,
                "subfactor" => "Language | Reading",

                "subfactor_es" => "Idioma | Lectura",
                "factor_id" => 2
            ],
            [
                "id" => 5,
                "subfactor" => "Language | Listening",

                "subfactor_es" => "Idioma | Escuchar",
                "factor_id" => 2
            ],
            [
                "id" => 6,
                "subfactor" => "Language | Writing",

                "subfactor_es" => "Idioma | Escritura",
                "factor_id" => 2
            ],
            [
                "id" => 7,
                "subfactor" => "Language | Speaking",

                "subfactor_es" => "Idioma | Hablando",
                "factor_id" => 2
            ],
            [
                "id" => 8,
                "subfactor" => "Second Language",

                "subfactor_es" => "Segundo Idioma",
                "factor_id" => 2
            ],
            [
                "id" => 9,
                "subfactor" => "Canada Experience",

                "subfactor_es" => "Experiencia en Canadá",
                "factor_id" => 2
            ],
            [
                "id" => 10,
                "subfactor" => "Spouse Education",

                "subfactor_es" => "Educación del cónyuge",
                "factor_id" => 5
            ],
            [
                "id" => 11,
                "subfactor" => "Spouse language | Reading",

                "subfactor_es" => "Idioma del cónyugue | Lectura",
                "factor_id" => 5
            ],
            [
                "id" => 12,
                "subfactor" => "Spouse language | Writing",

                "subfactor_es" => "Idioma del cónyugue | Escritura",
                "factor_id" => 5
            ],
            [
                "id" => 13,
                "subfactor" => "Spouse language | Listening",

                "subfactor_es" => "Idioma del cónyugue | Escuchar",
                "factor_id" => 5
            ],
            [
                "id" => 14,
                "subfactor" => "Spouse language | Speaking",

                "subfactor_es" => "Idioma del cónyugue | Hablando",
                "factor_id" => 5
            ],
            [
                "id" => 15,
                "subfactor" => "Spouse Can W. Exp",

                "subfactor_es" => "Cónyugue Experiencia laboral en Canadá",
                "factor_id" => 5
            ],
            [
                "id" => 16,
                "subfactor" => "Education and Language",

                "subfactor_es" => "Educación e Idioma",
                "factor_id" => 3
            ],
            [
                "id" => 17,
                "subfactor" => "Education and Canadian Wok Experience",

                "subfactor_es" => "Educación y Experiencia laboral Canadiense",
                "factor_id" => 3
            ],
            [
                "id" => 18,
                "subfactor" => "Language and Foeign Wok Experience",

                "subfactor_es" => "Idioma y experiencia laboral en el extranjero",
                "factor_id" => 3
            ],
            [
                "id" => 19,
                "subfactor" => "Canadian Wok Experience and Foeign Wok Experience",

                "subfactor_es" => "Experiencia laboral Canadiense y Experiencia laboral Extranjera",
                "factor_id" => 3
            ],
            [
                "id" => 20,
                "subfactor" => "Certificate of Qualification and Language",

                "subfactor_es" => "Certificado de Cualificación e Idioma",
                "factor_id" => 3
            ],
            [
                "id" => 21,
                "subfactor" => "Additional Points | Education",

                "subfactor_es" => "Puntos adicionales | Educación",
                "factor_id" => 4
            ],
            [
                "id" => 22,
                "subfactor" => "Additional Points | Job Offer",

                "subfactor_es" => "Puntos adicionales |Oferta de trabajo",
                "factor_id" => 4
            ],
            [
                "id" => 23,
                "subfactor" => "Additional Points | PNP",

                "subfactor_es" => "Puntos adicionales | PNP",
                "factor_id" => 4
            ],
            [
                "id" => 24,
                "subfactor" => "Additional Points | Family Member in Canada",

                "subfactor_es" => "Puntos adicionales | Miembro de la familia en Canadá",
                "factor_id" => 4
            ]
        );

        foreach ($data as $item) {
            Subfactor::create($item);
        }
    }
}
