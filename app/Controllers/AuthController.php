<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view("auth/index");
    }

    public function login(){
        $rules = [
            'email' => [
                'label' => 'Correo electrónico',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'valid_email' => 'El {field} debe ser válido.'
                ]
            ],
            'password' => [
                'label' => 'Contraseña',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.'
                ]
            ]
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
        }

        $email = $this->request->getPost("email");
        $password = $this->request->getPost("password");
        //verificar si el usuario existe
        $users = new User();
        $user = $users->where("email", $email)->first();
        if($user){ //si el usuario existe
            //verificar si la (contraseña es correcta
            if(password_verify($password, $user->password)){ //si la contraseña es correcta
                //creamos los datos de session
                $session = session();
                $session->set([
                    "id" => $user->id,
                    "email" => $user->email,
                    "name" => $user->name,
                    "isLoggedIn" => true
                ]);
                //redirigir al tablero
                return redirect()->to("/tablero");
            }
            return redirect()->back()->with('error', 'Credenciales incorrectas')->withInput();
        }
        return redirect()->back()->with('error', 'Credenciales incorrectas')->withInput();
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to("/");
    }
}
