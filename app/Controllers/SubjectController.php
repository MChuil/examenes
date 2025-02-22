<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Subject;
use CodeIgniter\HTTP\ResponseInterface;

class SubjectController extends BaseController
{
    public function index()
    {
        $subject = new Subject();
        $data = [
            'title' => 'Exámenes', 
            'subjects' => $subject->findAll()
        ];
        return view("subject/index", $data);
    }

    public function new()
    {
        $data = ['title' => 'Nuevo Examen'];
        return view("subject/new", $data);
    }

    public function create()
    {
        try {
            $rules = [
                'title' => 'required|min_length[5]|max_length[100]|is_unique[subjects.title]',
                // 'questions' => 'required|array',
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $examData = [
                "title" => strtoupper($this->request->getPost('title')),
            ];

            $subject = new Subject();
            $id = $subject->insert($examData);

            // foreach ($this->request->getPost('questions') as $questionData) {
            //     $question = new Question();
            //     $questionId = $question->insert([
            //         'exam_id' => $examId,
            //         'text' => $questionData['text'],
            //     ], true);

            //     foreach ($questionData['choices'] as $choiceData) {
            //         $choice = new Choice();
            //         $choice->insert([
            //             'question_id' => $questionId,
            //             'text' => $choiceData['text'],
            //             'is_correct' => $choiceData['is_correct'] ?? 0,
            //         ]);
            //     }
            // }

            return redirect()->to(base_url('examenes'))->with('success', 'Examen creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage())->withInput();
        }
    }

    public function show($id){
        $subject = new Subject();
        $subject->select('subjects.*, questions.id AS question_id, questions.question AS question_text, choices.id AS choice_id, choices.choice_text AS choice_text, choices.is_correct');
        $subject->join('questions', 'questions.subject_id = subjects.id');
        $subject->join('choices', 'choices.question_id = questions.id');
        $subject->where('subjects.id', $id);
        $response = $subject->findAll();

        echo json_encode($response);
        return;
        $data = [
            'title' => 'Examen',
            'subject' => $response
        ];
        return view("subject/show", $data);
    }
}
