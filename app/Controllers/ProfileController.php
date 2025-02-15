<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Perfil'];
        return view("profile/index", $data);
    }
}
