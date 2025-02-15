<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\Question;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $question = new Question();

        for ($x = 1; $x <= 20; $x++) {
            $question->insert([
                'question' => "Pregunta de prueba {$x}"
            ]);
        }
    }
}