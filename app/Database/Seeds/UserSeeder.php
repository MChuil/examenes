<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        //array de datos
        // $data = [
        //     'name' => 'Miguel Chuil', 
        //     'email' => 'miguel@gmail.com',
        //     'password' => '123456',
        //     'rol' => 'user'
        // ];

        //1. Consulta en SQL Simple
        //$this->db->query("INSERT INTO users (name, email, password, rol) VALUES(:name, :email, :password, :rol)", $data); //SQL

        //2. Usando el Query Builder
        // $this->db->table('users')->insert($data);

        //3. Usando el Modelo
        // $user = new User(); //nuevo objeto user
        // $user->insert($data); //insertar datos


        // Usando el Modelo
        $user = new User();
        for($x=0; $x<1000; $x++){
            $user->insert([
                'name' => "user{$x}",
                'email' => "user{$x}@gmail.com",
                'password' => '123456',
                'rol' => 'user'
            ]); 
        }
    }
}
