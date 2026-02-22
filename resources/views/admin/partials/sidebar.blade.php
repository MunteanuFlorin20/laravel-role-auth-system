<a href="{{ route('admin.dashboard') }}"
    class="list-group-item list-group-item-action sidebar-link text-white border-0 p-3 fw-bold fs-5 
    {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <i class="bi bi-bar-chart-line me-2"></i> Dashboard
</a>

<a href="{{ route('admin.users.index') }}"
    class="list-group-item list-group-item-action sidebar-link text-white border-0 p-3 fw-bold fs-5 
    {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
    <i class="bi bi-people me-2"></i> Users
</a>
