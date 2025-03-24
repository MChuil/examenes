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
            $question = new Question();
            
            // validar la cantidad de preguntas
            $count = $question->where('subject_id', $subjectId)->countAllResults();
            if($count >= getenv('MAXQUESTIONS')){
                return redirect()->back()->withInput()->with('errors', 'No se pueden agregar más de ' . getenv('MAXQUESTIONS') . ' preguntas');
            }


            // 1. Guardar la pregunta
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

    public function delete($id)
    {
        try{
            //eliminaciòn fisica de las respuestas
            // $choice = new Choice();
            // $choice->where('question_id', $id)->delete();

            //eliminación logica de la pregunta
            $question = new Question();
            $question->delete($id);
            return redirect()->back()->with('success', 'Pregunta eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage())->withInput();
        }
    }
}
