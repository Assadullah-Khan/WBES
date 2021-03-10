<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view("admin.dashboard");
    }

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
        return view("admin.layouts.teacher-subject-assign-un-assign")
            ->with('teachers', $teachers)
            ->with('subjects', $subjects);
    }
}
