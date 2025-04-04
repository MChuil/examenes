<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateUserRolesToStudent extends Migration
{
    public function up()
    {
        //user a student
        $this->db->query("UPDATE users SET rol = 'student' WHERE rol = 'user'");
    }

    public function down()
    {
        //vovler de student a user
        $this->db->query("UPDATE users SET rol = 'user' WHERE rol = 'student'");
    }
}
