@extends('layouts.app')

@section('content')

@php
    $filters = request()->only(['q', 'sort']);
    $currentSort = request('sort', 'deadline');
@endphp

<div class="page-header">
    <div>
        <h2 class="page-title">My Tasks</h2>
        <p class="page-subtitle">Your personal assignments — completely separate from Projects.</p>
    </div>
    <a href="/tasks/create" class="btn btn-primary">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
        New Task
    </a>
</div>

@if (session('success'))
    <div class="msg-box success">{{ session('success') }}</div>
@endif

@include('layouts.partials.app-nav')

<div class="stats-grid">
    <div class="stat-card">
        <span class="stat-value">{{ $stats['pending'] }}</span>
        <span class="stat-label">Pending</span>
    </div>
    <div class="stat-card stat-card-warning">
        <span class="stat-value">{{ $stats['overdue'] }}</span>
        <span class="stat-label">Overdue</span>
    </div>
    <div class="stat-card stat-card-success">
        <span class="stat-value">{{ $stats['completed_week'] }}</span>
        <span class="stat-label">Done this week</span>
    </div>
    <div class="stat-card stat-card-info">
        <span class="stat-value">{{ $stats['upcoming'] }}</span>
        <span class="stat-label">Due in 7 days</span>
    </div>
</div>

<form method="GET" action="{{ route('tasks.index') }}" class="search-bar">
    @if (request('status'))
        <input type="hidden" name="status" value="{{ request('status') }}">
    @endif
    @if ($currentSort !== 'deadline')
        <input type="hidden" name="sort" value="{{ $currentSort }}">
    @endif
    <div class="search-input-wrap">
        <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search tasks by title or subject…" class="search-input">
    </div>
    <button type="submit" class="btn btn-outline btn-sm">Search</button>
    @if (request('q'))
        <a href="{{ route('tasks.index', array_merge($filters, request('status') ? ['status' => request('status')] : [])) }}" class="btn btn-outline btn-sm">Clear</a>
    @endif
</form>

<div class="toolbar">
    <div class="filter-tabs">
        <a href="{{ route('tasks.index', $filters) }}" class="{{ !request('status') ? 'active' : '' }}">All</a>
        <a href="{{ route('tasks.index', array_merge($filters, ['status' => 'pending'])) }}" class="{{ request('status') === 'pending' ? 'active' : '' }}">Pending</a>
        <a href="{{ route('tasks.index', array_merge($filters, ['status' => 'done'])) }}" class="{{ request('status') === 'done' ? 'active' : '' }}">Completed</a>
    </div>

    <form method="GET" action="{{ route('tasks.index') }}" class="sort-form">
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

@if($tasks->count() == 0)
    <div class="empty-state">
        <svg class="empty-state-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
            <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
            <rect x="9" y="3" width="6" height="4" rx="1"/>
            <path d="M9 12h6M9 16h4"/>
        </svg>
        @if (request('q') || request('status'))
            <p>No tasks match your filters.</p>
            <a href="{{ route('tasks.index') }}" class="btn btn-outline">Clear filters</a>
        @else
            <p>No tasks in this list yet.</p>
            <a href="/tasks/create" class="btn btn-primary">Create your first task</a>
        @endif
    </div>
@else
    <ul class="task-list">
        @foreach($tasks as $task)
            @php
                $isOverdue = \Carbon\Carbon::parse($task->deadline)->isPast() && $task->status !== 'done';
            @endphp
            <li class="task-card">
                <div class="task-card-top">
                    <div class="task-card-title-row">
                        <h2>{{ $task->title }}</h2>
                        <div class="task-badges">
                            <span class="type-tag type-tag-task">Task</span>
                            <span class="status-tag {{ $task->status }}">{{ $task->status }}</span>
                            @if($isOverdue)
                                <span class="status-tag expired">Overdue</span>
                            @endif
                        </div>
                    </div>
                    <div class="task-chips">
                        <span class="chip">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                            {{ $task->subject }}
                        </span>
                        <span class="chip {{ $isOverdue ? 'chip-overdue' : '' }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                            {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                        </span>
                    </div>
                </div>

                <div class="task-card-body">
                    @if($task->description)
                        <p class="task-desc">{{ $task->description }}</p>
                    @endif

                    @if($task->attachments->count())
                        <div class="pdf-block">
                            <p class="pdf-block-title">Attached PDFs ({{ $task->attachments->count() }})</p>
                            <ul>
                                @foreach($task->attachments as $attachment)
                                    <li>
                                        <a href="{{ route('attachments.download', $attachment) }}">{{ $attachment->original_name }}</a>
                                        <span class="task-meta">{{ $attachment->formattedSize() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="task-actions">
                        <a href="/tasks/{{ $task->id }}/edit" class="btn btn-outline btn-sm btn-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            Edit
                        </a>

                        <form action="/tasks/{{ $task->id }}/toggle" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-blue btn-sm btn-icon">
                                @if($task->status === 'pending')
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                                    Complete
                                @else
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                    Reopen
                                @endif
                            </button>
                        </form>

                        <form action="/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm btn-icon" onclick="return confirm('Delete this task and all PDFs?')">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif

@endsection
