@extends('layouts.app')

@section('content')

<h2 class="page-title">My Tasks</h2>
<p class="task-meta" style="margin:-12px 0 18px">Signed in as <strong>{{ auth()->user()->name }}</strong></p>

<div class="toolbar">
    <div class="filter-tabs">
        <a href="/tasks" class="{{ !request('status') ? 'active' : '' }}">All</a>
        <a href="/tasks?status=pending" class="{{ request('status') === 'pending' ? 'active' : '' }}">Pending</a>
        <a href="/tasks?status=done" class="{{ request('status') === 'done' ? 'active' : '' }}">Completed</a>
    </div>
    <a href="/tasks/create" class="btn btn-primary">+ New Task</a>
</div>

@if($tasks->count() == 0)
    <div class="empty-state">
        <p>No tasks in this list yet.</p>
        <a href="/tasks/create" class="btn btn-primary">Create your first task</a>
    </div>
@else
    <ul class="task-list">
        @foreach($tasks as $task)
            <li class="task-card">
                <div class="task-card-head">
                    <h2>{{ $task->title }}</h2>
                    <div class="task-meta">
                        <strong>{{ $task->subject }}</strong>
                        &nbsp;&bull;&nbsp;
                        Due: {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
                    </div>
                </div>

                <div class="task-card-body">
                    <p>
                        <span class="status-tag {{ $task->status }}">{{ $task->status }}</span>
                        @if(\Carbon\Carbon::parse($task->deadline)->isPast() && $task->status !== 'done')
                            <span class="status-tag expired">Overdue</span>
                        @endif
                    </p>

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
                                        <span class="task-meta"> — {{ $attachment->formattedSize() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="task-actions">
                        <a href="/tasks/{{ $task->id }}/edit" class="btn btn-outline btn-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                            Edit
                        </a>

                        <form action="/tasks/{{ $task->id }}/toggle" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-blue btn-icon">
                                @if($task->status === 'pending')
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg>
                                    Mark completed
                                @else
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                                    Mark pending
                                @endif
                            </button>
                        </form>

                        <form action="/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm btn-icon" onclick="return confirm('Delete this task and all PDFs?')">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
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
