<aside class="sidebar">
    <h2 class="logo">CRM</h2>
    <nav>
        <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>

        @if(Auth::user()->role === 'admin')
            <div class="nav-label">Administration</div>
            <a href="{{ route('admin.users.index') }}" class="{{ request()->is('admin/users*') ? 'active' : '' }}">User Management</a>
        @endif

        @if(in_array(Auth::user()->role, ['admin', 'inspector']))
            <div class="nav-label">Operations</div>
            <a href="{{ route('inspections.index') }}" class="{{ request()->is('inspections*') ? 'active' : '' }}">Inspections</a>
        @endif
    </nav>

    <form method="POST" action="{{ route('logout') }}" style="margin-top:auto;">
        @csrf
        <button type="submit" class="logout">Logout</button>
    </form>
</aside>
