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
                "factor_id" => 2
            ],
            [
                "id" => 3,
                "subfactor" => "Education",
                "factor_id" => 2
            ],
            [
                "id" => 4,
                "subfactor" => "Language | Reading",
                "factor_id" => 2
            ],
            [
                "id" => 5,
                "subfactor" => "Language | Listening",
                "factor_id" => 2
            ],
            [
                "id" => 6,
                "subfactor" => "Language | Writing",
                "factor_id" => 2
            ],
            [
                "id" => 7,
                "subfactor" => "Language | Speaking",
                "factor_id" => 2
            ],
            [
                "id" => 8,
                "subfactor" => "Second Language",
                "factor_id" => 2
            ],
            [
                "id" => 9,
                "subfactor" => "Canada Experience",
                "factor_id" => 2
            ],
            [
                "id" => 10,
                "subfactor" => "Spouse Education",
                "factor_id" => 5
            ],
            [
                "id" => 11,
                "subfactor" => "Spouse language | Reading",
                "factor_id" => 5
            ],
            [
                "id" => 12,
                "subfactor" => "Spouse language | Writing",
                "factor_id" => 5
            ],
            [
                "id" => 13,
                "subfactor" => "Spouse language | Listening",
                "factor_id" => 5
            ],
            [
                "id" => 14,
                "subfactor" => "Spouse language | Speaking",
                "factor_id" => 5
            ],
            [
                "id" => 15,
                "subfactor" => "Spouse Can W. Exp",
                "factor_id" => 5
            ],
            [
                "id" => 16,
                "subfactor" => "Education and Language",
                "factor_id" => 3
            ],
            [
                "id" => 17,
                "subfactor" => "Education and Canadian Wok Experience",
                "factor_id" => 3
            ],
            [
                "id" => 18,
                "subfactor" => "Language and Foeign Wok Experience",
                "factor_id" => 3
            ],
            [
                "id" => 19,
                "subfactor" => "Canadian Wok Experience and Foeign Wok Experience",
                "factor_id" => 3
            ],
            [
                "id" => 20,
                "subfactor" => "Certificate of Qualification and Language",
                "factor_id" => 3
            ],
            [
                "id" => 21,
                "subfactor" => "Additional Points | Education",
                "factor_id" => 4
            ],
            [
                "id" => 22,
                "subfactor" => "Additional Points | Job Offer",
                "factor_id" => 4
            ],
            [
                "id" => 23,
                "subfactor" => "Additional Points | PNP",
                "factor_id" => 4
            ],
            [
                "id" => 24,
                "subfactor" => "Additional Points | Family Member in Canada",
                "factor_id" => 4
            ]
        );

        foreach ($data as $item) {
            Subfactor::create($item);
        }
    }
}