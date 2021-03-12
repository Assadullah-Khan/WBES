<div class="list-group py-4">
    @if(auth()->user()->role == 'admin')
        <a href="{{ route('admin.manage.users') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.manage.users') ? 'active' : ' ' }}">
            Manage Users
        </a>
        <a href="{{ route('admin.manage.subjects') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.manage.subjects') ? 'active' : ' ' }}">
            Manage Subjects
        </a>
        <a href="{{ route('admin.subject.teacher.assign.un.assign') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.subject.teacher.assign.un.assign') ? 'active' : ' ' }}">
            Teacher-Subject Assign/Un-Assign
        </a>
        <a href="{{ route('admin.subject.student.assign.un.assign') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.subject.student.assign.un.assign') ? 'active' : ' ' }}">
            Student-Subject Assign/Un-Assign
        </a>
    @elseif(auth()->user()->role == 'teacher')
        @foreach(auth()->user()->subjects as $subject)
            <div class="dropdown {{ url()->current() == route('teacher.questions', [$subject->id]) ? 'bg-info' : ' ' }}">
                <button class="btn btn-block dropdown-toggle text-left border-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $subject->label }}
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('teacher.questions', [$subject->id]) }}">
                        Question Bank Management
                    </a>
                    <a class="dropdown-item" href="#">Paper Criteria Management</a>
                    <a class="dropdown-item" href="#">Exam Checking</a>
                    <a class="dropdown-item" href="#">Result Declaration</a>
                </div>
            </div>
        @endforeach
    @else

    @endif
</div>
