<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Factor 1 */
        DB::table('questions')->insert([
            'id' => 1,
            'title' => 'Edad',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 2,
            'title' => 'Experiencia Laboral en Canadá',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 3,
            'title' => 'Educación',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 4,
            'title' => 'Idioma - Reading',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 5,
            'title' => 'Idioma - Listening',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 6,
            'title' => 'Idioma - Writing',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 7,
            'title' => 'Idioma - Speaking',
            'factor_id' => 1,
        ]);
        DB::table('questions')->insert([
            'id' => 8,
            'title' => 'Segundo Idioma',
            'factor_id' => 1,
        ]);
        /* Factor 2 */
        DB::table('questions')->insert([
            'id' => 9,
            'title' => ' Education and Language',
            'factor_id' => 2,
        ]);
        DB::table('questions')->insert([
            'id' => 10,
            'title' => 'Education and Canadian Work Experience',
            'factor_id' => 2,
        ]);
        DB::table('questions')->insert([
            'id' => 11,
            'title' => 'Language and Foreign Work Experience',
            'factor_id' => 2,
        ]);
        DB::table('questions')->insert([
            'id' => 12,
            'title' => 'Canadian Work Experience and Foreign Work Experience',
            'factor_id' => 2,
        ]);
        DB::table('questions')->insert([
            'id' => 13,
            'title' => 'Certificate of Qualification and Language',
            'factor_id' => 2,
        ]);
        /* Factor 3 */
        DB::table('questions')->insert([
            'id' => 14,
            'title' => 'Additional Points - Family member in Canada',
            'factor_id' => 3,
        ]);
        DB::table('questions')->insert([
            'id' => 15,
            'title' => 'Additional Points - Education',
            'factor_id' => 3,
        ]);
        DB::table('questions')->insert([
            'id' => 16,
            'title' => 'Additional Points - Job offer in Canada',
            'factor_id' => 3,
        ]);
        DB::table('questions')->insert([
            'id' => 17,
            'title' => 'Additional Points - PNP',
            'factor_id' => 3,
        ]);
      /*   DB::table('questions')->insert([
            'id' => 18,
            'factor_id' => 3,
        ]); */
    }
}
