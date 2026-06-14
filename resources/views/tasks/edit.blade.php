@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h2 class="page-title">Edit Task</h2>
        <p class="page-subtitle">Update your personal task details or manage PDFs.</p>
    </div>
</div>

@if (session('success'))
    <div class="msg-box success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="msg-box error">
        <strong>Please fix the following:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/tasks/{{ $task->id }}" method="POST" enctype="multipart/form-data" class="form-card">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Task title</label>
        <input type="text" id="title" name="title" value="{{ $task->title }}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description">{{ $task->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="subject">Subject / course</label>
        <input type="text" id="subject" name="subject" value="{{ $task->subject }}">
    </div>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="{{ $task->deadline }}">
    </div>

    @if($task->attachments->count())
        <div class="pdf-block">
            <p class="pdf-block-title">Uploaded PDFs</p>
            <ul>
                @foreach($task->attachments as $attachment)
                    <li>
                        <a href="{{ route('attachments.download', $attachment) }}">{{ $attachment->original_name }}</a>
                        <span class="task-meta"> ({{ $attachment->formattedSize() }})</span>
                        <form action="{{ route('attachments.destroy', $attachment) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline btn-sm" onclick="return confirm('Remove this PDF?')">Remove</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="pdfs">Add more PDFs</label>
        <input type="file" id="pdfs" name="pdfs[]" accept="application/pdf,.pdf" multiple>
        <p class="file-hint">Optional. Up to 10 files, 10 MB each.</p>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Update task</button>
        <a href="/tasks" class="btn btn-outline">Back to list</a>
    </div>
</form>

@endsection
