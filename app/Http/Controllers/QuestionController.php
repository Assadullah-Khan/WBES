<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        return view("questions.index")->with("questions", $questions);
    }

    public function getBySubjectId($subjectId)
    {
        $questions = Question::where('subject_id', $subjectId)->get();
        return view("teacher.questions")
            ->with('subjectId', $subjectId)
            ->with("questions", $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("questions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($subjectId, Request $request)
    {
        $question = new Question();
        $question->subject_id = $subjectId;
        $question->type = $request->type;
        $question->description = $request->description;

        if ($question->type == 'mcq'){
            $options = [];
            if(isset($request->option1) && $request->option1 != ''){
                $options['option1'] = $request->option1;
            }
            if(isset($request->option1) && $request->option2 != ''){
                $options['option2'] = $request->option2;
            }
            if(isset($request->option1) && $request->option3 != ''){
                $options['option3'] = $request->option3;
            }
            if(isset($request->option1) && $request->option4 != ''){
                $options['option4'] = $request->option4;
            }

            $question->options = json_encode($options);
        }

        $question->answer = $request->answer;

        $question->marks = $request->marks;

        $question->save();

        return redirect()->route('teacher.questions', [$subjectId]);
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
    public function update($subjectId, $questionId, Request $request)
    {
        $question = Question::find($questionId);
        $question->subject_id = $subjectId;
        $question->type = $request->type;
        $question->description = $request->description;

        if ($question->type == 'mcq'){
            $options = [];
            if(isset($request->option1) && $request->option1 != ''){
                $options['option1'] = $request->option1;
            }
            if(isset($request->option1) && $request->option2 != ''){
                $options['option2'] = $request->option2;
            }
            if(isset($request->option1) && $request->option3 != ''){
                $options['option3'] = $request->option3;
            }
            if(isset($request->option1) && $request->option4 != ''){
                $options['option4'] = $request->option4;
            }

            $question->options = json_encode($options);
        }

        $question->answer = $request->answer;

        $question->marks = $request->marks;

        $question->save();

        return redirect()->route('teacher.questions', [$subjectId]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subjectId, $questionId)
    {
        $question = Question::where('id', $questionId)->first();
        $question->delete();
        return redirect()->route('teacher.questions', [$subjectId]);
    }
}
