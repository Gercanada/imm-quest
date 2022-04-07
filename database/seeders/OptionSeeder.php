<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Question 1 */
        DB::table('options')->insert([
            'description' => '17 años o menos',
            'single_score' => 0,
            'married_score' => 0,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '18 años',
            'single_score' => 99,
            'married_score' => 90,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '19 años',
            'single_score' => 105,
            'married_score' => 95,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '21 a 29 años',
            'single_score' => 110,
            'married_score' => 100,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '30 años',
            'single_score' => 105,
            'married_score' => 95,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '31 años',
            'single_score' => 99,
            'married_score' => 90,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '32 años',
            'single_score' => 94,
            'married_score' => 85,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '33 años',
            'single_score' => 88,
            'married_score' => 80,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '34 años',
            'single_score' => 83,
            'married_score' => 75,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '35 años',
            'single_score' => 77,
            'married_score' => 70,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '36 años',
            'single_score' => 72,
            'married_score' => 65,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '37 años',
            'single_score' => 66,
            'married_score' => 60,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '38 años',
            'single_score' => 61,
            'married_score' => 55,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '39 años',
            'single_score' => 55,
            'married_score' => 50,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '40 años',
            'single_score' => 50,
            'married_score' => 45,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '41 años',
            'single_score' => 31,
            'married_score' => 35,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '42 años',
            'single_score' => 28,
            'married_score' => 25,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '43 años',
            'single_score' => 17,
            'married_score' => 15,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '44 años',
            'single_score' => 6,
            'married_score' => 5,
            'question_id' => 1,
        ]);
        DB::table('options')->insert([
            'description' => '45 años o mas',
            'single_score' => 0,
            'married_score' => 0,
            'question_id' => 1,
        ]);
        /* Question 2 */
        DB::table('options')->insert([
            'description' => 'Secundaria o menos',
            'single_score' => 0,
            'married_score' => 0,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => 'Preparatoia o Bachiller',
            'single_score' => 30,
            'married_score' => 28,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => 'Carrera Profesional o técnica de 1 año de duración',
            'single_score' => 90,
            'married_score' => 84,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => 'Carrera Profesional o técnica de 2 años de duración',
            'single_score' => 98,
            'married_score' => 91,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => 'Carrera Profesional o técnica de 3 años de duración o más',
            'single_score' => 120,
            'married_score' => 112,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => '2 o más carreras o titulos profesionales o técnicos (uno tiene que ser de al menos de 3 años)',
            'single_score' => 128,
            'married_score' => 119,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => 'Maestría',
            'single_score' => 135,
            'married_score' => 126,
            'question_id' => 3,
        ]);
        DB::table('options')->insert([
            'description' => 'Doctoado',
            'single_score' => 150,
            'married_score' => 140,
            'question_id' => 3,
        ]);
        /*Factor 2 Question 3 */
        DB::table('options')->insert([
            'description' => 'Reading | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3 o menos',
            'single_score' => 0, 'married_score' =>     0,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 3.5',
            'single_score' => 6,
            'married_score' => 6,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 4',
            'single_score' => 6,
            'married_score' =>     6,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.0',
            'single_score' => 9, 'married_score' =>     8,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6.0 | Mínimo requerido para FSW',
            'single_score' => 17,
            'married_score' => 16,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5',
            'single_score' => 23,
            'married_score' => 22,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7 o 7.5',
            'single_score' => 31,
            'married_score' => 29,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Reading | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8 o más',
            'single_score' => 34,
            'married_score' => 32,
            'question_id' => 4,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 4 o menos',
            'single_score' =>    0,
            'married_score' => 0,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4.5',
            'single_score' =>    6,
            'married_score' =>     6,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5	',
            'single_score' => 6,
            'married_score' =>     6,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5', 'single_score' =>    9,
            'married_score' => 8,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 o 7 | Mínimo requerido para FSW',
            'single_score' =>    17,
            'married_score' => 16,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 7.5',
            'single_score' =>    23,
            'married_score' =>     22,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 8',
            'single_score' =>    31,
            'married_score' =>     29,
            'question_id' => 5,
        ]);
        DB::table('options')->insert([
            'description' => 'Listening | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 8.5 o más',
            'single_score' =>    34,
            'married_score' =>     32,
            'question_id' => 5,
        ]);
        /* Question 4 */
        DB::table('options')->insert([
            'description' => 'Writing| CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3.5 o menos',
            'single_score' =>     0,    'married_score' => 0,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4 o 4.5',
            'single_score' => 6,    'married_score' => 6,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5',
            'single_score' => 6,
            'married_score' => 6,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5',
            'single_score' =>     9,
            'married_score' => 8,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 | Mínimo requerido para FSW', 'single_score' => 17,    'married_score' => 16,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5',
            'single_score' => 23,
            'married_score' => 22,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 9| CELPIP Nivel 9 | IELTS Nivel 7',
            'single_score' => 31,    'married_score' => 29,
            'question_id' => 6,
        ]);
        DB::table('options')->insert([
            'description' => 'Writing| CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 7.5 o más', 'single_score' => 34, 'married_score' => 32,
            'question_id' => 6,
        ]);
        /* Question 5 */
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 3 | CELPIP Nivel 3 o menos | IELTS Nivel 3.5 o menos', 'single_score' =>    0, 'married_score' => 0,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 4 | CELPIP Nivel 4 | IELTS Nivel 4 o 4.5', 'single_score' =>    6, 'married_score' => 6,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 5 | CELPIP Nivel 5 | IELTS Nivel 5', 'single_score' =>    6, 'married_score' => 6,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 6 | CELPIP Nivel 6 | IELTS Nivel 5.5', 'single_score' =>    9, 'married_score' => 8,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 7 | CELPIP Nivel 7 | IELTS Nivel 6 | Mínimo requerido para FSW', 'single_score' =>    17, 'married_score' => 16,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 8 | CELPIP Nivel 8 | IELTS Nivel 6.5', 'single_score' =>    23, 'married_score' => 22,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 9 | CELPIP Nivel 9 | IELTS Nivel 7', 'single_score' =>     31, 'married_score' => 29,
            'question_id' => 7,

        ]);
        DB::table('options')->insert([
            'description' => 'Speaking | CLB 10 | CELPIP Nivel 10 o más | IELTS Nivel 7.5 o más', 'single_score' =>    34, 'married_score' => 32,
            'question_id' => 7,
        ]);
        /* Question 7 */
        DB::table('options')->insert([
            'description' => 'CLB Nivel 4 o menos', 'single_score' =>      0, 'married_score' => 0,
            'question_id' => 8,
        ]);
        DB::table('options')->insert([
            'description' => 'CLB Nivel 5 o 7', 'single_score' =>      1, 'married_score' => 1,
            'question_id' => 8,
        ]);
        DB::table('options')->insert([
            'description' => 'CLB Nivel 7 o 9', 'single_score' =>      3, 'married_score' => 3,
            'question_id' => 8,
        ]);
        DB::table('options')->insert([
            'description' => 'CLB Nivel 9 o más', 'single_score' =>      6, 'married_score' => 6,
            'question_id' => 8,
        ]);
        /*Factor 2 question 9 */
        DB::table('options')->insert([
            'description' => 'No tiene el nivel de inglés mínimo para los puntos o solo estudio hasta preparatoria o menos.	',
            'single_score' => 0,
            'married_score' => 0,
            'question_id' => 9,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más	',
            'single_score' => 13,
            'married_score' => 13,
            'question_id' => 9,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 1 carrera (de al menos 1 año de duración) y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés',
            'single_score' =>     25,
            'married_score' =>     25,
            'question_id' => 9,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más	',
            'single_score' => 25,
            'married_score' =>     25,
            'question_id' => 9,
        ]);
        /* Question 10 */
        DB::table('options')->insert([
            'description' => 'No tiene experiencia laboral en Canadá o no tiene carrera profesional o técnica.	', 'single_score' => 0, 'married_score' => 0,
            'question_id' => 10,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 1 carrera (de al menos 1 año de duración) y tiene 1 año de experiencia laboral en Canadá	', 'single_score' => 13, 'married_score' => 13,
            'question_id' => 10,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 1 carrera (de al menos 1 año de duración) y tiene 2 o más años de experiencia laboral en Canadá	', 'single_score' => 25, 'married_score' => 25,
            'question_id' => 10,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 1 año de experiencia laboral en Canadá	', 'single_score' => 25, 'married_score' => 25,
            'question_id' => 10,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudió 2 o más carreras (una al menos de 3 años de duración) y tiene 2 o más años de experiencia laboral en Canadá	', 'single_score' => 50, 'married_score' => 50,
            'question_id' => 10,
        ]);
        /* Question 11 */
        DB::table('options')->insert([
            'description' => 'No tiene el nivel de inglés mínimo para los puntos o no tiene experiencia laboral fuera de Canadá.', 'single_score' =>     0, 'married_score' =>    0,
            'question_id' => 11,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más', 'single_score' =>     13, 'married_score' =>    13,
            'question_id' => 11,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene Nivel de Inglés CLB 9 o más en todas las áreas de inglés', 'single_score' =>     25, 'married_score' =>    25,
            'question_id' => 11,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 3 o más años de experiencia laboral fuera de Canadá  y tiene al menos nivel de Inglés CLB 7 en 3 areas y 1 área en CLB nivel 9 o más', 'single_score' =>     25, 'married_score' =>    25,
            'question_id' => 11,
        ]);
        DB::table('options')->insert([
            'question_id' => 11,
            'description' => 'Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene nivel de Inglés CLB 9  o más en todas las áreas de inglés',
            'single_score' =>     50, 'married_score' =>    50,
        ]);
        /* Question 12 */
        DB::table('options')->insert([
            'description' => 'No tienen experiencia laboral en Canadá o no tiene experiencia laboral fuera de Canadá.', 'single_score' =>     0, 'married_score' => 0,
            'question_id' => 12,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá', 'single_score' =>     13, 'married_score' => 13,
            'question_id' => 12,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 1 o 2 años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá', 'single_score' =>     25, 'married_score' =>    25,
            'question_id' => 12,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 1 año de experiencia laboral en Canadá', 'single_score' =>     25, 'married_score' => 25,
            'question_id' => 12,
        ]);
        DB::table('options')->insert([
            'description' => 'Tiene 3 o más años de experiencia laboral fuera de Canadá y tiene 2 o más años de experiencia laboral en Canadá',
            'single_score' =>     50, 'married_score' =>    50,
            'question_id' => 12,
        ]);
        /* Question 13 */
        DB::table('options')->insert([
            'description' => 'Sin Certificado de Calificacion de alguna provincia (CoQ)	', 'single_score' => 0, 'married_score' => 0,
            'question_id' => 13,
        ]);
        DB::table('options')->insert([
            'description' => 'Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 5 o más en inglés, y una al menos en CLB Nivel 7	', 'single_score' => 25, 'married_score' =>    25,
            'question_id' => 13,
        ]);
        DB::table('options')->insert([
            'description' => 'Con Certificado de Calificación de alguna provincia (CoQ) y CLB Nivel 7 o más en todas las areas de ingles.	', 'single_score' => 50, 'married_score' => 50,
            'question_id' => 13,
        ]);
        /* Factor 3 Question 14 */
        DB::table('options')->insert([
            'description' => ' Sin familiar directo en Canadá	', 'single_score' => 0, 'married_score' =>    0,
            'question_id' => 14,
        ]);
        DB::table('options')->insert([
            'description' => 'Hermano o Hermana que es Ciudadano Canadiense o Residente Permanente de Canadá',
            'single_score' => 15, 'married_score' =>    15,
            'question_id' => 14,
        ]);
        /* Question 15 */
        DB::table('options')->insert([
            'description' => 'Sin estudios en Canadá o menos de 1 año de duración.', 'single_score' =>    0, 'married_score' =>     0,
            'question_id' => 15,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudios en Canadá de 1 o dos años.', 'single_score' =>    15, 'married_score' =>     15,
            'question_id' => 15,
        ]);
        DB::table('options')->insert([
            'description' => 'Estudios en Canada de al menos 3 años', 'single_score' =>    30, 'married_score' =>     30,
            'question_id' => 15,
        ]);
        /* Question 16 */
        DB::table('options')->insert([
            'description' => 'Sin oferta de trabajo laboral.', 'single_score' =>    0, 'married_score' => 0,
            'question_id' => 16,
        ]);
        DB::table('options')->insert([
            'description' => 'Con oferta de trabajo laboral en un empleo Categoría NOC 00', 'single_score' =>    200, 'married_score' => 200,
            'question_id' => 16,
        ]);
        DB::table('options')->insert([
            'description' => 'Con oferta de trabajo laboral en un empleo Categoría NOC 0, A o B', 'single_score' =>    50, 'married_score' =>    50,
            'question_id' => 16,
        ]);
        /* Question 17 */
        DB::table('options')->insert([
            'description' => 'Sin Certificado de nominación Provincial (PNP Certificate)', 'single_score' =>     0, 'married_score' =>      0,
            'question_id' => 17,
        ]);
        DB::table('options')->insert([
            'description' => 'Con Certificado de nominación Provincial PNP (PNP Certificate)', 'single_score' =>     600, 'married_score' =>  600,
            'question_id' => 17,
        ]);
    }
}
