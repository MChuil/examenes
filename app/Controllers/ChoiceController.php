<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Choice;
use CodeIgniter\HTTP\ResponseInterface;

class ChoiceController extends BaseController
{
    public function index()
    {
        //
    }

    public function show($id){
        $choice = new Choice();
        $data = $choice->find($id);

        return $this->response->setJSON($data); 
    }

    public function delete($id){
        try{
            $choice = new Choice();
            $choice->delete($id);
            return redirect()->back()->with('success', 'Respuesta eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', $e->getMessage())->withInput();
        }
    }

    public function update()
{
    $choiceId = $this->request->getPost('id');
    $choiceText = $this->request->getPost('choice_text');
    $isCorrect = $this->request->getPost('is_correct') === 'on' ? 1 : 0;

    $choice = new Choice();
    $currentChoice = $choice->find($choiceId);

    if (!$currentChoice) {
        return redirect()->back()->with('errors', 'La respuesta no existe.');
    }

    if ($isCorrect) {
      
        $choice->where('question_id', $currentChoice->question_id)
               ->set('is_correct', 0)
               ->update();
    }


    $choice->update($choiceId, [
        'choice_text' => $choiceText,
        'is_correct' => $isCorrect
    ]);

    return redirect()->back()->with('success', 'Respuesta actualizada correctamente.');
}

}
