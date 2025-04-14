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

    public function register()
{
    $rules = [
        'name' => [
            'label' => 'Nombre',
            'rules' => 'required|min_length[3]|max_length[100]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El campo {field} debe tener al menos 3 caracteres.',
                'max_length' => 'El campo {field} no puede tener más de 100 caracteres.'
            ]
        ],
        'email' => [
            'label' => 'Correo electrónico',
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'valid_email' => 'El campo {field} debe tener un formato válido.',
                'is_unique' => 'El correo ya está registrado.'
            ]
        ],
        'password' => [
            'label' => 'Contraseña',
            'rules' => 'required|min_length[6]|max_length[200]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'La {field} debe tener al menos 6 caracteres.',
                'max_length' => 'La {field} no puede tener más de 200 caracteres.'
            ]
        ],
        'password_repeat' => [
            'label' => 'Repetir contraseña',
            'rules' => 'required|matches[password]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'matches' => 'Las contraseñas no coinciden.'
            ]
        ]
    ];
    

    if (!$this->validate($rules)) {
        return redirect()->to(base_url('/#signup'))->withInput()->with('error_register', $this->validator->getErrors());
    }

    $userModel = new User();
    $userModel->insert([
        "name" => strtoupper($this->request->getPost('name')),
        "email" => trim($this->request->getPost('email')),
        "password" => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        "rol" => 'student'
    ]);

    return redirect()->to(base_url('/#signin'))->with('success', 'Cuenta creada exitosamente. Inicia sesión.');
}


    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to("/");
    }
}
