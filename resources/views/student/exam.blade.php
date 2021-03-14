@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="py-4">
        <a class="btn btn-primary {{ $criteria->start_date != date('Y-m-d') || (\Carbon\Carbon::now()->timestamp < \Carbon\Carbon::parse($criteria->start_time)->timestamp-17950 || \Carbon\Carbon::now()->timestamp > \Carbon\Carbon::parse($criteria->start_time)->timestamp-17950+900) ? 'disabled' : '' }}">
            Start Exam
        </a>
        <br>
        @if(\Carbon\Carbon::parse($criteria->start_time)->timestamp-17950+900)
            <sm class="text-danger">
                <small>
                    Oops! Exam expired
                </small>
            </sm>
        @endif
        <sm>
            <ul>
                <li>
                    You can start exam only at specified date, time.
                </li>
                <li>
                    Also, you will not be able to start exam after 15 mins from start time.
                </li>
                <li>
                    Reload/Refresh page to start exam, while meeting the above two criterias.
                </li>
            </ul>
        </sm>
    </div>

    @if(!$criteria)
        <p>
            The exam is not scheduled yet.
        </p>
    @endif

    @if($criteria)
        <div class="mt-4">
            <h4>
                Exam Details
            </h4>
            <hr>
            <form>
                <div class="form-group">
                    <label for="number_of_mcqs">Number of MCQs</label>
                    <input type="number" name="number_of_mcqs" id="number_of_mcqs" value="{{ $criteria->number_of_mcqs }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="number_of_3_marks_questions">Number of 3 Marks Questions</label>
                    <input type="number" name="number_of_3_marks_questions" id="number_of_3_marks_questions" value="{{ $criteria->number_of_3_marks_questions }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="number_of_5_marks_questions">Number of 5 Marks Questions</label>
                    <input type="number" name="number_of_5_marks_questions" id="number_of_5_marks_questions" value="{{ $criteria->number_of_5_marks_questions }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $criteria->start_date }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="start_time">Start Time</label>
                    <input type="time" name="start_time" id="start_time" value="{{ $criteria->start_time}}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="max_duration">Max Duration (In Minutes)</label>
                    <input type="number" name="max_duration" id="max_duration" value="{{ $criteria->max_duration }}" class="form-control" disabled>
                </div>

                <div class="form-group">
                    <label for="pass_percentage">Pass Percentage</label>
                    <input type="number" name="pass_percentage" id="pass_percentage" value="{{ $criteria->pass_percentage }}" class="form-control" disabled>
                </div>
            </form>
        </div>
    @endif

@endsection
