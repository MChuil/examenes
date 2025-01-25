<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDatesToQuestion extends Migration
{
    public function up()
    {
        $this->forge->addColumn('questions', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('questions', 'created_at');
        $this->forge->dropColumn('questions', 'updated_at');
        $this->forge->dropColumn('questions', 'deleted_at');
    }
}
