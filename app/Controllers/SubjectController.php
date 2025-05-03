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
            // $rules = [
            //     'title' => [
            //         'label' => 'Título del examen',
            //         'rules' => 'required|min_length[5]|max_length[100]|is_unique[subjects.title]',
            //         'errors' => [
            //             'required' => 'El campo {field} es obligatorio.',
            //             'min_length' => 'El título debe tener al menos 5 caracteres.',
            //             'max_length' => 'El título no puede tener más de 100 caracteres.',
            //             'is_unique' => 'El título del examen ya existe en la base de datos.'
            //         ]
            //     ],
            // ];

            // if (!$this->validate($rules)) {
            if (!$this->validate('subject')) {
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
            $subjectModel = new Subject();
            $studentAnswerModel = new \App\Models\StudentAnswer();
            $user_id = session('id');
        
            
            $subjects = $subjectModel->findAll();
        
            
            foreach ($subjects as &$exam) {
                $lastAnswer = $studentAnswerModel
                    ->select('student_answers.created_at')
                    ->join('questions', 'questions.id = student_answers.question_id')
                    ->where('student_answers.user_id', $user_id)
                    ->where('questions.subject_id', $exam->id)
                    ->orderBy('student_answers.created_at', 'DESC')
                    ->first();
        
               
                $exam->last_attempt_date = $lastAnswer->created_at ?? null;
            }
        
            $data = [
                'title' => 'Examenes disponibles',
                'subjects' => $subjects
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
                    $questionModel = new \App\Models\Question();

                    $questionIds = $questionModel->where('subject_id', $subject_id)->findColumn('id');

                   
                    if (!empty($questionIds)) {
                        $studentAnswerModel
                            ->where('user_id', $user_id)
                            ->whereIn('question_id', $questionIds)
                            ->delete();
                    }
                    

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
                            'question_id' => $question_id,
                            'choice_id'   => $choice_id,
                            'is_correct'  => $isCorrect,
                            'attempt'     => 1, 
                            'created_at'  => date('Y-m-d H:i:s')
                        ]);
                    }

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

                    
                    $subjectIds = $studentAnswerModel
                        ->select('questions.subject_id')
                        ->join('questions', 'questions.id = student_answers.question_id')
                        ->where('student_answers.user_id', $user_id)
                        ->groupBy('questions.subject_id')
                        ->findColumn('subject_id'); 

                    
                    $subjects = $subjectIds ? $subjectModel->whereIn('id', $subjectIds)->findAll() : [];

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
                        $questionModel = new \App\Models\Question();

                        $subject = $subjectModel->find($subject_id);
                        if (!$subject) {
                            return redirect()->to('/alumno/historial')->with('error', 'Examen no encontrado.');
                        }

                        $questions = $questionModel->where('subject_id', $subject_id)->findAll();
                        $questionIds = array_column($questions, 'id');

                        if (empty($questionIds)) {
                            return redirect()->to('/alumno/historial')->with('error', 'No hay preguntas asociadas a este examen.');
                        }

                        $answers = $studentAnswerModel
                            ->where('user_id', $user_id)
                            ->whereIn('question_id', $questionIds)
                            ->findAll();

                        $correct = 0;
                        foreach ($answers as $answer) {
                            if ($answer->is_correct) {
                                $correct++;
                            }
                        }

                        $total = count($answers);
                        $percentage = $total > 0 ? ($correct / $total) * 100 : 0;

                        $data = [
                            'title' => 'Historial de Resultados',
                            'subject' => $subject,
                            'attempts' => [[
                                'attempt'    => 1,
                                'correct'    => $correct,
                                'incorrect'  => $total - $correct,
                                'total'      => $total,
                                'percentage' => number_format($percentage, 2),
                                'date'       => $answers[0]->created_at ?? date('Y-m-d H:i:s')
                            ]]
                        ];

                        return view('subject/history_detail', $data);
                    }

                    
                    





}
