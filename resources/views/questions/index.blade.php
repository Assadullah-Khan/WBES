@extends("layouts.app")

@section("content")
<h1 class="text-center">
    All Available Questions
</h1>

<a href="/questions/create" class="btn btn-primary btn-lg my-4">
    Add a new Questions
</a>

<table class="table table-dark table-bordered">
    <tr>
        <td>
            S.No
        </td>
        <td>
            Description
        </td>
        <td>
            Options
        </td>
        <td>
            Answer
        </td>
        <td>
            Difficulty Level
        </td>
    </tr>

    @foreach($questions as $question)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td>
                {{ $question->description }}
            </td>
            <td>
                <ul>
                    @foreach(json_decode($question->options) as $option)
                        <li>
                            {{ $option  }}
                        </li>
                    @endforeach
                </ul>
            </td>
            <td>
                {{ $question->answer }}
            </td>
            <td>
                {{ $question->difficulty_level }}
            </td>
        </tr>
    @endforeach
</table>
@endsection
