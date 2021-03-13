@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="py-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createQuestionModal">
            Create Question
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createQuestionModal" tabindex="-1" aria-labelledby="createQuestionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createQuestionModalLabel">Create Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="create-question-form" method="post" action="{{ route('question.create', [$subjectId]) }}">

                            @csrf

                            <div class="form-group">
                                <label for="type">Question Type</label>
                                <select name="type" id="type" class="type form-control custom-select" onchange="toggle()">
                                    <option value="mcq">MCQ</option>
                                    <option value="descriptive">Descriptive</option>
                                </select>
                            </div>

                            <script>
                                function toggle(){
                                    console.log("here");
                                    let type = $('#type').val();
                                    if (type == 'mcq'){
                                        $('.option').removeClass('d-none');
                                    }else{
                                        $('.option').addClass('d-none');
                                    }
                                }
                            </script>

                            <div class="form-group">
                                <label for="description">Question Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5" required>Question statement goes here..</textarea>
                            </div>
                            <div class="form-group option">
                                <label for="option1">Option 1</label>
                                <textarea name="option1" id="option1" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group option">
                                <label for="option2">Option 2</label>
                                <textarea name="option2" id="option2" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group option">
                                <label for="option3">Option 3</label>
                                <textarea name="option3" id="option3" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group option">
                                <label for="option4">Option 4</label>
                                <textarea name="option4" id="option4" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="answer">Correct Answer</label>
                                <textarea name="answer" id="answer" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="marks">Marks</label>
                                <select name="marks" id="marks" class="form-control custom-select">
                                    <option value="1">1</option>
                                    <option value="3">3</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="$('#create-question-form').submit()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <table class="table table-bordered">
        <thead class="font-weight-bold">
        <tr>
            <td>
                ID
            </td>
            <td>
                DESCRIPTION
            </td>
            <td>
                OPTIONS
            </td>
            <td>
                ANSWER
            </td>
            <td>
                MARKS
            </td>
            <td>
                ACTIONS
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $question->description }}
                </td>
                <td>
                    @if(isset($question->options) && $question->options != '')
                        <ul>
                            @foreach(json_decode($question->options) as $option)
                                <li>
                                    {{ $option }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    {{ $question->answer }}
                </td>
                <td>
                    {{ $question->marks }}
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-block btn-sm btn-outline-primary" data-toggle="modal" data-target="#editQuestionModal{{ $question->id }}">
                        Edit
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editQuestionModal{{ $question->id }}" tabindex="-1" aria-labelledby="editQuestionModal{{ $question->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editQuestionModal{{ $question->id }}Label">Edit Question</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-question-form-{{ $question->id }}" method="post" action="{{ route('question.update', [$subjectId, $question->id]) }}">

                                        @csrf

                                        <div class="form-group">
                                            <label for="type">Question Type</label>
                                            <select name="type" id="type" class="type form-control custom-select" onchange="toggle()">
                                                <option value="mcq" {{ $question->type == 'mcq' ? 'selected' : '' }}>MCQ</option>
                                                <option value="descriptive" {{ $question->type == 'descriptive' ? 'selected' : '' }}>Descriptive</option>
                                            </select>
                                        </div>

                                        <script>
                                            function toggle(){
                                                let type = $('.type').val();
                                                if (type == 'mcq'){
                                                    $('.option').removeClass('d-none');
                                                }else{
                                                    $('.option').addClass('d-none');
                                                }
                                            }
                                        </script>

                                        <div class="form-group">
                                            <label for="description">Question Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="5" required>{{ $question->description }}</textarea>
                                        </div>
                                        @if(isset($question->options) && $question->options != '')
                                            @foreach(json_decode($question->options) as $option)
                                                <div class="form-group option {{ $question->type == 'descriptive' ? 'd-none' : '' }}">
                                                    <label for="option{{ $loop->iteration }}">Option {{ $loop->iteration }}</label>
                                                    <textarea name="option{{ $loop->iteration }}" id="option{{ $loop->iteration }}" class="form-control" rows="2" required>{{ $option }}</textarea>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="form-group">
                                            <label for="answer">Correct Answer</label>
                                            <textarea name="answer" id="answer" class="form-control" rows="2" required>{{ $question->answer }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="marks">Marks</label>
                                            <select name="marks" id="marks" class="form-control custom-select">
                                                <option value="1" {{ $question->marks == '1' ? 'selected' : '' }}>1</option>
                                                <option value="3" {{ $question->marks == '3' ? 'selected' : '' }}>3</option>
                                                <option value="5" {{ $question->marks == '5' ? 'selected' : '' }}>5</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#edit-question-form-{{ $question->id }}').submit()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="d-none" id="delete-question-form-{{ $question->id }}" method="post" action="{{ route('question.delete', [$subjectId, $question->id]) }}">
                        @csrf
                    </form>

                    <button type="button" class="btn btn-block btn-sm btn-outline-primary" onclick="confirm('Beware! This will delete question [{{ $question->name }}] and all the related data as well. Do you realy want to perform this action.')
                        ? $('#delete-question-form-{{ $question->id }}').submit() : ''">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
