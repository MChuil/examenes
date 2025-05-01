<?php

namespace App\Controllers;

use App\Models\User;

class HomeController extends BaseController
{
    public function index(): string
    {
        // $data = [ 
        //     'title' => 'Mi primer proyecto con Codeigniter 4',
        //     'message' => 'Hola desde Codeigniter'
        // ];
        $user = new User();
        $data =[
            'totalStudent' => $user->totalStudent(),
        ];
        return view('home', $data);
    }

    // public function welcome($name = null){
    //     $name = ucfirst($name);
    //     echo "Hola $name, bienvenido(a) a Codeigniter 4";
    // }
}
