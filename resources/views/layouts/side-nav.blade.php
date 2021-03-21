<div class="list-group rounded-0">
    @if(auth()->user()->role == 'admin')
        <a href="{{ route('admin.manage.users') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.manage.users') ? 'active' : ' ' }}">
            Manage Users
        </a>
        <a href="{{ route('admin.manage.subjects') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.manage.subjects') ? 'active' : ' ' }}">
            Manage Subjects
        </a>
        <a href="{{ route('admin.subject.teacher.assign.un.assign') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.subject.teacher.assign.un.assign') ? 'active' : ' ' }}">
            Teacher <=> Subject
        </a>
        <a href="{{ route('admin.subject.student.assign.un.assign') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.subject.student.assign.un.assign') ? 'active' : ' ' }}">
            Student <=> Subject
        </a>
    @elseif(auth()->user()->role == 'teacher')
        @foreach(auth()->user()->subjects as $subject)
            <div class="dropdown pl-2 {{ url()->current() == route('teacher.questions', [$subject->id]) || url()->current() == route('teacher.criteria', [$subject->id]) || url()->current() == route('teacher.check-exam', [$subject->id]) ? 'bg-info' : ' ' }}">
                <button class="btn btn-block dropdown-toggle text-left border-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $subject->label }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('teacher.questions', [$subject->id]) }}">
                        Question Bank Management
                    </a>
                    <a class="dropdown-item" href="{{ route('teacher.criteria', [$subject->id]) }}">
                        Paper Criteria Management
                    </a>
                    <a class="dropdown-item" href="{{ route('teacher.check-exam', [$subject->id]) }}">
                        Exam Checking
                    </a>
                </div>
            </div>
        @endforeach
    @else
        @foreach(auth()->user()->subjects as $subject)
            <div class="dropdown pl-2 {{ url()->current() == route('student.exam', [$subject->id]) || url()->current() == route('student.result', [$subject->id]) ? 'bg-info' : ' ' }}">
                <button class="btn btn-block dropdown-toggle text-left border-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $subject->label }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('student.exam', [$subject->id]) }}">
                        Exam
                    </a>
                    <a class="dropdown-item" href="{{ route('student.result', [$subject->id]) }}">
                        Result
                    </a>
                </div>
            </div>
        @endforeach
    @endif
</div>
