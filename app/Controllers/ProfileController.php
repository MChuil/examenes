<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    public function index()
    {
        $session = session();

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

       
        $userModel = new User();
        $user = $userModel->find($session->get('id'));

        if (!$user) {
            return redirect()->to('/login')->with('error', 'Usuario no encontrado.');
        }

        $data = [
            'title' => 'Perfil',
            'user'  => $user
        ];

        return view("profile/index", $data);
    }
}
