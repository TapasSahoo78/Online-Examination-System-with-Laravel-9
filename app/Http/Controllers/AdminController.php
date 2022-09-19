<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\QnaExam;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\QnaImport;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function addSubject(Request $request)
    {
        try {
            Subject::insert([
                'subject' => $request->subject
            ]);
            return response()->json(['success' => true, 'msg' => 'Subject added Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function editSubject(Request $request)
    {
        try {
            $subject = Subject::find($request->id);
            $subject->subject = $request->subject;
            $subject->save();
            return response()->json(['success' => true, 'msg' => 'Subject updated Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function deleteSubject(Request $request)
    {
        try {
            Subject::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Subject deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    //Exam Dashboard Load
    public function examDashboard()
    {
        $subjects = Subject::all();
        $exams = Exam::with('subjects')->get();
        return view('admin.exam-dashboard', ['subjects' => $subjects, 'exams' => $exams]);
    }

    public function addExam(Request $request)
    {
        try {
            Exam::insert([
                'exam_name' => $request->exam_name,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $request->time,
                'attempt' => $request->attempt

            ]);
            return response()->json(['success' => true, 'msg' => 'Exam added Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function getExamDetails($id)
    {
        try {
            $exam = Exam::where('id', $id)->get();
            return response()->json(['success' => true, 'data' => $exam]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function updateExam(Request $request)
    {
        try {
            $exam = Exam::find($request->exam_id);
            $exam->exam_name = $request->exam_name;
            $exam->subject_id = $request->subject_id;
            $exam->date = $request->date;
            $exam->time = $request->time;
            $exam->attempt = $request->attempt;
            $exam->save();
            return response()->json(['success' => true, 'msg' => 'Exam updated Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function deleteExam(Request $request)
    {
        try {
            Exam::find($request->exam_id)->delete();
            return response()->json(['success' => true, 'msg' => 'Exam deleted Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function qnaDashboard()
    {
        $questions = Question::with('answers')->get();
        return view('admin.qnaDashboard', compact('questions'));
    }

    public function addQna(Request $request)
    {
        try {
            $questionId = Question::insertGetId([
                'question' => $request->question
            ]);

            foreach ($request->answers as $answer) {
                $is_correct = 0;
                if ($request->is_correct == $answer) {
                    $is_correct = 1;
                }
                Answer::insert([
                    'questions_id' => $questionId,
                    'answers' => $answer,
                    'is_correct' => $is_correct
                ]);
            }

            return response()->json(['success' => true, 'msg' => 'Q&A Added Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function getQnaDetails(Request $request)
    {
        $qna = Question::where('id', $request->qid)->with('answers')->get();
        return response()->json(['data' => $qna]);
    }

    public function deleteAns(Request $request)
    {
        Answer::where('id', $request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Answer Deleted Successfully']);
    }

    public function updateQna(Request $request)
    {
        try {
            Question::where('id', $request->question_id)->update([
                'question' => $request->question
            ]);
            //Old Answers Update
            if (isset($request->answers)) {
                foreach ($request->answers as $key => $value) {
                    $is_correct = 0;
                    if ($request->is_correct == $value) {
                        $is_correct = 1;
                    }
                    Answer::where('id', $key)->update([
                        'questions_id' => $request->question_id,
                        'answers' => $value,
                        'is_correct' => $is_correct
                    ]);
                }
            }

            //New Answers Added
            if (isset($request->new_answers)) {
                foreach ($request->new_answers as $answer) {
                    $is_correct = 0;
                    if ($request->is_correct == $answer) {
                        $is_correct = 1;
                    }
                    Answer::insert([
                        'questions_id' => $request->question_id,
                        'answers' => $answer,
                        'is_correct' => $is_correct
                    ]);
                }
            }

            return response()->json(['success' => true, 'msg' => 'Q&A Updated Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'msg' => $th->getMessage()]);
        }
    }

    public function deleteQna(Request $request)
    {
        Question::where('id', $request->qna_id)->delete();
        Answer::where('questions_id', $request->qna_id)->delete();
        return response()->json(['success' => true, 'msg' => 'Q&A Deleted Successfully']);
    }

    public function importQna(Request $request)
    {
        try {
            Excel::import(new QnaImport, $request->file('file'));
            return response()->json(['success' => true, 'msg' => 'Q&A Uploaded Successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    /*************************** Student Dashboard ****************************/
    public function studentsDashboard()
    {
        $students = User::where('is_admin', 0)->get();
        return view('admin.studentsDashboard', compact('students'));
    }

    public function addStudent(Request $request)
    {
        try {
            $password = Str::random(8);
            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password)
            ]);

            $url = URL::to('/');
            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = $password;
            $data['title'] = 'Student Registration on OES';

            Mail::send('registrationMail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return response()->json(['success' => true, 'msg' => 'Student Added Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function editStudent(Request $request)
    {
        try {
            $user = User::find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $url = URL::to('/');
            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['title'] = 'Updated Student Profile on OES';

            Mail::send('updateProfileMail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });
            return response()->json(['success' => true, 'msg' => 'Student Updated Successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function deleteStudent(Request $request)
    {
        User::where('id', $request->std_id)->delete();
        return response()->json(['success' => true, 'msg' => 'Student Deleted Successfully']);
    }

    /*************************** Questions Assign Section ****************************/

    public function getQuestions(Request $request)
    {
        try {
            $questions = Question::all();
            if (count($questions) > 0) {
                $data = [];
                $counter = 0;
                foreach ($questions as $question) {
                    $qnaExam = QnaExam::where(['exam_id' => $request->exam_id, 'question_id' => $question->id])->get();
                    if (count($qnaExam) == 0) {
                        $data[$counter]['id'] = $question->id;
                        $data[$counter]['question'] = $question->question;
                        $counter++;
                    }
                }
                return response()->json(['success' => true, 'msg' => 'Questions Data!', 'data' => $data]);
            } else {
                return response()->json(['success' => true, 'msg' => 'Questions not found!']);
            }
        } catch (\Throwable $th) {
        }
    }
}
