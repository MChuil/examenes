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

        // 4 respuestas x pregunta
        for ($question_id = 1; $question_id <= 20; $question_id++) {
            $correctAnswer = rand(1, 4); // opcion correcta aleatoria

            for ($option = 1; $option <= 4; $option++) {
                $choice->insert([
                    'question_id' => $question_id,
                    'choice_text' => "Opción {$option} para pregunta {$question_id}",
                    'is_correct'  => ($option === $correctAnswer) ? 1 : 0
                ]);
            }
        }
    }
}