<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\StudentAnswer;

class HomeController extends BaseController
{
    public function index(): string
    {
        $user = new User();
        $subject = new Subject();
        $studentAnswer = new StudentAnswer();

        
        $isAdmin = session('rol') === 'admin';

        $data = [
            'title' => 'Inicio',
            'isAdmin' => $isAdmin,
            'totalStudent' => $isAdmin ? $user->where('rol', 'student')->countAllResults() : 0,
            'totalSubjects' => $isAdmin ? $subject->countAllResults() : 0,
            'totalAnswers' => $isAdmin
                ? $studentAnswer
                    ->select('student_answers.user_id, student_answers.question_id')
                    ->join('questions', 'questions.id = student_answers.question_id')
                    ->groupBy('student_answers.user_id, student_answers.question_id')
                    ->countAllResults(false)
                : 0,
        ];

        return view('home', $data);
    }
}
