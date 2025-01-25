<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Choice extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'question_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'is_correct' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'unsigned'       => true,
            ],
            'choice_text' => [
                'type'       => 'TEXT'
            ]

        ]);
        $this->forge->addKey('id', true); // primary key
        $this->forge->addForeignKey('question_id', 'questions', 'id'); // foreign key
        $this->forge->createTable('choices');
    }

    public function down()
    {
        $this->forge->dropTable('choices');
    }
}
