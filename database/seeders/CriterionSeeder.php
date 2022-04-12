<?php

namespace Database\Seeders;

use App\Models\Criterion;
use Illuminate\Database\Seeder;

class CriterionSeeder extends Seeder
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
                "id" => 1,
                "criterion" => "17 años o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 1
            ],
            [
                "id" => 2,
                "criterion" => "18 años",
                "single" => 99,
                "married" => 90,
                "subfactor_id" => 1
            ],
            [
                "id" => 3,
                "criterion" => "19 años",
                "single" => 105,
                "married" => 95,
                "subfactor_id" => 1
            ],
            [
                "id" => 4,
                "criterion" => "21 a 29 años",
                "single" => 110,
                "married" => 100,
                "subfactor_id" => 1
            ],
            [
                "id" => 5,
                "criterion" => "30 años",
                "single" => 105,
                "married" => 95,
                "subfactor_id" => 1
            ],
            [
                "id" => 6,
                "criterion" => "31 años",
                "single" => 99,
                "married" => 90,
                "subfactor_id" => 1
            ],
            [
                "id" => 7,
                "criterion" => "32 años",
                "single" => 94,
                "married" => 85,
                "subfactor_id" => 1
            ],
            [
                "id" => 8,
                "criterion" => "33 años",
                "single" => 88,
                "married" => 80,
                "subfactor_id" => 1
            ],
            [
                "id" => 9,
                "criterion" => "34 años",
                "single" => 83,
                "married" => 75,
                "subfactor_id" => 1
            ],
            [
                "id" => 10,
                "criterion" => "35 años",
                "single" => 77,
                "married" => 70,
                "subfactor_id" => 1
            ],
            [
                "id" => 11,
                "criterion" => "36 años",
                "single" => 72,
                "married" => 65,
                "subfactor_id" => 1
            ],
            [
                "id" => 12,
                "criterion" => "37 años",
                "single" => 66,
                "married" => 60,
                "subfactor_id" => 1
            ],
            [
                "id" => 13,
                "criterion" => "38 años",
                "single" => 61,
                "married" => 55,
                "subfactor_id" => 1
            ],
            [
                "id" => 14,
                "criterion" => "39 años",
                "single" => 55,
                "married" => 50,
                "subfactor_id" => 1
            ],
            [
                "id" => 15,
                "criterion" => "40 años",
                "single" => 50,
                "married" => 45,
                "subfactor_id" => 1
            ],
            [
                "id" => 16,
                "criterion" => "41 años",
                "single" => 39,
                "married" => 35,
                "subfactor_id" => 1
            ],
            [
                "id" => 17,
                "criterion" => "42 años",
                "single" => 28,
                "married" => 25,
                "subfactor_id" => 1
            ],
            [
                "id" => 18,
                "criterion" => "43 años",
                "single" => 17,
                "married" => 15,
                "subfactor_id" => 1
            ],
            [
                "id" => 19,
                "criterion" => "44 años ",
                "single" => 6,
                "married" => 5,
                "subfactor_id" => 1
            ],
            [
                "id" => 20,
                "criterion" => "45 años o más",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 1
            ],
            [
                "id" => 21,
                "criterion" => "Secundaria o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 2
            ],
            [
                "id" => 22,
                "criterion" => "Preparatoia o Bachiller",
                "single" => 30,
                "married" => 28,
                "subfactor_id" => 2
            ],
            [
                "id" => 23,
                "criterion" => "Carrera Profesional o técnica de 1 año de duración",
                "single" => 90,
                "married" => 84,
                "subfactor_id" => 2
            ],
            [
                "id" => 24,
                "criterion" => "Carrera Profesional o técnica de 2 años de duración",
                "single" => 98,
                "married" => 91,
                "subfactor_id" => 2
            ],
            [
                "id" => 25,
                "criterion" => "Carrera Profesional o técnica de 3 años de duración o más",
                "single" => 120,
                "married" => 112,
                "subfactor_id" => 2
            ],
            [
                "id" => 26,
                "criterion" => "2 o más carreras o titulos profesionales o técnicos (uno tiene que ser de al menos de 3 años)",
                "single" => 128,
                "married" => 119,
                "subfactor_id" => 2
            ],
            [
                "id" => 27,
                "criterion" => "Maestría",
                "single" => 135,
                "married" => 126,
                "subfactor_id" => 2
            ],
            [
                "id" => 28,
                "criterion" => "Doctoado",
                "single" => 150,
                "married" => 140,
                "subfactor_id" => 2
            ],
            [
                "id" => 29,
                "criterion" => "Reading | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3 o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 3
            ],
            [
                "id" => 30,
                "criterion" => "Reading | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 3.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 3
            ],
            [
                "id" => 31,
                "criterion" => "Reading | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 4",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 3
            ],
            [
                "id" => 32,
                "criterion" => "Reading | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.0",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 3
            ],
            [
                "id" => 33,
                "criterion" => "Reading | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6.0 | Mínimo requerido para FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 3
            ],
            [
                "id" => 34,
                "criterion" => "Reading | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 3
            ],
            [
                "id" => 35,
                "criterion" => "Reading | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7 o 7.5",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 3
            ],
            [
                "id" => 36,
                "criterion" => "Reading | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8 o más",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 3
            ],
            [
                "id" => 37,
                "criterion" => "Listening | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 4 o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 4
            ],
            [
                "id" => 38,
                "criterion" => "Listening | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 4
            ],
            [
                "id" => 39,
                "criterion" => "Listening | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 4
            ],
            [
                "id" => 40,
                "criterion" => "Listening | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 4
            ],
            [
                "id" => 41,
                "criterion" => "Listening | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 o 7 | Mínimo requerido para FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 4
            ],
            [
                "id" => 42,
                "criterion" => "Listening | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 7.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 4
            ],
            [
                "id" => 43,
                "criterion" => "Listening | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 8",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 4
            ],
            [
                "id" => 44,
                "criterion" => "Listening | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8.5 o más",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 4
            ],
            [
                "id" => 45,
                "criterion" => "Writing| CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3.5 o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 5
            ],
            [
                "id" => 46,
                "criterion" => "Writing| CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4 o 4.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 5
            ],
            [
                "id" => 47,
                "criterion" => "Writing| CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 5
            ],
            [
                "id" => 48,
                "criterion" => "Writing| CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 5
            ],
            [
                "id" => 49,
                "criterion" => "Writing| CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 | Mínimo requerido para FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 5
            ],
            [
                "id" => 50,
                "criterion" => "Writing| CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 5
            ],
            [
                "id" => 51,
                "criterion" => "Writing| CLB 9| CELPIP Nivel 9 | IELTS Nivel 7 ",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 5
            ],
            [
                "id" => 52,
                "criterion" => "Writing| CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 7.5 o más",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 5
            ],
            [
                "id" => 53,
                "criterion" => "Speaking | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3.5 o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 6
            ],
            [
                "id" => 54,
                "criterion" => "Speaking | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4 o 4.5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 6
            ],
            [
                "id" => 55,
                "criterion" => "Speaking | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 6
            ],
            [
                "id" => 56,
                "criterion" => "Speaking | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5",
                "single" => 9,
                "married" => 8,
                "subfactor_id" => 6
            ],
            [
                "id" => 57,
                "criterion" => "Speaking | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 | Mínimo requerido para FSW",
                "single" => 17,
                "married" => 16,
                "subfactor_id" => 6
            ],
            [
                "id" => 58,
                "criterion" => "Speaking | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5",
                "single" => 23,
                "married" => 22,
                "subfactor_id" => 6
            ],
            [
                "id" => 59,
                "criterion" => "Speaking | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7 ",
                "single" => 31,
                "married" => 29,
                "subfactor_id" => 6
            ],
            [
                "id" => 60,
                "criterion" => "Speaking | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 7.5 o más",
                "single" => 34,
                "married" => 32,
                "subfactor_id" => 6
            ],
            [
                "id" => 61,
                "criterion" => "CLB Nivel 4 o menos",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 7
            ],
            [
                "id" => 62,
                "criterion" => "CLB Nivel 5 o 7",
                "single" => 1,
                "married" => 1,
                "subfactor_id" => 7
            ],
            [
                "id" => 63,
                "criterion" => "CLB Nivel 7 o 9",
                "single" => 3,
                "married" => 3,
                "subfactor_id" => 7
            ],
            [
                "id" => 64,
                "criterion" => "CLB Nivel 9 o más",
                "single" => 6,
                "married" => 6,
                "subfactor_id" => 7
            ],
            [
                "id" => 65,
                "criterion" => "Sin experiencia laboral en Canadá o menos de 1 año",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 8
            ],
            [
                "id" => 66,
                "criterion" => "1 año de experiencia laboral en Canadá",
                "single" => 40,
                "married" => 35,
                "subfactor_id" => 8
            ],
            [
                "id" => 67,
                "criterion" => "2 años de experiencia laboral en Canadá",
                "single" => 53,
                "married" => 46,
                "subfactor_id" => 8
            ],
            [
                "id" => 68,
                "criterion" => "3 años de experiencia laboral en Canadá",
                "single" => 64,
                "married" => 56,
                "subfactor_id" => 8
            ],
            [
                "id" => 69,
                "criterion" => "4 años de experiencia laboral en Canadá",
                "single" => 72,
                "married" => 63,
                "subfactor_id" => 8
            ],
            [
                "id" => 70,
                "criterion" => "5 o más años de experiencia laboral en Canadá",
                "single" => 80,
                "married" => 70,
                "subfactor_id" => 8
            ],
            [
                "id" => 71,
                "criterion" => "Spouse | Secundaria o menos",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 9
            ],
            [
                "id" => 72,
                "criterion" => "Spouse | Preparatoia",
                "single" => null,
                "married" => 2,
                "subfactor_id" => 9
            ],
            [
                "id" => 73,
                "criterion" => "Spouse | Carrera Profesional o técnica de 1 año de duración",
                "single" => null,
                "married" => 6,
                "subfactor_id" => 9
            ],
            [
                "id" => 74,
                "criterion" => "Spouse | Carrera Profesional o técnica de 2 años de duración",
                "single" => null,
                "married" => 7,
                "subfactor_id" => 9
            ],
            [
                "id" => 75,
                "criterion" => "Spouse | Carrera Profesional o técnica de 3 años de duración o más",
                "single" => null,
                "married" => 8,
                "subfactor_id" => 9
            ],
            [
                "id" => 76,
                "criterion" => "Spouse | 2 Carreras profesionales o técnicas (1 de al menos 3 años de duración=",
                "single" => null,
                "married" => 9,
                "subfactor_id" => 9
            ],
            [
                "id" => 77,
                "criterion" => "Spouse | Maestría o Doctoado",
                "single" => null,
                "married" => 10,
                "subfactor_id" => 9
            ],
            [
                "id" => 78,
                "criterion" => "Spouse Reading| CLB Nivel 4 o menos",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 10
            ],
            [
                "id" => 79,
                "criterion" => "Spouse Reading | CLB Nivel 5 o 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 10
            ],
            [
                "id" => 80,
                "criterion" => "Spouse Reading | CLB Nivel 7 o 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 10
            ],
            [
                "id" => 81,
                "criterion" => "Spouse Reading | CLB Nivel 9 o más",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 10
            ],
            [
                "id" => 82,
                "criterion" => "Spouse Writing | CLB Nivel 4 o menos",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 11
            ],
            [
                "id" => 83,
                "criterion" => "Spouse Writing | CLB Nivel 5 o 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 11
            ],
            [
                "id" => 84,
                "criterion" => "Spouse Writing | CLB Nivel 7 o 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 11
            ],
            [
                "id" => 85,
                "criterion" => "Spouse Writing | CLB Nivel 9 o más",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 11
            ],
            [
                "id" => 86,
                "criterion" => "Spouse Listening | CLB Nivel 4 o menos",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 12
            ],
            [
                "id" => 87,
                "criterion" => "Spouse Listening | CLB Nivel 5 o 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 12
            ],
            [
                "id" => 88,
                "criterion" => "Spouse Listening | CLB Nivel 7 o 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 12
            ],
            [
                "id" => 89,
                "criterion" => "Spouse Listening | CLB Nivel 9 o más",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 12
            ],
            [
                "id" => 90,
                "criterion" => "Spouse Speaking | CLB Nivel 4 o menos",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 13
            ],
            [
                "id" => 91,
                "criterion" => "Spouse Speaking | CLB Nivel 5 o 6",
                "single" => null,
                "married" => 1,
                "subfactor_id" => 13
            ],
            [
                "id" => 92,
                "criterion" => "Spouse Speaking | CLB Nivel 7 o 8",
                "single" => null,
                "married" => 3,
                "subfactor_id" => 13
            ],
            [
                "id" => 93,
                "criterion" => "Spouse Speaking | CLB Nivel 9 o más",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 13
            ],
            [
                "id" => 94,
                "criterion" => "Spouse | Sin experiencia laboral en Canadá o menos de 1 año",
                "single" => null,
                "married" => 0,
                "subfactor_id" => 14
            ],
            [
                "id" => 95,
                "criterion" => "Spouse | 1 año de experiencia laboral en Canadá",
                "single" => null,
                "married" => 5,
                "subfactor_id" => 14
            ],
            [
                "id" => 96,
                "criterion" => "Spouse | 2 años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 7,
                "subfactor_id" => 14
            ],
            [
                "id" => 97,
                "criterion" => "Spouse | 3 años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 8,
                "subfactor_id" => 14
            ],
            [
                "id" => 98,
                "criterion" => "Spouse | 4 años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 9,
                "subfactor_id" => 14
            ],
            [
                "id" => 99,
                "criterion" => "Spouse | 5 o más años de experiencia laboral en Canadá",
                "single" => null,
                "married" => 10,
                "subfactor_id" => 14
            ],
            [
                "id" => 100,
                "criterion" => "No tiene el nivel de inglés mínimo para los puntos o solo estudio hasta preparatoria o menos.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 15
            ],
            [
                "id" => 101,
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 15
            ],
            [
                "id" => 102,
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 15
            ],
            [
                "id" => 103,
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 15
            ],
            [
                "id" => 104,
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 15
            ],
            [
                "id" => 105,
                "criterion" => "No tiene experiencia laboral en Canadá o no tiene carrera profesional o técnica.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 16
            ],
            [
                "id" => 106,
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene 1 año de experiencia laboral en Canadá",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 16
            ],
            [
                "id" => 107,
                "criterion" => "Estudió 1 carrera (de al menos 1 año de duración) y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 16
            ],
            [
                "id" => 108,
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 1 año de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 16
            ],
            [
                "id" => 109,
                "criterion" => "Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 16
            ],
            [
                "id" => 110,
                "criterion" => "No tiene el nivel de inglés mínimo para los puntos o no tiene experiencia laboral fuera de Canadá.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 17
            ],
            [
                "id" => 111,
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 17
            ],
            [
                "id" => 112,
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 17
            ],
            [
                "id" => 113,
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 17
            ],
            [
                "id" => 114,
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene nivel de Inglés CLB 9 o más en todas las áreas de inglés",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 17
            ],
            [
                "id" => 115,
                "criterion" => "No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 18
            ],
            [
                "id" => 116,
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá",
                "single" => 13,
                "married" => 13,
                "subfactor_id" => 18
            ],
            [
                "id" => 117,
                "criterion" => "Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 18
            ],
            [
                "id" => 118,
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 18
            ],
            [
                "id" => 119,
                "criterion" => "Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 18
            ],
            [
                "id" => 120,
                "criterion" => "Sin Certificado de Calificacion de alguna provincia (CoQ)",
                "single" => 0,
                "married" => 0,
                "subfactor_id" => 19
            ],
            [
                "id" => 121,
                "criterion" => "Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 5 o más en inglés, y una al menos en CLB Nivel 7",
                "single" => 25,
                "married" => 25,
                "subfactor_id" => 19
            ],
            [
                "id" => 122,
                "criterion" => "Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 7 o más en todas las areas de ingles.",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 19
            ],
            [
                "id" => 123,
                "criterion" => "Estudios en Canadá de 1 o dos años.",
                "single" => 15,
                "married" => 15,
                "subfactor_id" => 20
            ],
            [
                "id" => 124,
                "criterion" => "Estudios en Canada de al menos 3 años",
                "single" => 30,
                "married" => 30,
                "subfactor_id" => 20
            ],
            [
                "id" => 125,
                "criterion" => "Con oferta de trabajo laboral en un empleo Categoría NOC 00",
                "single" => 200,
                "married" => 200,
                "subfactor_id" => 21
            ],
            [
                "id" => 126,
                "criterion" => "Con oferta de trabajo laboral en un empleo Categoría NOC 0, A o B",
                "single" => 50,
                "married" => 50,
                "subfactor_id" => 21
            ],
            [
                "id" => 127,
                "criterion" => "Con Certificado de nominación Provincial PNP (PNP Certificate)",
                "single" => 600,
                "married" => 600,
                "subfactor_id" => 22
            ]
        );

        foreach ($data as $item) {
            Criterion::create($item);
        }
    }
}