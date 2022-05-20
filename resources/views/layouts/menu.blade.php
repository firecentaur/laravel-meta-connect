<li class="nav-item {{ Request::is('quizzes*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('quizzes.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Quizzes</span>
    </a>
</li>
<li class="nav-item {{ Request::is('slObjects*') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('slObjects.index') }}">
        <i class="nav-icon icon-cursor"></i>
        <span>Sl Objects</span>
    </a>
</li>
