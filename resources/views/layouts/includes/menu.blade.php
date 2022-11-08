<li class="nav-item {{ Route::is('user.list') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('user.list') }}" aria-expanded="true">
        <i class="fas fa-fw fa-table"></i>
        <span>Người dùng</span>
    </a>
</li>
<li class="nav-item {{ Route::is('homework.list') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('homework.list') }}" aria-expanded="true">
        <i class="fas fa-fw fa-table"></i>
        <span>Bài tập</span>
    </a>
</li>
<li class="nav-item {{ Route::is('essay.list') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('essay.list') }}" aria-expanded="true">
        <i class="fas fa-fw fa-table"></i>
        <span>Giải đố</span>
    </a>
</li>