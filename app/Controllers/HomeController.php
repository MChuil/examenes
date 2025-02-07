<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index(): string
    {
        // $data = [ 
        //     'title' => 'Mi primer proyecto con Codeigniter 4',
        //     'message' => 'Hola desde Codeigniter'
        // ];
        return view('home');
    }

    // public function welcome($name = null){
    //     $name = ucfirst($name);
    //     echo "Hola $name, bienvenido(a) a Codeigniter 4";
    // }
}
