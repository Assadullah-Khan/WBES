<div class="list-group py-4">
    <a href="{{ route('admin.manage.users') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.manage.users') ? 'active' : ' ' }}">
        Manage Users
    </a>
    <a href="{{ route('admin.manage.subjects') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.manage.subjects') ? 'active' : ' ' }}">
        Manage Subjects
    </a>
    <a href="{{ route('admin.subject.teacher.assign.un.assign') }}" class="list-group-item list-group-item-action {{ url()->current() == route('admin.subject.teacher.assign.un.assign') ? 'active' : ' ' }}">
        Teacher-Subject Assign/Un-Assign
    </a>
</div>
