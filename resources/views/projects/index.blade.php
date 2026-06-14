@extends('layouts.app')

@section('content')

@php
    $filters = request()->only(['q', 'sort']);
    $currentSort = request('sort', 'deadline');
@endphp

<div class="page-header">
    <div>
        <h2 class="page-title">My Projects</h2>
    </div>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
        New Project
    </a>
</div>

@if (session('success'))
    <div class="msg-box success">{{ session('success') }}</div>
@endif

@include('layouts.partials.app-nav')

<div class="stats-grid">
    <div class="stat-card">
        <span class="stat-value">{{ $stats['pending'] }}</span>
        <span class="stat-label">Projects pending</span>
    </div>
    <div class="stat-card stat-card-warning">
        <span class="stat-value">{{ $stats['overdue'] }}</span>
        <span class="stat-label">Projects overdue</span>
    </div>
    <div class="stat-card stat-card-success">
        <span class="stat-value">{{ $stats['completed_week'] }}</span>
        <span class="stat-label">Projects done</span>
    </div>
    <div class="stat-card stat-card-info">
        <span class="stat-value">{{ $stats['team'] }}</span>
        <span class="stat-label">Shared with me</span>
    </div>
</div>

<form method="GET" action="{{ route('projects.index') }}" class="search-bar">
    @if (request('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    @if ($currentSort !== 'deadline')
        <input type="hidden" name="sort" value="{{ $currentSort }}">
    @endif
    <div class="search-input-wrap">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search projects by title or subject…" class="search-input">
    </div>
    <button type="submit" class="btn btn-outline btn-sm">Search</button>
    @if (request('q'))
        <a href="{{ route('projects.index', array_merge($filters, request('status') ? ['status' => request('status')] : [])) }}" class="btn btn-outline btn-sm">Clear</a>
    @endif
</form>

<div class="toolbar">
    <div class="filter-tabs">
        <a href="{{ route('projects.index', $filters) }}" class="{{ !request('status') ? 'active' : '' }}">All</a>
        <a href="{{ route('projects.index', array_merge($filters, ['status' => 'pending'])) }}" class="{{ request('status') === 'pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ route('projects.index', array_merge($filters, ['status' => 'done'])) }}" class="{{ request('status') === 'done' ? 'active' : '' }}">Completed</a>
    </div>

    <form method="GET" action="{{ route('projects.index') }}" class="sort-form">
        @if (request('status'))
            <input type="hidden" name="status" value="{{ request('status') }}">
        @endif
        @if (request('q'))
            <input type="hidden" name="q" value="{{ request('q') }}">
        @endif
        <label for="sort" class="sort-label">Sort</label>
        <select name="sort" id="sort" class="sort-select" onchange="this.form.submit()">
            <option value="deadline" @selected($currentSort === 'deadline')>Deadline (nearest)</option>
            <option value="newest" @selected($currentSort === 'newest')>Newest first</option>
        </select>
    </form>
</div>

@if($projects->count() == 0)
    <div class="empty-state">
        <svg class="empty-state-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        @if (request('q') || request('status'))
            <p>No projects match your filters.</p>
            <a href="{{ route('projects.index') }}" class="btn btn-outline">Clear filters</a>
        @else
            <p>No projects yet. Create one and invite teammates.</p>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Create your first project</a>
        @endif
    </div>
@else
    <ul class="project-list">
        @foreach($projects as $project)
            @php
                $isOverdue = \Carbon\Carbon::parse($project->deadline)->isPast() && $project->status !== 'done';
                $isMember = $project->user_id !== auth()->id();
            @endphp
            <li class="project-card">
                <div class="project-card-top">
                    <div class="task-card-title-row">
                        <h2>{{ $project->title }}</h2>
                        <div class="task-badges">
                            <span class="type-tag type-tag-project">Project</span>
                            <span class="status-tag {{ $project->status }}">{{ $project->status }}</span>
                            @if($isOverdue)
                                <span class="status-tag expired">Overdue</span>
                            @endif
                            @if($isMember)
                                <span class="status-tag pending" style="text-transform:none;letter-spacing:0">Team</span>
                            @endif
                        </div>
                    </div>
                    <div class="task-chips">
                        <span class="chip">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            {{ $project->subject }}
                        </span>
                        <span class="chip {{ $isOverdue ? 'chip-overdue' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <div class="project-card-body">
                    @if($project->description)
                        <p class="task-desc">{{ $project->description }}</p>
                    @endif

                    <div class="team-block">
                        <p class="pdf-block-title">Team ({{ $project->members->count() }})</p>
                        <div class="team-avatars">
                            @foreach($project->members as $member)
                                <span class="team-member" title="{{ $member->name }} ({{ $member->email }})">
                                    <span class="team-avatar">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                    <span class="team-member-name">{{ $member->name }}</span>
                                    @if($member->pivot->role === 'owner')
                                        <span class="team-role">Owner</span>
                                    @endif
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <div class="project-actions">
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline btn-sm btn-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            {{ $project->isOwner(auth()->user()) ? 'Edit project' : 'View project' }}
                        </a>

                        <form action="{{ route('projects.toggle', $project) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-blue btn-sm btn-icon">
                                @if($project->status === 'pending')
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                                    Finish project
                                @else
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                    Reopen project
                                @endif
                            </button>
                        </form>

                        @if($project->isOwner(auth()->user()))
                            <form action="{{ route('projects.destroy', $project) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Delete this project?')">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                    Delete project
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif

@endsection
