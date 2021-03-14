<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users()
    {
        $users = User::all();
        return view("admin.users")->with('users', $users);
    }

    public function subjects()
    {
        $subjects = Subject::all();
        return view("admin.subjects")->with('subjects', $subjects);
    }

    public function teacherSubjectAssignUnassign()
    {
        $teachers = User::where('role', 'teacher')->get();
        $subjects = Subject::all();
        return view("admin.teacher-subject-assign-un-assign")
            ->with('teachers', $teachers)
            ->with('subjects', $subjects);
    }

    public function studentSubjectAssignUnassign()
    {
        $students = User::where('role', 'student')->get();
        $subjects = Subject::all();
        return view("admin.student-subject-assign-un-assign")
            ->with('students', $students)
            ->with('subjects', $subjects);
    }
}
