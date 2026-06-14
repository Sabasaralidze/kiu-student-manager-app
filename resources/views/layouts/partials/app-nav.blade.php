@php
    $calendarType = request()->routeIs('projects.*') ? 'projects' : (request()->routeIs('tasks.*') ? 'tasks' : request('type', 'all'));
@endphp
<nav class="app-nav" aria-label="Main navigation">
    <a href="{{ route('tasks.index') }}" class="app-nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/><rect x="9" y="3" width="6" height="4" rx="1"/></svg>
        Tasks
    </a>
    <a href="{{ route('projects.index') }}" class="app-nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        Projects
    </a>
    <a href="{{ route('calendar.index', ['type' => $calendarType === 'all' ? 'tasks' : $calendarType]) }}" class="app-nav-link {{ request()->routeIs('calendar.*') ? 'active' : '' }}">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
        Calendar
    </a>
</nav>
