<?php

use Illuminate\Support\Facades\Route;
use app\http\controllers\database;
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

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.manage.users');
    Route::get('/subjects', [App\Http\Controllers\AdminController::class, 'subjects'])->name('admin.manage.subjects');
    Route::get('/teacher-subject', [App\Http\Controllers\AdminController::class, 'teacherSubjectAssignUnassign'])->name('admin.subject.teacher.assign.un.assign');
    Route::get('/student-subject', [App\Http\Controllers\AdminController::class, 'studentSubjectAssignUnassign'])->name('admin.subject.student.assign.un.assign');


    Route::post('/user/create', [App\Http\Controllers\UserController::class, 'store'])->name('create-user');
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update-user');
    Route::post('/admin/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delete-user');

    Route::post('/subject/create', [App\Http\Controllers\SubjectController::class, 'store'])->name('create-subject');
    Route::post('/subject/update/{id}', [App\Http\Controllers\SubjectController::class, 'update'])->name('update-subject');
    Route::post('/subject/delete/{id}', [App\Http\Controllers\SubjectController::class, 'destroy'])->name('delete-subject');


    Route::get('/is-attached/{userId}/{subjectId}', function ($userId, $subjectId){
        $attached = DB::table('subject_user')
                ->whereUserId($userId)
                ->whereSubjectId($subjectId)
                ->count();
        if ($attached > 0){
            return 'assigned';
        }
         return 'un-assigned';
    });

    Route::get('/attach/{userId}/{subjectId}', function ($userId, $subjectId){
        $teacher = \App\Models\User::find($userId);
        $teacher->subjects()->attach($subjectId);
        return true;
    });

    Route::get('/detach/{userId}/{subjectId}', function ($userId, $subjectId){
        $teacher = \App\Models\User::find($userId);
        $teacher->subjects()->detach($subjectId);
        return true;
    });

});

Route::middleware(['auth', 'teacher'])->prefix('teacher')->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/{subjectId}/questions', [App\Http\Controllers\QuestionController::class, 'getBySubjectId'])->name('teacher.questions');
    Route::post('/{subjectId}/question/create', [App\Http\Controllers\QuestionController::class, 'store'])->name('question.create');
    Route::post('/{subjectId}/question/update/{questionId}', [App\Http\Controllers\QuestionController::class, 'update'])->name('question.update');
    Route::post('/{subjectId}/question/delete/{questionId}', [App\Http\Controllers\QuestionController::class, 'destroy'])->name('question.delete');
//    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.manage.users');
//    Route::get('/subjects', [App\Http\Controllers\AdminController::class, 'subjects'])->name('admin.manage.subjects');
//    Route::get('/teacher-subject', [App\Http\Controllers\AdminController::class, 'teacherSubjectAssignUnassign'])->name('admin.subject.teacher.assign.un.assign');
//    Route::get('/student-subject', [App\Http\Controllers\AdminController::class, 'studentSubjectAssignUnassign'])->name('admin.subject.student.assign.un.assign');

});



Auth::routes();
