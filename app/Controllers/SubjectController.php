<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Question;
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

    // Crea el examen
    public function create()
    {
        try {
            // Definir las reglas de validación
            $rules = [
                'title' => [
                    'label' => 'Título del examen',
                    'rules' => 'required|min_length[5]|max_length[100]|is_unique[subjects.title]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'min_length' => 'El título debe tener al menos 5 caracteres.',
                        'max_length' => 'El título no puede tener más de 100 caracteres.',
                        'is_unique' => 'El título del examen ya existe en la base de datos.'
                    ]
                ],
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

    // Muestra el examen y sus preguntas
    public function show($id){
        $subjects = new Subject();
        $subject = $subjects->find($id);

        $questions = new Question();
        $questions->select('questions.*, choices.id AS choice_id, choices.choice_text, choices.is_correct');
        $questions->join('choices', 'choices.question_id = questions.id');
        $questions->where('questions.subject_id', $id);
        $dataQuestions = $questions->findAll();

        $data = [
            'title' => 'Examen',
            'subject' => $subject,
            'dataQuestions' => $dataQuestions
        ];
        return view("subject/show", $data);
    }

    public function edit($id){
        $subject = new Subject();
        $data = [
            'title' => 'Editar Examen',
            'subject' => $subject->find($id)
        ];
        return view("subject/edit", $data);
    }

    public function update($id){
        //reglas de validaciòn

        $title = $this->request->getPost('title');
        //Actualizar el examen
        $subject = new Subject();
        $subject->update($id, ['title' => $title]);
        //reririgir a la lista de examenes
        return redirect()->to(base_url('examenes'))->with('success', 'Examen actualizado correctamente.');
        
    }
}
