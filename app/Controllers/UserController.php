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
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|is_unique[users.email]', // Validar que el email no exista
                'password' => 'required|min_length[6]|max_length[200]',
                'password_repeat' => 'required|matches[password]',
                'rol' => 'required|in_list[admin,user]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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

            return redirect()->to(base_url('usuarios'))->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
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
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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
        $userModel = new User();
        if ($userModel->find($id)) {
            $userModel->delete($id);
            return redirect()->to(base_url('usuarios'))->with('success', 'Usuario eliminado correctamente.');
        } else {
            return redirect()->to(base_url('usuarios'))->with('error', 'Usuario no encontrado.');
        }
    }
}
