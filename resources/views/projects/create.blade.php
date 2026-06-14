@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h2 class="page-title">Create Project</h2>
        <p class="page-subtitle">Start a group project and invite teammates by email.</p>
    </div>
</div>

@include('layouts.partials.app-nav')

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

<form method="POST" action="{{ route('projects.store') }}" class="form-card">
    @csrf

    <div class="form-group">
        <label for="title">Project title</label>
        <input type="text" id="title" name="title" placeholder="e.g. Web Development Final Project" value="{{ old('title') }}" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" placeholder="What is this project about?" required>{{ old('description') }}</textarea>
    </div>

    <div class="form-group">
        <label for="subject">Subject / course</label>
        <input type="text" id="subject" name="subject" placeholder="e.g. Web Development" value="{{ old('subject') }}" required>
    </div>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}" required>
    </div>

    <div class="form-group">
        <label for="teammate_emails">Teammate emails</label>
        <textarea id="teammate_emails" name="teammate_emails" placeholder="friend@email.com, teammate@gmail.com" rows="3">{{ old('teammate_emails') }}</textarea>
        <p class="file-hint">Optional. Separate emails with commas. Teammates must already have an account.</p>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save project</button>
        <a href="{{ route('projects.index') }}" class="btn btn-outline">Cancel</a>
    </div>
</form>

@endsection
