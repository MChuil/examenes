<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{
    private $session;

    public function __construct(){
        $this->session = session();
    }

    public function index()
    {
        $session = session();
        // if (!$session->get('isLoggedIn')) {
        //     return redirect()->to('/');
        // }

        $userModel = new User();
        // $user = $userModel->find($session->get('id')); 
        $user = $userModel->find($session->id); 

        if (!$user) {
            return redirect()->to('/')->with('error', 'Usuario no encontrado.');
        }

        if($user->rol == 'admin') {
            $user->rol = 'Administrador';
        }else if($user->rol == 'user') {
            $user->rol = 'Estudiante';
        }

        $data = [
            'title' => 'Perfil',
            'user'  => $user
        ];

        return view("profile/index", $data);
    }

    public function changePassword(){
        
        $rules = [
            'current_password' => [
                'label' => 'Contraseña actual',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                ]
            ],
            'new_password' => [
                'label' => 'Nueva contraseña',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'min_length' => 'La {field} debe tener al menos 6 caracteres.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirmar nueva contraseña',
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'El campo {field} es obligatorio.',
                    'matches' => 'Las contraseñas no coinciden.'
                ]
            ]
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    

        $curretPassword = $this->request->getPost('current_password');
        $newPassword = $this->request->getPost('new_password'); 
        $confirmPassword = $this->request->getPost('confirm_password');

        
        //1. Validar que la contraseña actual sea correcta
        $users = new User();
        $user = $users->select('password')->find($this->session->id);
        if(password_verify($curretPassword, $user->password)){ 
            //2 . Actualizar la nueva contraseña
            $data = ['password' =>  password_hash($newPassword, PASSWORD_DEFAULT)];
            $users->update($this->session->id, $data);
            return redirect()->to(base_url('perfil'))->with('success', 'Contraseña actualizada correctamente.');
        }else{
            return redirect()->back()->with('error', 'La contraseña actual no es correcta.');
        }
    }
}
