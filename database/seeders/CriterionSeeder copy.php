<?php

namespace Database\Seeders;

use App\Models\Criterion;
use Illuminate\Database\Seeder;

class CriterionSeeder extends Seeder
{
    public function run()
    {
        $data = array(
            [
                "id" => 2,
                "criterio" => "17 años o menos",
                "criterion" => "17 years old or less",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 2
            ],
            [
                "id" => 3,
                "criterio" => "18 años",
                "criterion" => "18 years old",
                "single" => 99,
                "married" => 90,
                "subfactor_id" => 2
            ],
            [
                "id" => 4,
                "criterio" => "19 años",
                "criterion" => "19 years old",
                "single" => 105,
                "married" => 95,
                "subfactor_id" => 2
            ],
            [
                "id" => 5,
                "criterio" => "21 a 29 años",
                "criterion" => "21 years old años",
                "single" => 110,
                "married" => 100,
                "subfactor_id" => 2
            ],
            [
                "id" => 6,
                "criterio" => "30 años",
                "criterion" => "30 years old",
                "single" => 105,
                "married" => 95,
                "subfactor_id" => 2
            ],
            [
                "id" => 7,
                "criterio" => "31 años",
                "criterion" => "31 years old",
                "single" => 99,
                "married" => 90,
                "subfactor_id" => 2
            ],
            [
                "id" => 8,
                "criterio" => "32 años",
                "criterion" => "32 years old",
                "single" => 94,
                "married" => 85,
                "subfactor_id" => 2
            ],
            [
                "id" => 9,
                "criterio" => "33 años",
                "criterion" => "33 years old",
                "single" => 88,
                "married" => 80,
                "subfactor_id" => 2
            ],
            [
                "id" => 10,
                "criterio" => "34 años",
                "criterion" => "34 years old",
                "single" => 83,
                "married" => 75,
                "subfactor_id" => 2
            ],
            [
                "id" => 11,
                "criterio" => "35 años",
                "criterion" => "35 years old",
                "single" => 77,
                "married" => 70,
                "subfactor_id" => 2
            ],
            [
                "id" => 12,
                "criterio" => "36 años",
                "criterion" => "36 years old",
                "single" => 72,
                "married" => 65,
                "subfactor_id" => 2
            ],
            [
                "id" => 13,
                "criterio" => "37 años",
                "criterion" => "37 years old",
                "single" => 66,
                "married" => 60,
                "subfactor_id" => 2
            ],
            [
                "id" => 14,
                "criterio" => "38 años",
                "criterion" => "38 years old",
                "single" => 61,
                "married" => 55,
                "subfactor_id" => 2
            ],
            [
                "id" => 15,
                "criterio" => "39 años",
                "criterion" => "39 years old",
                "single" => 55,
                "married" => 50,
                "subfactor_id" => 2
            ],
            [
                "id" => 16,
                "criterio" => "40 años",
                "criterion" => "40 years old",
                "single" => 50,
                "married" => 45,
                "subfactor_id" => 2
            ],
            [
                "id" => 17,
                "criterio" => "41 años",
                "criterion" => "41 years old",
                "single" => 39,
                "married" => 35,
                "subfactor_id" => 2
            ],
            [
                "id" => 18,
                "criterio" => "42 años",
                "criterion" => "42 years old",
                "single" => 28,
                "married" => 25,
                "subfactor_id" => 2
            ],
            [
                "id" => 19,
                "criterio" => "43 años",
                "criterion" => "43 years old",
                "single" => 17,
                "married" => 15,
                "subfactor_id" => 2
            ],
            [
                "id" => 20,
                "criterio" => "44 años ",
                "criterion" => "44 years old ",
                "single" => 6,
                "married" => 5,
                "subfactor_id" => 2
            ],
            [
                "id" => 21,
                "criterio" => "45 años o más",
                "criterion" => "45 years old or more",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 2
            ],//Ages

            [
                "id" => 22,
                "criterio" => "Secundaria o menos",
                "criterion" => "Secundaria o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 3
            ],
            [
                "id" => 23,
                "criterio" => "Preparatoia o Bachiller",
                "criterion" => "High School or Bachelor",
                "single" => 30,
                "married" => 28,
                "subfactor_id" => 3
            ],
            [
                "id" => 24,
                "criterio" => "Carrera Profesional o técnica de 1 año de duración",
                "criterion" => "Professional or technical career of 1 year duration",
                "single" => 90,
                "married" => 84,
                "subfactor_id" => 3
            ],
            [
                "id" => 25,
                "criterio" => "Carrera Profesional o técnica de 2 años de duración",
                "criterion" => "Professional or technical career of 2 years duration",
                "single" => 98,
                "married" => 91,
                "subfactor_id" => 3
            ],
            [
                "id" => 26,
                "criterio" => "Carrera Profesional o técnica de 3 años de duración o más",
                "criterion" => "Professional or technical career of 3 years or more",
                "single" => 120,
                "married" => 112,
                "subfactor_id" => 3
            ],
            [
                "id" => 27,
                "criterio" => "2 o más carreras o titulos profesionales o técnicos (uno tiene que ser de al menos de 3 años)",
                "criterion" => "2 or more careers or professional or technical degrees (one must be at least 3 years old)",
                "single" => 128,
                "married" => 119,
                "subfactor_id" => 3
            ],
            [
                "id" => 28,
                "criterio" => "Maestría",
                "criterion" => "master's degree",
                "single" => 135,
                "married" => 126,
                "subfactor_id" => 3
            ],
            [
                "id" => 29,
                "criterio" => "Doctoado",
                "criterion" => "Doctorate",
                "single" => 150,
                "married" => 140,
                "subfactor_id" => 3
            ],
            [
                "id" => 30,
                "criterio" => "Lectura | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3 o menos",
                "criterion" => "Reading | CLB 3 | CELPIP Level 3 or less | IELTS Level 3 or less",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 4
            ],
            [
                "id" => 31,
                "criterio" => "Reading | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 3.5",
                "criterion" => "Reading | CLB 4 | CELPIP Level 4 | IELTS Level 3.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 4
            ],
            [
                "id" => 32,
                "criterio" => "Reading | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 4",
                "criterion" => "Reading | CLB 5 | CELPIP Level 5 | IELTS Level 4",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 4
            ],
            [
                "id" => 33,
                "criterio" => "Reading | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.0",
                "criterion" => "Reading | CLB 6 | CELPIP Level 6 | IELTS Level 5.0",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 4
            ],
            [
                "id" => 34,
                "criterio" => "Reading | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6.0 | Mínimo requerido para FSW",
                "criterion" => "Reading | CLB 7 | CELPIP Level 7 | IELTS Level 6.0 | Minimum required for FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 4
            ],
            [
                "id" => 35,
                "criterio" => "Reading | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5",
                "criterion" => "Reading | CLB 8 | CELPIP Level 8 | IELTS Level 6.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 4
            ],
            [
                "id" => 36,
                "criterio" => "Reading | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7 o 7.5",
                "criterion" => "Reading | CLB 9 | CELPIP Level 9 | IELTS Level 7 o 7.5",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 4
            ],
            [
                "id" => 37,
                "criterio" => "Reading | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8 o más",
                "criterion" => "Reading | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8 o más",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 4
            ],
            [
                "id" => 38,
                "criterio" => "Listening | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 4 o menos",
                "criterion" => "Listening | CLB 3 | CELPIP Level 3 o menos | IELTS Level 4 o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 5
            ],
            [
                "id" => 39,
                "criterio" => "Listening | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4.5",
                "criterion" => "Listening | CLB 4 | CELPIP Level 4 | IELTS Level 4.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 5
            ],
            [
                "id" => 40,
                "criterio" => "Listening | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5",
                "criterion" => "Listening | CLB 5 | CELPIP Level 5 | IELTS Level 5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 5
            ],
            [
                "id" => 41,
                "criterio" => "Listening | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5",
                "criterion" => "Listening | CLB 6 | CELPIP Level 6 | IELTS Level 5.5",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 5
            ],
            [
                "id" => 42,
                "criterio" => "Listening | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 o 7 | Mínimo requerido para FSW",
                "criterion" => "Listening | CLB 7 | CELPIP Level 7 | IELTS Level 6 or 7 | Minimum required for FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 5
            ],
            [
                "id" => 43,
                "criterio" => "Listening | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 7.5",
                "criterion" => "Listening | CLB 8 | CELPIP Level 8 | IELTS Level 7.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 5
            ],
            [
                "id" => 44,
                "criterio" => "Listening | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 8",
                "criterion" => "Listening | CLB 9 | CELPIP Level 9 | IELTS Level 8",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 5
            ],
            [
                "id" => 45,
                "criterio" => "Listening | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8.5 o más",
                "criterion" => "Listening | CLB 10 | CELPIP Level 10 or more | IELTS Level 8.5 or more",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 5
            ],
            [
                "id" => 46,
                "criterio" => "Writing| CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3.5 o menos",
                "criterion" => "Writing| CLB 3 | CELPIP Level 3 or less | IELTS Level 3.5 or less",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 6
            ],
            [
                "id" => 47,
                "criterio" => "Writing| CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4 o 4.5",
                "criterion" => "Writing | CLB 4 | CELPIP Level 4 | IELTS Level 4 or 4.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 6
            ],
            [
                "id" => 48,
                "criterio" => "Writing| CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5",
                "criterion" => "Writing | CLB 5 | CELPIP Level 5 | IELTS Level 5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 6
            ],
            [
                "id" => 49,
                "criterio" => "Writing| CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5",
                "criterion" => "Writing| CLB 6 | CELPIP Level 6 | IELTS Level 5.5",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 6
            ],
            [
                "id" => 50,
                "criterio" => "Writing| CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 | Mínimo requerido para FSW",
                "criterion" => "Writing | CLB 7 | CELPIP Level 7 | IELTS Level 6 | Minimum required for FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 6
            ],
            [
                "id" => 51,
                "criterio" => "Writing| CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5",
                "criterion" => "Writing| CLB 8 | CELPIP Level 8 | IELTS Level 6.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 6
            ],
            [
                "id" => 52,
                "criterio" => "Writing| CLB 9| CELPIP Nivel 9 | IELTS Nivel 7 ",
                "criterion" => "Writing | CLB 9 | CELPIP Level 9 | IELTS Level 7 ",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 6
            ],
            [
                "id" => 53,
                "criterio" => "Writing| CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 7.5 o más",
                "criterion" => "Writing| CLB 10 | CELPIP Level 10 or more | IELTS Level 7.5 or more",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 6
            ],
            [
                "id" => 54,
                "criterio" => "Speaking | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3.5 o menos",
                "criterion" => "Speaking | CLB 3 | CELPIP Level 3 or less | IELTS Level 3.5 or less",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 7
            ],
            [
                "id" => 55,
                "criterio" => "Speaking | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4 o 4.5",
                "criterion" => "Speaking | CLB 4 | CELPIP Level 4 | IELTS Level 4 or 4.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 7
            ],
            [
                "id" => 56,
                "criterio" => "Speaking | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5",
                "criterion" => "Speaking | CLB 5 | CELPIP Level 5 | IELTS Level 5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 7
            ],
            [
                "id" => 57,
                "criterio" => "Speaking | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5",
                "criterion" => "Speaking | CLB 6 | CELPIP Level 6 | IELTS Level 5.5",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 7
            ],
            [
                "id" => 58,
                "criterio" => "Speaking | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 | Mínimo requerido para FSW",
                "criterion" => "Speaking | CLB 7 | CELPIP Level 7 | IELTS Level 6 | Minimum required for FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 7
            ],
            [
                "id" => 59,
                "criterio" => "Speaking | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5",
                "criterion" => "Speaking | CLB 8 | CELPIP Level 8 | IELTS Level 6.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 7
            ],
            [
                "id" => 60,
                "criterio" => "Speaking | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7 ",
                "criterion" => "Speaking | CLB 9 | CELPIP Level 9 | IELTS Level 7 ",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 7
            ],
            [
                "id" => 61,
                "criterio" => "Speaking | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 7.5 o más",
                "criterion" => "Speaking | CLB 10 | CELPIP Level 10 or more | IELTS Level 7.5 or more",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 7
            ],
            [
                "id" => 62,
                "criterio" => "CLB Nivel 4 o menos",
                "criterion" => "CLB Level 4 or less",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 8
            ],
            [
                "id" => 63,
                "criterio" => "CLB Nivel 5 o 7",
                "criterion" => "CLB Level 5 or 7",
                "single" => 1,
                "married" => 1,
                "subfactor_id" => 8
            ],
            [
                "id" => 64,
                "criterio" => "CLB Nivel 7 or 9",
                "criterion" => "CLB Level 7 o 9",
                "single" => 3,
                "married" => 3,
                "subfactor_id" => 8
            ],
            [
                "id" => 65,
                "criterio" => "CLB Nivel 9 o más",
                "criterion" => "CLB Level 9 o más",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 8
            ],
            [
                "id" => 66,
                "criterio" => "Sin experiencia laboral en Canadá o menos de 1 año",
                "criterion" => "No work experience in Canada or less than 1 year",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 9
            ],
            [
                "id" => 67,
                "criterio" => "1 año de experiencia laboral en Canadá",
                "criterion" => "1 year of work experience in Canada",
                "single" => 40,
                "married" => 35,
                "subfactor_id" => 9
            ],
            [
                "id" => 68,
                "criterio" => "2 años de experiencia laboral en Canadá",
                "criterion" => "2 years of work experience in Canada",
                "single" => 53,
                "married" => 46,
                "subfactor_id" => 9
            ],
            [
                "id" => 69,
                "criterio" => "3 años de experiencia laboral en Canadá",
                "criterion" => "3 years of work experience in Canada",
                "single" => 64,
                "married" => 56,
                "subfactor_id" => 9
            ],
            [
                "id" => 70,
                "criterio" => "4 años de experiencia laboral en Canadá",
                "criterion" => "4 years of work experience in Canada",
                "single" => 72,
                "married" => 63,
                "subfactor_id" => 9
            ],
            [
                "id" => 71,
                "criterio" => "5 o más años de experiencia laboral en Canadá",
                "criterion" => "5 or more years of work experience in Canada",
                "single" => 80,
                "married" => 70,
                "subfactor_id" => 9
            ],
            [
                "id" => 72,
                "criterio" => "Spouse | Secundaria o menos",
                "criterion" => "Spouse | high school or less",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 10
            ],
            [
                "id" => 73,
                "criterio" => "Spouse | Preparatoia",
                "criterion" => "Spouse | preparatory",
                "single" => null,
                "married" => 2,
                "subfactor_id" => 10
            ],
            [
                "id" => 74,
                "criterio" => "Spouse | Carrera Profesional o técnica de 1 año de duración",
                "criterion" => "Spouse | Professional or technical career of 1 year duration",
                "single" => null,
                "married" => 6,
                "subfactor_id" => 10
            ],
            [
                "id" => 75,
                "criterio" => "Spouse | Carrera Profesional o técnica de 2 años de duración",
                "criterion" => "Spouse | Professional or technical career of 2 years duration",
                "single" => null,
                "married" => 7,
                "subfactor_id" => 10
            ],
            [
                "id" => 76,
                "criterio" => "Spouse | Carrera Profesional o técnica de 3 años de duración o más",
                "criterion" => "Spouse | Professional or technical career of 3 years or more",
                "single" => null,
                "married" => 8,
                "subfactor_id" => 10
            ],
            [
                "id" => 77,
                "criterio" => "Spouse | 2 Carreras profesionales o técnicas (1 de al menos 3 años de duración",
                "criterion" => "Spouse | 2 Professional or technical careers (1 of at least 3 years duration",
                "single" => null,
                "married" => 9,
                "subfactor_id" => 10
            ],
            [
                "id" => 78,
                "criterio" => "Spouse | Maestría o Doctoado",
                "criterion" => "Spouse | Master's or Doctorate",
                "single" => null,
                "married" => 10,
                "subfactor_id" => 10
            ],
            [
                "id" => 79,
                "criterio" => "Spouse Reading| CLB Nivel 4 o menos",
                "criterion" => "Spouse Reading| CLB Level 4 or less",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 11
            ],
            [
                "id" => 80,
                "criterio" => "Spouse Reading | CLB Nivel 5 o 6",
                "criterion" => "Spouse Reading | CLB Level 5 or 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 11
            ],
            [
                "id" => 81,
                "criterio" => "Spouse Reading | CLB Nivel 7 o 8",
                "criterion" => "Spouse Reading | CLB Level 7 or 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 11
            ],
            [
                "id" => 82,
                "criterio" => "Spouse Reading | CLB Nivel 9 o más",
                "criterion" => "Spouse Reading | CLB Level 9 or more",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 11
            ],
            [
                "id" => 83,
                "criterio" => "Spouse Writing | CLB Nivel 4 o menos",
                "criterion" => "Spouse Writing | CLB Level 4 or less",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 12
            ],
            [
                "id" => 84,
                "criterio" => "Spouse Writing | CLB Nivel 5 o 6",
                "criterion" => "Spouse Writing | CLB Level 5 or 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 12
            ],
            [
                "id" => 85,
                "criterio" => "Spouse Writing | CLB Nivel 7 o 8",
                "criterion" => "Spouse Writing | CLB Level 7 or 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 12
            ],
            [
                "id" => 86,
                "criterio" => "Spouse Writing | CLB Nivel 9 o más",
                "criterion" => "Spouse Writing | CLB Level 9 or higher",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 12
            ],
            [
                "id" => 87,
                "criterio" => "Spouse Listening | CLB Nivel 4 o menos",
                "criterion" => "Spouse Listening | CLB Level 4 or less",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 13
            ],
            [
                "id" => 88,
                "criterio" => "Spouse Listening | CLB Nivel 5 o 6",
                "criterion" => "Spouse Listening | CLB Level 5 or 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 13
            ],
            [
                "id" => 89,
                "criterio" => "Spouse Listening | CLB Nivel 7 o 8",
                "criterion" => "Spouse Listening | CLB Level 7 or 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 13
            ],
            [
                "id" => 90,
                "criterio" => "Spouse Listening | CLB Nivel 9 o más",
                "criterion" => "Spouse Listening | CLB Level 9 or higher",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 13
            ],
            [
                "id" => 91,
                "criterio" => "Spouse Speaking | CLB Nivel 4 o menos",
                "criterion" => "Spouse Speaking | CLB Level 4 or less",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 14
            ],
            [
                "id" => 92,
                "criterio" => "Spouse Speaking | CLB Nivel 5 o 6",
                "criterion" => "Spouse Speaking | CLB Level 5 or 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 14
            ],
            [
                "id" => 93,
                "criterio" => "Spouse Speaking | CLB Nivel 7 o 8",
                "criterion" => "Spouse Speaking | CLB Nivel 7 o 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 14
            ],
            [
                "id" => 94,
                "criterio" => "Spouse Speaking | CLB Nivel 9 o más",
                "criterion" => "Spouse Speaking | CLB Nivel 9 o más",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 14
            ],
            [
                "id" => 95,
                "criterio" => "Spouse | Sin experiencia laboral en Canadá o menos de 1 año",
                "criterion" => "Spouse | Sin experiencia laboral en Canadá o menos de 1 año",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 15
            ],
            [
                "id" => 96,
                "criterio" => "Spouse | 1 año de experiencia laboral en Canadá",
                "criterion" => "Spouse | 1 año de experiencia laboral en Canadá",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 15
            ],
            [
                "id" => 97,
                "criterio" => "Spouse | 2 años de experiencia laboral en Canadá",
                "criterion" => "Spouse | 2 años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 7,
                "subfactor_id" => 15
            ],
            [
                "id" => 98,
                "criterio" => "Spouse | 3 años de experiencia laboral en Canadá",
                "criterion" => "Spouse | 3 años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 8,
                "subfactor_id" => 15
            ],
            [
                "id" => 99,
                "criterio" => "Spouse | 4 años de experiencia laboral en Canadá",
                "criterion" => "Spouse | 4 años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 9,
                "subfactor_id" => 15
            ],
            [
                "id" => 100,
                "criterio" => "Spouse | 5 o más años de experiencia laboral en Canadá",
                "criterion" => "Spouse | 5 o más años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 10,
                "subfactor_id" => 15
            ],
            [
                "id" => 101,
                "criterio" => "No tiene el nivel de inglés mínimo para los puntos o solo estudio hasta preparatoria o menos.",
                "criterion" => "No tiene el nivel de inglés mínimo para los puntos o solo estudio hasta preparatoria o menos.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 16
            ],
            [
                "id" => 102,
                "criterio" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 16
            ],
            [
                "id" => 103,
                "criterio" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 16
            ],
            [
                "id" => 104,
                "criterio" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 16
            ],
            [
                "id" => 105,
                "criterio" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene nivel de Inglés CLB 9  o más en todas las áreas de inglés",
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene nivel de Inglés CLB 9  o más en todas las áreas de inglés",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 16
            ],
            [
                "id" => 106,
                "criterio" => "No tiene experiencia laboral en Canadá o no tiene carrera profesional o técnica.",
                "criterion" => "No tiene experiencia laboral en Canadá o no tiene carrera profesional o técnica.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 17
            ],
            [
                "id" => 107,
                "criterio" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene 1 año de experiencia laboral en Canadá",
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene 1 año de experiencia laboral en Canadá",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 17
            ],
            [
                "id" => 108,
                "criterio" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene 2 o más años de experiencia laboral en Canadá",
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 17
            ],
            [
                "id" => 109,
                "criterio" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 1 año de experiencia laboral en Canadá",
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 1 año de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 17
            ],
            [
                "id" => 110,
                "criterio" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 2 o más años de experiencia laboral en Canadá",
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 17
            ],
            [
                "id" => 111,
                "criterio" => "No tiene el nivel de inglés mínimo para los puntos o no tiene experiencia laboral fuera de Canadá.",
                "criterion" => "No tiene el nivel de inglés mínimo para los puntos o no tiene experiencia laboral fuera de Canadá.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 18
            ],
            [
                "id" => 112,
                "criterio" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 18
            ],
            [
                "id" => 113,
                "criterio" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 18
            ],
            [
                "id" => 114,
                "criterio" => "Tiene 3 o más años de experiencia laboral fuera de Canadá  y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá  y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 18
            ],
            [
                "id" => 115,
                "criterio" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene nivel de Inglés CLB 9  o más en todas las áreas de inglés",
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene nivel de Inglés CLB 9  o más en todas las áreas de inglés",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 18
            ],
            [
                "id" => 116,
                "criterio" => "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                "criterion" => "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 19
            ],
            [
                "id" => 117,
                "criterio" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá",
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 19
            ],
            [
                "id" => 118,
                "criterio" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá",
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 19
            ],
            [
                "id" => 119,
                "criterio" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá",
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 19
            ],
            [
                "id" => 120,
                "criterio" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá",
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 19
            ],
            [
                "id" => 121,
                "criterio" => "Sin Certificado de Calificacion de alguna provincia (CoQ)",
                "criterion" => "Sin Certificado de Calificacion de alguna provincia (CoQ)",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 20
            ],
            [
                "id" => 122,
                "criterio" => "Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 5 o más en inglés, y una al menos en CLB Nivel 7",
                "criterion" => "Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 5 o más en inglés, y una al menos en CLB Nivel 7",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 20
            ],
            [
                "id" => 123,
                "criterio" => "Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 7 o más en todas las areas de ingles.",
                "criterion" => "Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 7 o más en todas las areas de ingles.",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 20
            ],
            [
                "id" => 124,
                "criterio" => "Sin estudios en Canadá o menos de 1 año de duración.",
                "criterion" => "Sin estudios en Canadá o menos de 1 año de duración.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 21
            ],
            [
                "id" => 125,
                "criterio" => "Estudios en Canadá de 1 o dos años.",
                "criterion" => "Estudios en Canadá de 1 o dos años.",
                "single" => 15,
                "married" => 15,
                "subfactor_id" => 21
            ],
            [
                "id" => 126,
                "criterio" => "Estudios en Canada de al menos 3 años",
                "criterion" => "Estudios en Canada de al menos 3 años",
                "single" => 30,
                "married" => 30,
                "subfactor_id" => 21
            ],
            [
                "id" => 127,
                "criterio" => "Sin oferta de trabajo laboral.",
                "criterion" => "Sin oferta de trabajo laboral.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 22
            ],
            [
                "id" => 128,
                "criterio" => "Con oferta de trabajo laboral en un empleo Categoría NOC 00",
                "criterion" => "Con oferta de trabajo laboral en un empleo Categoría NOC 00",
                "single" => 200,
                "married" => 200,
                "subfactor_id" => 22
            ],
            [
                "id" => 129,
                "criterio" => "Con oferta de trabajo laboral en un empleo Categoría NOC 0, A o B",
                "criterion" => "Con oferta de trabajo laboral en un empleo Categoría NOC 0, A o B",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 22
            ],
            [
                "id" => 130,
                "criterio" => "Sin Certificado de nominación Provincial (PNP Certificate)",
                "criterion" => "Sin Certificado de nominación Provincial (PNP Certificate)",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 23
            ],
            [
                "id" => 131,
                "criterio" => "Con Certificado de nominación Provincial PNP (PNP Certificate)",
                "criterion" => "Con Certificado de nominación Provincial PNP (PNP Certificate)",
                "single" => 600,
                "married" => 600,
                "subfactor_id" => 23
            ],
            [
                "id" => 132,
                "criterio" => "Sin familiar directo en Canadá",
                "criterion" => "Sin familiar directo en Canadá",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 24
            ],
            [
                "id" => 133,
                "criterio" => "Hermano o Hermana que es Ciudadano Canadiense o Residente Permanente de Canadá",
                "criterion" => "Hermano o Hermana que es Ciudadano Canadiense o Residente Permanente de Canadá",
                "single" => 15,
                "married" => 15,
                "subfactor_id" => 24
            ]

        );

        foreach ($data as $item) {
            Criterion::create($item);
        }
    }
}
