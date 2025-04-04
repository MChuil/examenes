<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterRolFieldToStudent extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', [
            'rol' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'student'],
                'default'    => 'student',
                'null'       => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('users', [
            'rol' => [
                'type'       => 'ENUM',
                'constraint' => ['admin', 'user'],
                'default'    => 'user',
                'null'       => false,
            ],
        ]);
    }
}
