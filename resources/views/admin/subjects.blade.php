@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="py-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSubjectModal">
            Create Subject
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createSubjectModal" tabindex="-1" aria-labelledby="createSubjectModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSubjectModalLabel">Create Subject</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="create-subject-form" method="post" action="{{ route('create-subject') }}">

                            @csrf

                            <div class="form-group">
                                <label for="name">Subject Name</label>
                                <input type="text"  name="name"  id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="label">Subject Label</label>
                                <input type="text"  name="label"  id="label" class="form-control" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="$('#create-subject-form').submit()">Save changes</button>
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
                NAME
            </td>
            <td>
                LABEL
            </td>
            <td>
                ACTIONS
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($subjects as $subject)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $subject->name }}
                </td>
                <td>
                    {{ $subject->label }}
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editSubjectModal{{ $subject->id }}">
                        Edit
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" aria-labelledby="editSubjectModal{{ $subject->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editSubjectModal{{ $subject->id }}Label">Edit Subject</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-subject-form-{{ $subject->id }}" method="post" action="{{ route('update-subject', [$subject->id]) }}">

                                        @csrf

                                        <div class="form-group">
                                            <label for="name">Subject Name</label>
                                            <input type="text"  name="name"  id="name" value="{{ $subject->name }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="label">Subject Label</label>
                                            <input type="text"  name="label"  id="label" value="{{ $subject->label }}" class="form-control" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#edit-subject-form-{{ $subject->id }}').submit()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="d-none" id="delete-subject-form-{{ $subject->id }}" method="post" action="{{ route('delete-subject', [$subject->id]) }}">
                        @csrf
                    </form>

                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="confirm('Beware! This will delete subject [{{ $subject->name }}] and all the related data as well. Do you realy want to perform this action.')
	                ? $('#delete-subject-form-{{ $subject->id }}').submit() : ''">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
