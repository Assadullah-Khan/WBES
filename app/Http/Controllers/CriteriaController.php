<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
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
        $criteria = Criteria::where('subject_id', $subjectId)->first();
        return view("teacher.criteria")
            ->with('subjectId', $subjectId)
            ->with("criteria", $criteria);
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
    public function store($subjectId, Request $request)
    {
        $criteria = new Criteria;
        $criteria->subject_id = $subjectId;
        $criteria->number_of_mcqs = $request->number_of_mcqs;
        $criteria->number_of_3_marks_questions = $request->number_of_3_marks_questions;
        $criteria->number_of_5_marks_questions = $request->number_of_5_marks_questions;
        $criteria->start_date = $request->start_date;
        $criteria->start_time = $request->start_time;
        $criteria->max_duration = $request->max_duration;
        $criteria->pass_percentage = $request->pass_percentage;

        $criteria->save();

        return  redirect()->route('teacher.criteria', [$subjectId]);
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
    public function update($subjectId, $criteriaId, Request $request)
    {
        $criteria = Criteria::where('id', $criteriaId)->first();
        $criteria->subject_id = $subjectId;
        $criteria->number_of_mcqs = $request->number_of_mcqs;
        $criteria->number_of_3_marks_questions = $request->number_of_3_marks_questions;
        $criteria->number_of_5_marks_questions = $request->number_of_5_marks_questions;
        $criteria->start_date = $request->start_date;
        $criteria->start_time = $request->start_time;
        $criteria->max_duration = $request->max_duration;
        $criteria->pass_percentage = $request->pass_percentage;

        $criteria->save();

        return  redirect()->route('teacher.criteria', [$subjectId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subjectId, $criteriaId)
    {
        $criteria = Criteria::where('id', $criteriaId);

        $criteria->delete();

        return  redirect()->route('teacher.criteria', [$subjectId]);
    }
}
