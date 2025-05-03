<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterStudentAnswersAddForeignKeys extends Migration
{
    public function up()
    {
        // Eliminar subject
        if ($this->db->fieldExists('subject_id', 'student_answers')) {
            $this->forge->dropColumn('student_answers', 'subject_id');
        }

        // fk
        $this->db->query("
            ALTER TABLE student_answers
            ADD CONSTRAINT fk_student_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
            ADD CONSTRAINT fk_student_question FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE,
            ADD CONSTRAINT fk_student_choice FOREIGN KEY (choice_id) REFERENCES choices(id) ON DELETE CASCADE
        ");
    }

    public function down()
    {
        $this->db->query("
            ALTER TABLE student_answers
            DROP FOREIGN KEY fk_student_user,
            DROP FOREIGN KEY fk_student_question,
            DROP FOREIGN KEY fk_student_choice
        ");

        
        $this->forge->addColumn('student_answers', [
            'subject_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
                'after' => 'user_id'
            ]
        ]);
    }
}
