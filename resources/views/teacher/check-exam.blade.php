@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="py-4">

    </div>
    <table class="table table-bordered">
        <thead class="font-weight-bold">
        <tr>
            <td>
                ID
            </td>
            <td>
                NAME
            </td>
            <td>
                TOTAL MARKS
            </td>
            <td>
                OBTAINED MARKS
            </td>
            <td>
                PASS/FAIL
            </td>
            <td>
                ACTIONS
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($subject->users()->where('role', 'student')->get() as $user)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $subject->exams()->first()->total_marks }}
                </td>
                <td>
                    <?php
                        $exam = $user->exams()->where('subject_id', $subject->id)->first();
                    ?>
                    {{ $exam->obtained_marks }}
                </td>
                <td>
                    @if($exam->obtained_marks)
                        @if($exam->is_pass)
                            <span class="text-success">
                                    Pass
                                </span>
                        @else
                            <span class="text-danger">
                                    Fail
                                </span>
                        @endif
                    @endif
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                        Check Exam
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModal{{ $user->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <form class="mt-5" id="exam-form" method="post" action="{{ route('teacher.submit-check-exam', [$subject->id, $exam->id]) }}">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editUserModal{{ $user->id }}Label">Check Exam</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            @csrf
                                            <ul class="list-group">
                                                @foreach($exam->questions as $question)
                                                    <li class="list-group-item">
                                                        <div class="text-right">
                                                            Marks = {{ $question->marks }}
                                                        </div>
                                                        {{ $loop->iteration }}.
                                                        {{ $question->description }}
                                                        @if($question->type == 'mcq')
                                                            @foreach(json_decode($question->options) as $option)
                                                                <div class="form-check ml-5">
                                                                    <input class="form-check-input" type="radio" {{ $question->pivot->answer == $option ? 'checked' : '' }} disabled>
                                                                    <label class="form-check-label" for="{{ $question->id }}+{{ $option }}">
                                                                        {{ $option }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                            <div class="text-right">
                                                                <input type="checkbox" name="marks[]" value="1" {{ $question->pivot->answer == $question->answer ? 'checked' : '' }}>
                                                                <label>Correct</label>
                                                            </div>
                                                        @elseif($question->type == 'descriptive')
                                                            <div class="ml-5 mt-2">
                                                                <textarea  rows="5" class="form-control">{{ $question->pivot->answer }}</textarea>
                                                            </div>
                                                            <div class="text-right mt-1">
                                                                <label>Obtained Marks</label>
                                                                <input type="number" name="marks[]" max="{{ $question->marks }}" required>
                                                            </div>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ul>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
