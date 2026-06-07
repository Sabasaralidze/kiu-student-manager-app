@extends('layouts.app')

@section('content')

<h2 class="page-title">Create New Task</h2>

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

<form method="POST" action="/tasks" enctype="multipart/form-data" class="form-card">
    @csrf

    <div class="form-group">
        <label for="title">Task title</label>
        <input type="text" id="title" name="title" placeholder="e.g. Submit research paper" value="{{ old('title') }}">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="What needs to be done?">{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="subject">Subject / course</label>
        <input type="text" id="subject" name="subject" placeholder="e.g. Database Systems" value="{{ old('subject') }}">
    </div>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}">
    </div>

    <div class="form-group">
        <label for="pdfs">PDF documents</label>
        <input type="file" id="pdfs" name="pdfs[]" accept="application/pdf,.pdf" multiple>
        <p class="file-hint">Optional. Up to 10 files, 10 MB each.</p>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save task</button>
        <a href="/tasks" class="btn btn-outline">Cancel</a>
    </div>
</form>

@endsection
