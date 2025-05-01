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

    public function available()
        {
            $subject = new Subject();
            $data = [
                'title' => 'Examenes dispobnibles',
                'subjects' => $subject->findAll()
            ];
            return view('subject/list', $data); 
        }


        public function resolver($id)
            {
                $subjectModel = new Subject();
                $questionModel = new Question();
                $choiceModel = new \App\Models\Choice();

                $subject = $subjectModel->find($id);

                if (!$subject) {
                    return redirect()->to('/alumno/examenes')->with('error', 'El examen no existe.');
                }

                
                $questions = $questionModel->where('subject_id', $id)->findAll();

                
                foreach ($questions as $question) {
                    $question->choices = $choiceModel
                        ->where('question_id', $question->id)
                        ->findAll();
                }

                $data = [
                    'title' => 'Responder Examen',
                    'subject' => $subject,
                    'questions' => $questions
                ];

                return view('subject/answer', $data);

            }


            public function guardarRespuestas($subject_id)
                {
                    $user_id = session('id');
                    $answers = $this->request->getPost('answers');

                    $choiceModel = new \App\Models\Choice();
                    $studentAnswerModel = new \App\Models\StudentAnswer();

                    $correctCount = 0;
                    $totalQuestions = count($answers);

                    foreach ($answers as $question_id => $choice_id) {
                        $choice = $choiceModel->find($choice_id);

                        $isCorrect = $choice && $choice->is_correct ? 1 : 0;

                        if ($isCorrect) {
                            $correctCount++;
                        }

                        $studentAnswerModel->insert([
                            'user_id'     => $user_id,
                            'subject_id'  => $subject_id,
                            'question_id' => $question_id,
                            'choice_id'   => $choice_id,
                            'is_correct'  => $isCorrect,
                            'created_at'  => date('Y-m-d H:i:s')
                        ]);
                    }

                    //porcentajue de calificacion
                    $percentage = ($correctCount / $totalQuestions) * 100;

                    $data = [
                        'title'           => 'Resultados del Examen',
                        'correctCount'    => $correctCount,
                        'incorrectCount'  => $totalQuestions - $correctCount,
                        'totalQuestions'  => $totalQuestions,
                        'percentage'      => number_format($percentage, 2),
                    ];

                    return view('subject/result', $data);
                }



                public function historial()
                    {
                        $studentAnswerModel = new \App\Models\StudentAnswer();
                        $subjectModel = new \App\Models\Subject();

                        $user_id = session('id');

                       
                        $answeredSubjects = $studentAnswerModel
                            ->select('subject_id')
                            ->where('user_id', $user_id)
                            ->groupBy('subject_id')
                            ->findAll();

                        $subjects = [];

                        foreach ($answeredSubjects as $entry) {
                            $subject = $subjectModel->find($entry->subject_id);
                            if ($subject) {
                                $subjects[] = $subject;
                            }
                        }

                        $data = [
                            'title' => 'Historial de Exámenes',
                            'subjects' => $subjects
                        ];

                        return view('subject/history', $data);
                    }


                    public function verResultados($subject_id)
                    {
                        $user_id = session('id');
                        $studentAnswerModel = new \App\Models\StudentAnswer();
                        $subjectModel = new \App\Models\Subject();

                        $subject = $subjectModel->find($subject_id);

                        if (!$subject) {
                            return redirect()->to('/alumno/historial')->with('error', 'Examen no encontrado.');
                        }

                        $answers = $studentAnswerModel
                            ->where('user_id', $user_id)
                            ->where('subject_id', $subject_id)
                            ->findAll();

                        if (empty($answers)) {
                            return redirect()->to('/alumno/historial')->with('error', 'No has contestado este examen.');
                        }

                        $totalQuestions = count($answers);
                        $correctAnswers = 0;

                        foreach ($answers as $answer) {
                            if ($answer->is_correct) {
                                $correctAnswers++;
                            }
                        }

                        $percentage = ($correctAnswers / $totalQuestions) * 100;

                        $data = [
                            'title' => 'Detalle del Examen',
                            'subject' => $subject,
                            'totalQuestions' => $totalQuestions,
                            'correctAnswers' => $correctAnswers,
                            'incorrectAnswers' => $totalQuestions - $correctAnswers,
                            'percentage' => number_format($percentage, 2)
                        ];

                        return view('subject/history_detail', $data);
                    }





}
