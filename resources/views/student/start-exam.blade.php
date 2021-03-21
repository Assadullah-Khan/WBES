<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app" class="container-fluid">
    <script>
        window.onload = function() {
{{--            var minute = {{ $criteria->max_duration }} - 1;--}}
            var minute = 1;
            var sec = 60;
            setInterval(function() {
                document.getElementById("timer").innerHTML = minute + " : " + sec;
                sec--;
                if (sec == 00) {
                    minute --;
                    sec = 60;
                    if (minute == 0) {
                        $("#exam-form").submit();
                    }
                }
            }, 1000);
        }
    </script>
    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="ml-auto">
            Time remaining (minutes:seconds) :  <b id="timer" class="border rounded-circle p-2">00:00</b>
        </div>
    </nav>

    <script>
        function submitExam(){
            if(confirm("Please make sure you have attempted all the questions. This will end your exam. Do you really want to end your exam?")){
                $("#exam-form").submit();
            }
        }
    </script>

    <form class="mt-5" id="exam-form" method="post" action="{{ route('student.exam.submit', [$subjectId, $criteria->id]) }}" enctype="multipart/form-data">
        @csrf
        <ul class="list-group">
            @foreach($questions as $question)
                <li class="list-group-item">
                    <div class="text-right">
                        Marks = {{ $question->marks }}
                    </div>
                    {{ $loop->iteration }}.
                    {{ $question->description }}
                    @if($question->type == 'mcq')
                        @foreach(json_decode($question->options) as $option)
                            <div class="form-check ml-5">
                                <input class="form-check-input" type="radio" name="{{ $question->id }}" id="{{ $question->id }}+{{ $option }}" value="{{ $option }}">
                                <label class="form-check-label" for="{{ $question->id }}+{{ $option }}">
                                    {{ $option }}
                                </label>
                            </div>
                        @endforeach
                            <div class="form-check ml-5">
                                <input class="form-check-input d-none" type="radio" name="{{ $question->id }}" value="" checked>
                            </div>
                    @elseif($question->type == 'descriptive')
                        <div class="ml-5 mt-2">
                            <textarea name="{{ $question->id }}" id="{{ $question->id }}" rows="5" class="form-control">

                            </textarea>
                        </div>
                    @endif
                </li>
            @endforeach

            <li class="list-group-item">
                <div class="form-group row">
                    <button type="submit" class="btn btn-danger btn-block" onclick="event.preventDefault();submitExam()">
                        Submit Exam
                    </button>
                </div>
            </li>
        </ul>


    </form>
</div>
</body>
</html>
