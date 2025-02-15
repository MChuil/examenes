<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ExamController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Exámenes'];
        return view("exams/index", $data);
    }
}
