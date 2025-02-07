<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Choice;
use App\Models\Question;


class ChoiceSeeder extends Seeder
{
    public function run()
    {
        $choice = new Choice();

        for ($x = 0; $x < 4000; $x++) {
            $choice->insert([
                'question_id' => rand(1, 1000), // pregunta al azar
                'choice_text' => "Opción de prueba {$x}",
                'is_correct'  => ($x % 4 == 0) ? 1 : 0 // Cada 4 respuestas una es correcta
            ]);
        }
    }
}