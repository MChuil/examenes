<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Choice;
use App\Models\Question;
use CodeIgniter\HTTP\ResponseInterface;

class QuestionController extends BaseController
{
    public function index()
    {
        //
    }

    public function create(){
        $data = $this->request->getPost();
        echo json_encode($data);
    
        try{
            $rules = [
                'question' => 'required|min_length[5]|max_length[150]',
                'choice-correct' => 'required',
                'choice-1' => 'required',
                'choice-2' => 'required',
                'choice-3' => 'required',
                'choice-4' => 'required',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $subjectId = $this->request->getPost('subject_id');
            // 1. Guardar la pregunta
            $question = new Question();
            $idQuestion = $question->insert(['subject_id' => $subjectId, 'question' => $this->request->getPost('question')]);

            // 2. Guardar las opciones
            $choice = new Choice();
            for ($i=1; $i <=4 ; $i++) {
                $response = $this->request->getPost("choice-{$i}");
                $isCorrect = $this->request->getPost('choice-correct') == $i ? 1 : 0;
                $choice->insert([
                    'question_id' => $idQuestion,
                    'is_correct' => $isCorrect,
                    'choice_text' => $response
                ]);
            }

            return redirect()->to(base_url("examenes/show/{$subjectId}"))->with('success', 'Pregunta creada correctamente.');

        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage())->withInput();
        }
    }
}
