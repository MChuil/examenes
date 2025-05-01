<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentAnswer extends Model
{
    protected $table            = 'student_answers';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;

    protected $allowedFields = [
        'user_id',
        'subject_id',
        'question_id',
        'choice_id',
        'is_correct',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
}
