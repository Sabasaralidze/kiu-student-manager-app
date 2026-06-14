@extends('layouts.app')

@section('content')

@php
    $monthParams = ['year' => $month->year, 'month' => $month->month, 'type' => $type];
@endphp

<div class="page-header">
    <div>
        <h2 class="page-title">Calendar</h2>
        <p class="page-subtitle">
            @if ($type === 'projects')
                Project deadlines only — group assignments with your team.
            @else
                Task deadlines only — your personal assignments.
            @endif
        </p>
    </div>
    @if ($type === 'projects')
        <a href="{{ route('projects.create') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            New Project
        </a>
    @else
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>
            New Task
        </a>
    @endif
</div>

@include('layouts.partials.app-nav')

<div class="calendar-type-tabs">
    <a href="{{ route('calendar.index', ['type' => 'tasks']) }}" class="calendar-type-tab {{ $type === 'tasks' ? 'active' : '' }}">Tasks</a>
    <a href="{{ route('calendar.index', ['type' => 'projects']) }}" class="calendar-type-tab {{ $type === 'projects' ? 'active' : '' }}">Projects</a>
</div>

<div class="calendar-toolbar">
    <a href="{{ route('calendar.index', ['year' => $prevMonth->year, 'month' => $prevMonth->month, 'type' => $type]) }}" class="btn btn-outline btn-sm calendar-nav-btn" aria-label="Previous month">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m15 18-6-6 6-6"/></svg>
    </a>
    <h3 class="calendar-month-title">{{ $month->format('F Y') }}</h3>
    <a href="{{ route('calendar.index', ['year' => $nextMonth->year, 'month' => $nextMonth->month, 'type' => $type]) }}" class="btn btn-outline btn-sm calendar-nav-btn" aria-label="Next month">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>
    </a>
    @if (! $month->isCurrentMonth())
        <a href="{{ route('calendar.index', ['type' => $type]) }}" class="btn btn-outline btn-sm">Today</a>
    @endif
</div>

<div class="calendar-legend">
    @if ($type === 'projects')
        <span class="calendar-legend-item"><span class="calendar-dot calendar-dot-project"></span> Project</span>
    @else
        <span class="calendar-legend-item"><span class="calendar-dot calendar-dot-pending"></span> Pending</span>
        <span class="calendar-legend-item"><span class="calendar-dot calendar-dot-overdue"></span> Overdue</span>
        <span class="calendar-legend-item"><span class="calendar-dot calendar-dot-done"></span> Done</span>
    @endif
</div>

<div class="calendar-grid" role="grid" aria-label="{{ ucfirst($type) }} calendar for {{ $month->format('F Y') }}">
    <div class="calendar-weekdays" role="row">
        @foreach (['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $dayName)
            <div class="calendar-weekday" role="columnheader">{{ $dayName }}</div>
        @endforeach
    </div>

    @foreach ($weeks as $week)
        <div class="calendar-week" role="row">
            @foreach ($week as $day)
                <div
                    class="calendar-day {{ $day['isCurrentMonth'] ? '' : 'calendar-day-outside' }} {{ $day['isToday'] ? 'calendar-day-today' : '' }}"
                    role="gridcell"
                >
                    <span class="calendar-day-num">{{ $day['date']->day }}</span>

                    @if ($day['items']->isNotEmpty())
                        <ul class="calendar-tasks">
                            @foreach ($day['items'] as $item)
                                @php
                                    $isOverdue = $item->status === 'pending' && \Carbon\Carbon::parse($item->deadline)->startOfDay()->lt(now()->startOfDay());
                                    if ($item->kind === 'project') {
                                        $itemClass = $item->status === 'done' ? 'project-done' : ($isOverdue ? 'project-overdue' : 'project');
                                    } else {
                                        $itemClass = $item->status === 'done' ? 'done' : ($isOverdue ? 'overdue' : 'pending');
                                    }
                                @endphp
                                <li>
                                    <a
                                        href="{{ $item->edit_url }}"
                                        class="calendar-task calendar-task-{{ $itemClass }}"
                                        title="{{ $item->title }} — {{ $item->subject }}"
                                    >
                                        {{ $item->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection
