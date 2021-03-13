@extends('layouts.dashboard')

@section('dashboard-content')

    <div class="py-4">
        <h4>
            Assign/Un-assign Subject to/from a Student
        </h4>
        <form>
            <div class="form-group">
                <label for="label">Select Teacher</label>
                <select name="student" id="student" class="form-control custom-select" onchange="toggle()">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="label">Select Subject</label>
                <select name="subject" id="subject" class="form-control custom-select" onchange="toggle()">
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->label }}</option>
                    @endforeach
                </select>
            </div>

            <script>
                document.addEventListener("DOMContentLoaded", function(event) {
                    toggle();
                });

                function toggle(){
                    let studentId = $('#student').val();
                    let subjectId = $('#subject').val();
                    let attached = false;
                    axios.get('/admin/is-attached/'+studentId+'/'+subjectId)
                        .then(function (response) {
                            if (response.data == 'assigned'){
                                $('#assign').addClass('d-none');
                                $('#un-assign').removeClass('d-none');
                            }

                            if (response.data == 'un-assigned'){
                                $('#un-assign').addClass('d-none');
                                $('#assign').removeClass('d-none');
                            }
                        });
                }

                function attach(){
                    let studentId = $('#student').val();
                    let subjectId = $('#subject').val();
                    let attached = false;
                    axios.get('/admin/attach/'+studentId+'/'+subjectId)
                        .then(function (response) {
                            toggle();
                        });
                }

                function detach(){
                    let studentId = $('#student').val();
                    let subjectId = $('#subject').val();
                    let attached = false;
                    axios.get('/admin/detach/'+studentId+'/'+subjectId)
                        .then(function (response) {
                            toggle();
                        });
                }
            </script>

            <div class="form-group">
                <button id="assign" class="btn btn-primary" onclick="event.preventDefault();attach()">
                    Assign
                </button>
                <button id="un-assign" class="btn btn-danger" onclick="event.preventDefault();detach()">
                    Un-Assign
                </button>
            </div>
        </form>
    </div>

@endsection
