@extends('layouts.dashboard')

@section('dashboard-content')
    <div class="py-4">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserModal">
            Create User
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="create-user-form" method="post" action="{{ route('create-user') }}">

                            @csrf

                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text"  name="name"  id="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="label">User Email</label>
                                <input type="email"  name="email"  id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="label">User Password</label>
                                <input type="text"  name="password"  id="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="label">User Role</label>
                                <select name="role" id="role" class="form-control custom-select">
                                    <option value="admin">Admin</option>
                                    <option value="teacher">Teacher</option>
                                    <option value="student">Student</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="$('#create-user-form').submit()">Save changes</button>
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
                EMAIL
            </td>
            <td>
                ROLE
            </td>
            <td>
                ACTIONS
            </td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    {{ $loop->iteration }}
                </td>
                <td>
                    {{ $user->name }}
                </td>
                <td>
                    {{ $user->email }}
                </td>
                <td>
                    {{ $user->role }}
                </td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#editUserModal{{ $user->id }}">
                        Edit
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModal{{ $user->id }}Label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModal{{ $user->id }}Label">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="edit-user-form-{{ $user->id }}" method="post" action="{{ route('update-user', [$user->id]) }}">

                                        @csrf

                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <input type="text"  name="name"  id="name" value="{{ $user->name }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="label">User Email</label>
                                            <input type="email"  name="email"  id="email" value="{{ $user->email }}" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="label">User Password</label>
                                            <input type="text"  name="password"  id="password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="label">User Role</label>
                                            <select name="role" id="role" class="form-control custom-select">
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : ''}}>Teacher</option>
                                                <option value="student" {{ $user->role == 'student' ? 'selected' : ''}}>Student</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" onclick="$('#edit-user-form-{{ $user->id }}').submit()">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="d-none" id="delete-user-form-{{ $user->id }}" method="post" action="{{ route('delete-user', [$user->id]) }}">
                        @csrf
                    </form>

                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="confirm('Beware! This will delete user [{{ $user->name }}] and all the related data as well. Do you realy want to perform this action.')
                        ? $('#delete-user-form-{{ $user->id }}').submit() : ''">
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
