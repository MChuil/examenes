<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateStudentAnswersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'user_id'       => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'subject_id'    => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'question_id'   => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'choice_id'     => [
                'type'     => 'INT',
                'unsigned' => true
            ],
            'is_correct'    => [
                'type'       => 'BOOLEAN',
                'default'    => false
            ],
            'created_at'    => [
                'type'       => 'DATETIME',
                'null'       => false
            ],
            'updated_at'    => [
                'type'       => 'DATETIME',
                'null'       => true
            ],
            'deleted_at'    => [
                'type'       => 'DATETIME',
                'null'       => true
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('student_answers');
    }

    public function down()
    {
        $this->forge->dropTable('student_answers');
    }
}
