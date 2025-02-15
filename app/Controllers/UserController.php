<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        $data = ['title' => 'Usuarios'];
        return view("users/index", $data);
    }

    public function new()
    {
        $data = ['title' => 'Nuevo Usuario'];
        return view("users/new", $data);
    }

    public function create(){
        try{
            $rules = [
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]|max_length[200]',
                'password_repeat' => 'required|matches[password]',
                'rol' => 'required|in_list[admin,user]'
            ];
            if(!$this->validate($rules)){ //si no paso
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            //encriptar la contarseña
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            
            $data = [
                "name" => strtoupper($this->request->getPost('name')),
                "email" => trim($this->request->getPost('email')),
                "password" => $password,
                "rol" => $this->request->getPost('rol')
            ];
            $user = new User();
            $user->insert($data);
            return redirect()->to(base_url('usuarios'))->with('success', 'Usuario creado correctamente...');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

        
    }
}
