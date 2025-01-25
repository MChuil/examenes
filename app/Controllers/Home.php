<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [ 
            'title' => 'Mi primer proyecto con Codeigniter 4',
            'message' => 'Hola desde Codeigniter'
        ];
        return view('welcome_message', $data);
    }

    public function welcome($name = null){
        $name = ucfirst($name);
        echo "Hola $name, bienvenido(a) a Codeigniter 4";
    }
}
