@extends('layouts.dashboard')

@section('dashboard-content')

    @if(!$exam || !$exam->obtained_marks)
        <p class="my-5 py-5 text-center">
            The result is not declared yet.
        </p>
    @elseif($exam->obtained_marks)
        <div class="mt-4">
            <h4>
                Result Details
            </h4>
            <table class="table table-bordered">
                <tr>
                    <td>
                        Total Marks:
                    </td>
                    <td>
                        {{ $exam->total_marks }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Obtained Marks:
                    </td>
                    <td>
                        {{ $exam->obtained_marks }}
                    </td>
                </tr>
                <tr>
                    <td>
                        Pass Percentage:
                    </td>
                    <td>
	                    {{ $exam->criteria->pass_percentage }}%
                    </td>
                </tr>
                <tr>
                    <td>
                        Obtained Percentage:
                    </td>
                    <td>
	                    {{ ($exam->obtained_marks/$exam->total_marks)*100 }}%
                    </td>
                </tr>
                <tr>
                    <td>
                        Pass/Fail:
                    </td>
                    <td>
                        @if($exam->is_pass)
                            <span class="text-success">
                                Pass
                            </span>
                        @else
                            <span class="text-danger">
                                Fail
                            </span>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    @endif

@endsection
