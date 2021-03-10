@extends("layouts.app")

@section('content')
    <h1 class="text-center">
        Dashboard
    </h1>

    <table class="table table-dark table-bordered">
        <tr>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Role
            </th>
        </tr>
        <tr>
            <td>
                {{ auth()->user()->name }}
            </td>
            <td>
                {{ auth()->user()->email }}
            </td>
            <td>
                {{ auth()->user()->role }}
            </td>
        </tr>
    </table>
@endsection
