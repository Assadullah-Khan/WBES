@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="py-4">
        @if(!$criteria)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createCriteriaModal">
                Create Criteria
            </button>

            <!-- Modal -->
            <div class="modal fade" id="createCriteriaModal" tabindex="-1" aria-labelledby="createCriteriaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createCriteriaModalLabel">Create Criteria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="create-criteria-form" method="post" action="{{ route('criteria.create', [$subjectId]) }}">

                                @csrf

                                <div class="form-group">
                                    <label for="number_of_mcqs">Number of MCQs</label>
                                    <input type="number" name="number_of_mcqs" id="number_of_mcqs" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="number_of_3_marks_questions">Number of 3 Marks Questions</label>
                                    <input type="number" name="number_of_3_marks_questions" id="number_of_3_marks_questions" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="number_of_5_marks_questions">Number of 5 Marks Questions</label>
                                    <input type="number" name="number_of_5_marks_questions" id="number_of_5_marks_questions" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="max_duration">Max Duration (In Minutes)</label>
                                    <input type="number" name="max_duration" id="max_duration" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="pass_percentage">Pass Percentage</label>
                                    <input type="number" name="pass_percentage" id="pass_percentage" class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="$('#create-criteria-form').submit()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($criteria)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editCriteriaModal">
                Edit Criteria
            </button>

            <form class="d-none" id="delete-criteria-form-{{ $criteria->id }}" method="post" action="{{ route('criteria.delete', [$subjectId, $criteria->id]) }}">
                @csrf
            </form>
            <button type="button" class="btn btn-danger" onclick="confirm('Caution! Do you really want to perform this action.')
                ? $('#delete-criteria-form-{{ $criteria->id }}').submit() : ''">
                Delete Criteria
            </button>

            <div class="mt-4">
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

                <!-- Modal -->
            <div class="modal fade" id="editCriteriaModal" tabindex="-1" aria-labelledby="editCriteriaModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCriteriaModalLabel">Edit Criteria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="edit-criteria-form" method="post" action="{{ route('criteria.update', [$subjectId, $criteria->id]) }}">

                                @csrf

                                <div class="form-group">
                                    <label for="number_of_mcqs">Number of MCQs</label>
                                    <input type="number" name="number_of_mcqs" id="number_of_mcqs" value="{{ $criteria->number_of_mcqs }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="number_of_3_marks_questions">Number of 3 Marks Questions</label>
                                    <input type="number" name="number_of_3_marks_questions" id="number_of_3_marks_questions" value="{{ $criteria->number_of_3_marks_questions }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="number_of_5_marks_questions">Number of 5 Marks Questions</label>
                                    <input type="number" name="number_of_5_marks_questions" id="number_of_5_marks_questions" value="{{ $criteria->number_of_5_marks_questions }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" value="{{ $criteria->start_date }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="start_time">Start Time</label>
                                    <input type="time" name="start_time" id="start_time" value="{{ $criteria->start_time}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="max_duration">Max Duration (In Minutes)</label>
                                    <input type="number" name="max_duration" id="max_duration" value="{{ $criteria->max_duration }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="pass_percentage">Pass Percentage</label>
                                    <input type="number" name="pass_percentage" id="pass_percentage" value="{{ $criteria->pass_percentage }}" class="form-control">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="$('#edit-criteria-form').submit()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
