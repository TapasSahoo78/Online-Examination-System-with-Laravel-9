<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\QnaExam;
use App\Models\ExamAttempt;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function paidExamDashboard()
    {
        $exams = Exam::where('plan', 0)->with('subjects')->orderBy('date', 'DESC')->get();
        //die($exams);
        return view('student.paid_exams', compact('exams'));
    }
}
