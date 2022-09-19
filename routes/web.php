<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('view:cache');
    Artisan::call('route:clear');

    return "Cache cleared!";
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'loadRegister']);
Route::post('/register', [AuthController::class, 'studentRegister'])->name('studentRegister');

Route::get('/login', function () {
    return redirect('/');
});

Route::get('/', [AuthController::class, 'loadLogin']);
Route::post('/login', [AuthController::class, 'userLogin'])->name('userLogin');

Route::get('/logout', [AuthController::class, 'logout']);


Route::group(['middleware' => ['web', 'checkAdmin']], function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);

    //Subject Route
    Route::post('/add-subject', [AdminController::class, 'addSubject'])->name('addSubject');
    Route::put('/edit-subject', [AdminController::class, 'editSubject'])->name('editSubject');
    Route::delete('/delete-subject', [AdminController::class, 'deleteSubject'])->name('deleteSubject');

    //Exam Route
    Route::get('/admin/exam', [AdminController::class, 'examDashboard']);
    Route::post('/admin/exam', [AdminController::class, 'addExam'])->name('addExam');
    Route::get('/get-exam-details/{id}', [AdminController::class, 'getExamDetails'])->name('getExamDetails');
    Route::put('/update-exam', [AdminController::class, 'updateExam'])->name('updateExam');
    Route::delete('/delete-exam', [AdminController::class, 'deleteExam'])->name('deleteExam');

    //Q&A Routes
    Route::get('/admin/qna-ans', [AdminController::class, 'qnaDashboard'])->name('qnaDashboard');
    Route::post('/add-qna-ans', [AdminController::class, 'addQna'])->name('addQna');
    Route::get('/get-qna-details', [AdminController::class, 'getQnaDetails'])->name('getQnaDetails');
    Route::get('/delete-ans', [AdminController::class, 'deleteAns'])->name('deleteAns');
    Route::post('/update-qna-ans', [AdminController::class, 'updateQna'])->name('updateQna');
    Route::delete('/delete-qna', [AdminController::class, 'deleteQna'])->name('deleteQna');

    //Import Q&A
    Route::post('/import-qna-ans', [AdminController::class, 'importQna'])->name('importQna');

    //Student Routes
    Route::get('/admin/students', [AdminController::class, 'studentsDashboard']);
    Route::post('/add-student', [AdminController::class, 'addStudent'])->name('addStudent');
    Route::put('/edit-student', [AdminController::class, 'editStudent'])->name('editStudent');
    Route::delete('/delete-student', [AdminController::class, 'deleteStudent'])->name('deleteStudent');

    //QNA Exam Routing
    Route::get('/get-questions', [AdminController::class, 'getQuestions'])->name('getQuestions');
});


Route::group(['middleware' => ['web', 'checkStudent']], function () {
    Route::get('/dashboard', [AuthController::class, 'loadDashboard']);
});
