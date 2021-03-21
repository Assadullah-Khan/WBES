<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getBySubjectId($subjectId)
    {
        $exam = Exam::where('user_id', auth()->user()->id)
            ->where('subject_id', $subjectId)->first();
        $criteria = Criteria::where('subject_id', $subjectId)->first();
        return view("student.exam")
            ->with('subjectId', $subjectId)
            ->with("criteria", $criteria)
            ->with('exam', $exam);
    }

    public function startExam($subjectId)
    {
        $criteria = Criteria::where('subject_id', $subjectId)->first();
        $questions = Question::where('type', 'mcq')->take($criteria->number_of_mcqs)->get()
        ->concat(
            Question::Where('marks', 3)->take($criteria->number_of_3_marks_questions)->get()
        )->concat(
            Question::Where('marks', 5)->take($criteria->number_of_5_marks_questions)->get()
            );
        return view("student.start-exam")
            ->with('subjectId', $subjectId)
            ->with("criteria", $criteria)
            ->with("questions", $questions);
    }

    public function submitExam($subjectId, $criteriaId, Request $request)
    {
        $data = $request->except('_token');

        $exam = Exam::where('user_id', auth()->user()->id)
            ->where('subject_id', $subjectId)->first();

        if(!$exam) {
            $exam = new Exam;
            $exam->user_id = auth()->user()->id;
            $exam->subject_id = $subjectId;
            $exam->criteria_id = $criteriaId;

            $criteria = Criteria::find($criteriaId);
            $total_marks = 1*$criteria->number_of_mcqs + 3*$criteria->number_of_3_marks_questions + 5*$criteria->number_of_5_marks_questions;

            $exam->total_marks = $total_marks;

            $exam->save();

            foreach($data as $questionId => $answer){
                $exam->questions()->attach($questionId, ['answer' => $answer?$answer:'']);
                $exam->save();
            }
        }

        return redirect()->route('dashboard', [auth()->user()->role]);
    }

    public function checkExam($subjectId, $examId, Request $request){
        $exam = Exam::find($examId);

        $obtained_marks = array_sum($request->marks);

        $exam->obtained_marks = $obtained_marks;

        $pass_percentage = $exam->criteria->pass_percentage;

        $percentage = ($exam->obtained_marks/$exam->total_marks)*100;

        $percentage >= $pass_percentage ? $exam->is_pass = true : '';

        $exam->save();

        return redirect()->route('teacher.check-exam', [$subjectId]);
    }

    public function getResult($subjectId){
        $exam = Exam::where('user_id', auth()->user()->id)
            ->where('subject_id', $subjectId)
            ->first();

        return view('student.result')
            ->with('subjectId', $subjectId)
            ->with('exam', $exam);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
