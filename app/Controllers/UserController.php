<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new User();
        $data = [
            'title' => 'Usuarios',
            'users' => $userModel->findAll() // Obtener todos los usuarios
        ];
        return view("users/index", $data);
    }

    public function new()
    {
        $data = ['title' => 'Nuevo Usuario'];
        return view("users/new", $data);
    }

    public function create()
    {
        try {
            $rules = [
                'name' => [
                    'label' => 'Nombre',
                    'rules' =>  'required|min_length[3]|max_length[100]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'min_length' => 'Epa, ni modos que tengas un {field} tan corto, minimo 4 caracteres.',
                        'max_length' => 'Sos largo, ese {field} no existe maximo 100 caracteres.'
                    ]
                ],
                'email' => [
                    'label' => 'Correo electrónico',
                    'rules' => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'valid_email' => 'El campo {field} debe ser un email válido.',
                        'is_unique' => 'El campo {field} ya existe en la base de datos.'
                    ]
                ],
                'password' => [
                    'label' => 'Contraseña',
                    'rules' =>  'required|min_length[6]|max_length[200]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'min_length' => 'El campo {field} debe tener minimo 6 caracteres.',
                        'max_length' => 'El campo {field} debe tener maximo 200 caracteres.'
                    ]
                ],
                'password_repeat' => [
                    'label' => 'Repetir contraseña',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'matches' => 'Las contraseñas no coinciden.'
                    ]
                ],
                'rol' => [
                    'label' => 'Rol',
                    'rules' => 'required|in_list[admin,user]',
                    'errors' => [
                        'required' => 'El campo {field} es obligatorio.',
                        'in_list' => 'El campo {field} debe ser admin o user.'
                    ]
                ]
            ];

            
            if (!$this->validate($rules)) {
                return redirect()->to(base_url('/#signup'))->withInput()->with('error_register', $this->validator->getErrors());
            }

            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

            $data = [
                "name" => strtoupper($this->request->getPost('name')),
                "email" => trim($this->request->getPost('email')),
                "password" => $password,
                "rol" => $this->request->getPost('rol')
            ];

            $userModel = new User();
            $userModel->insert($data);

            // UserController.php
            return redirect()->to(base_url('/#signin'))->with('success', 'Usuario creado correctamente. Inicia sesión.');
            } catch (\Exception $e) {
                return redirect()->to(base_url('/#signup'))->with('error_register', $e->getMessage())->withInput();
            }
    }

    public function edit($id)
    {
        $userModel = new User();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to(base_url('usuarios'))->with('error', 'Usuario no encontrado.');
        }

        $data = [
            'title' => 'Editar Usuario',
            'user' => $user
        ];

        return view('users/edit', $data);
    }

    public function update($id)
    {
        try {
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => "required|valid_email|is_unique[users.email,id,$id]",
                'rol' => 'required|in_list[admin,user]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->to(base_url("usuarios/edit/{$id}"))->withInput()->with('error', $this->validator->getErrors());
            }
            $data = [
                "name" => strtoupper($this->request->getPost('name')),
                "email" => trim($this->request->getPost('email')),
                "rol" => $this->request->getPost('rol')
            ];

            $userModel = new User();
            $userModel->update($id, $data);

            return redirect()->to(base_url('usuarios'))->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        // $userModel = new User();
        // if ($userModel->find($id)) {
        //     $userModel->delete($id);
        //     return redirect()->to(base_url('usuarios'))->with('success', 'Usuario eliminado correctamente.');
        // } else {
        //     return redirect()->to(base_url('usuarios'))->with('error', 'Usuario no encontrado.');
        // }


        try{
            $user = new User();
            $user->delete($id);
            return redirect()->to(base_url('usuarios'))->with('success', 'Usuario eliminado correctamente.');
        }catch(\Exception $e){
            return redirect()->to(base_url('usuarios'))->with('error', $e->getMessage());
        }
    }
}
