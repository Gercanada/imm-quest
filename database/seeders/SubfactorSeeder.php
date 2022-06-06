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

                // "subfactor_es" => "Edad",
                "factor_id" => 3
            ],
            [
                "id" => 3,
                "subfactor" => "Education",

                // "subfactor_es" => "Educación",
                "factor_id" => 3
            ],
            [
                "id" => 4,
                "subfactor" => "Language | Reading",

                // "subfactor_es" => "Idioma | Lectura",
                "factor_id" => 3
            ],
            [
                "id" => 5,
                "subfactor" => "Language | Listening",

                // "subfactor_es" => "Idioma | Escuchar",
                "factor_id" => 3
            ],
            [
                "id" => 6,
                "subfactor" => "Language | Writing",

                // "subfactor_es" => "Idioma | Escritura",
                "factor_id" => 3
            ],
            [
                "id" => 7,
                "subfactor" => "Language | Speaking",

                // "subfactor_es" => "Idioma | Hablando",
                "factor_id" => 3
            ],
            [
                "id" => 8,
                "subfactor" => "Second Language",

                // "subfactor_es" => "Segundo Idioma",
                "factor_id" => 3
            ],
            [
                "id" => 9,
                "subfactor" => "Canada Experience",

                // "subfactor_es" => "Experiencia en Canadá",
                "factor_id" => 3
            ],
            [
                "id" => 10,
                "subfactor" => "Spouse Education",

                // "subfactor_es" => "Educación del cónyuge",
                "factor_id" => 5
            ],
            [
                "id" => 11,
                "subfactor" => "Spouse language | Reading",

                // "subfactor_es" => "Idioma del cónyugue | Lectura",
                "factor_id" => 5
            ],
            [
                "id" => 12,
                "subfactor" => "Spouse language | Writing",

                // "subfactor_es" => "Idioma del cónyugue | Escritura",
                "factor_id" => 5
            ],
            [
                "id" => 13,
                "subfactor" => "Spouse language | Listening",

                // "subfactor_es" => "Idioma del cónyugue | Escuchar",
                "factor_id" => 5
            ],
            [
                "id" => 14,
                "subfactor" => "Spouse language | Speaking",

                // "subfactor_es" => "Idioma del cónyugue | Hablando",
                "factor_id" => 5
            ],
            [
                "id" => 15,
                "subfactor" => "Spouse Can W. Exp",

                // "subfactor_es" => "Cónyugue Experiencia laboral en Canadá",
                "factor_id" => 5
            ],
            [
                "id" => 16,
                "subfactor" => "Education and Language",

                // "subfactor_es" => "Educación e Idioma",
                "factor_id" => 4
            ],
            [
                "id" => 17,
                "subfactor" => "Education and Canadian Wok Experience",

                // "subfactor_es" => "Educación y Experiencia laboral Canadiense",
                "factor_id" => 4
            ],
            [
                "id" => 18,
                "subfactor" => "Language and Foeign Wok Experience",

                // "subfactor_es" => "Idioma y experiencia laboral en el extranjero",
                "factor_id" => 4
            ],
            [
                "id" => 19,
                "subfactor" => "Canadian Wok Experience and Foeign Wok Experience",

                // "subfactor_es" => "Experiencia laboral Canadiense y Experiencia laboral Extranjera",
                "factor_id" => 4
            ],
            [
                "id" => 20,
                "subfactor" => "Certificate of Qualification and Language",

                // "subfactor_es" => "Certificado de Cualificación e Idioma",
                "factor_id" => 4
            ],
            [
                "id" => 21,
                "subfactor" => "Additional Points | Education",

                // "subfactor_es" => "Puntos adicionales | Educación",
                "factor_id" => 5
            ],
            [
                "id" => 22,
                "subfactor" => "Additional Points | Job Offer",

                // "subfactor_es" => "Puntos adicionales |Oferta de trabajo",
                "factor_id" => 5
            ],
            [
                "id" => 23,
                "subfactor" => "Additional Points | PNP",

                // "subfactor_es" => "Puntos adicionales | PNP",
                "factor_id" => 5
            ],
            [
                "id" => 24,
                "subfactor" => "Additional Points | Family Member in Canada",

                // "subfactor_es" => "Puntos adicionales | Miembro de la familia en Canadá",
                "factor_id" => 5
            ]
        );

        $translated = [
            [
                "factor_id" => 2,
                "subfactor" => "Age",
                "subfacto" => "Edad",
                "id" => 2
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Education",
                "subfacto" => "Educación",
                "id" => 3
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Language - Reading",
                "subfacto" => "Inglés | Reading",
                "id" => 4
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Language - Listening",
                "subfacto" => "Inglés | Listening",
                "id" => 5
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Language - Writing",
                "subfacto" => "Inglés | Writing",
                "id" => 6
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Language - Speaking",
                "subfacto" => "Inglés | Speaking",
                "id" => 7
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Second Language",
                "subfacto" => "Segundo idioma |Francés",
                "id" => 8
            ],
            [
                "factor_id" => 2,
                "subfactor" => "Canada Experience",
                "subfacto" => "Experiencia Laboral Canadiense",
                "id" => 9
            ],
            [
                "factor_id" => 3,
                "subfactor" => "Spouse Education",
                "subfacto" => "Pareja | Educación",
                "id" => 10
            ],
            [
                "factor_id" => 3,
                "subfactor" => "Spouse language - Reading",
                "subfacto" => "Pareja Nivel de Inglés | Reading",
                "id" => 11
            ],
            [
                "factor_id" => 3,
                "subfactor" => "Spouse language - Writing",
                "subfacto" => "Pareja Nivel de Inglés | Writing",
                "id" => 12
            ],
            [
                "factor_id" => 3,
                "subfactor" => "Spouse language - Listening",
                "subfacto" => "Pareja Nivel de Inglés | Listening",
                "id" => 13
            ],
            [
                "factor_id" => 3,
                "subfactor" => "Spouse language - Speaking",
                "subfacto" => "Pareja Nivel de Inglés | Speaking",
                "id" => 14
            ],
            [
                "factor_id" => 3,
                "subfactor" => "Spouse Can W. Exp",
                "subfacto" => "Pareja | Experiencia Laboral Canadiense",
                "id" => 15
            ],
            [
                "factor_id" => 4,
                "subfactor" => "Education and Language",
                "subfacto" => "Educación e Inglés",
                "id" => 16
            ],
            [
                "factor_id" => 4,
                "subfactor" => "Education and Canadian Work Experience",
                "subfacto" => "Educación y Experiencia laboral en Canadá",
                "id" => 17
            ],
            [
                "factor_id" => 4,
                "subfactor" => "Language and Foreign Work Experience",
                "subfacto" => "Inglés y Experiencia Laboral Fuera de Canadá.",
                "id" => 18
            ],
            [
                "factor_id" => 4,
                "subfactor" => "Canadian Work Experience and Foreign Work Experience",
                "subfacto" => "Experiencia Laboral Dentro y Fuera de Canadá",
                "id" => 19
            ],
            [
                "factor_id" => 4,
                "subfactor" => "Certificate of Qualification and Language",
                "subfacto" => "Inglés y Certificado de Oficio en Canadá",
                "id" => 20
            ],
            [
                "factor_id" => 5,
                "subfactor" => "Additional Points - Education",
                "subfacto" => "Puntos Adicionales | Educación en Canadá",
                "id" => 21
            ],
            [
                "factor_id" => 5,
                "subfactor" => "Additional Points - Job Offer",
                "subfacto" => "Puntos Adicionales | Oferta Laboral Canadiense",
                "id" => 22
            ],
            [
                "factor_id" => 5,
                "subfactor" => "Additional Points - PNP",
                "subfacto" => "Puntos Adicionales | Certificado Provincial PNP",
                "id" => 23
            ],
            [
                "factor_id" => 5,
                "subfactor" => "Additional Points - Family Member in Canada",
                "subfacto" => "Puntos Adicionales | Familiar Directo Canadiense o Residente Permanente",
                "id" => 24
            ]
            ];

        foreach ($translated as $item) {
            Subfactor::create($item);
        }
    }
}
