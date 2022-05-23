
<li class="nav-item {{ Request::is('slObjects*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('slObjects.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Sl Objects</span>
    </a>
</li>
<li class="nav-item {{ Request::is('users*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('users.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Users</span>
    </a>
</li>
<li class="nav-item {{ Request::is('quizzes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('quizzes.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Quizzes</span>
    </a>
</li>
<li class="nav-item {{ Request::is('questions*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('questions.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Questions</span>
    </a>
</li>
<li class="nav-item {{ Request::is('userModels*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('userModels.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>User Models</span>
    </a>
</li>
