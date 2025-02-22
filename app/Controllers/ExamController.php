<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Choice;
use CodeIgniter\HTTP\ResponseInterface;

class ExamController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Exámenes'];
        return view("exams/index", $data);
    }

    public function new()
    {
        $data = ['title' => 'Nuevo Examen'];
        return view("exams/new", $data);
    }

    public function create()
    {
        try {
            $rules = [
                'title' => 'required|min_length[3]|max_length[100]',
                'questions' => 'required|array',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $examData = [
                "title" => strtoupper($this->request->getPost('title')),
            ];

            $exam = new Exam();
            $examId = $exam->insert($examData, true);

            foreach ($this->request->getPost('questions') as $questionData) {
                $question = new Question();
                $questionId = $question->insert([
                    'exam_id' => $examId,
                    'text' => $questionData['text'],
                ], true);

                foreach ($questionData['choices'] as $choiceData) {
                    $choice = new Choice();
                    $choice->insert([
                        'question_id' => $questionId,
                        'text' => $choiceData['text'],
                        'is_correct' => $choiceData['is_correct'] ?? 0,
                    ]);
                }
            }

            return redirect()->to(base_url('examenes'))->with('success', 'Examen creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
