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
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.manage.users');
    Route::get('/admin/subjects', [App\Http\Controllers\AdminController::class, 'subjects'])->name('admin.manage.subjects');
    Route::get('/admin/teacher-subject', [App\Http\Controllers\AdminController::class, 'teacherSubjectAssignUnassign'])->name('admin.subject.teacher.assign.un.assign');


    Route::post('/admin/user/create', [App\Http\Controllers\UserController::class, 'store'])->name('create-user');
    Route::post('/admin/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('update-user');
    Route::post('/admin/user/delete/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('delete-user');

    Route::post('/admin/subject/create', [App\Http\Controllers\SubjectController::class, 'store'])->name('create-subject');
    Route::post('/admin/subject/update/{id}', [App\Http\Controllers\SubjectController::class, 'update'])->name('update-subject');
    Route::post('/admin/subject/delete/{id}', [App\Http\Controllers\SubjectController::class, 'destroy'])->name('delete-subject');


    Route::get('/admin/is-attached/{teacherId}/{subjectId}', function ($teacherId, $subjectId){
        $attached = DB::table('subject_user')
                ->whereUserId($teacherId)
                ->whereSubjectId($subjectId)
                ->count();
        if ($attached > 0){
            return 'assigned';
        }
         return 'un-assigned';
    });

    Route::get('/admin/attach/{teacherId}/{subjectId}', function ($teacherId, $subjectId){
        $teacher = \App\Models\User::find($teacherId);
        $teacher->subjects()->attach($subjectId);
        return true;
    });

    Route::get('/admin/detach/{teacherId}/{subjectId}', function ($teacherId, $subjectId){
        $teacher = \App\Models\User::find($teacherId);
        $teacher->subjects()->detach($subjectId);
        return true;
    });

});



Auth::routes();
