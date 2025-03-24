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
        $response = $choice->find($id);
        return json_encode($response);
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
}
