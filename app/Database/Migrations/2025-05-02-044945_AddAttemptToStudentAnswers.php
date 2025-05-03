<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAttemptToStudentAnswers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('student_answers', [
            'attempt' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 1,
                'after'      => 'user_id'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('student_answers', 'attempt');
    }
}
