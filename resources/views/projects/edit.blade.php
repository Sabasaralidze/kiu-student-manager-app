@extends('layouts.app')

@section('content')

@php
    $isOwner = $project->isOwner(auth()->user());
@endphp

<div class="page-header">
    <div>
        <h2 class="page-title">{{ $isOwner ? 'Edit Project' : 'View Project' }}</h2>
        <p class="page-subtitle">{{ $isOwner ? 'Update details and manage your team.' : 'You are a teammate on this project.' }}</p>
    </div>
    <a href="{{ route('projects.index') }}" class="btn btn-outline">Back to projects</a>
</div>

@include('layouts.partials.app-nav')

@if (session('success'))
    <div class="msg-box success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="msg-box error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('projects.update', $project) }}" class="form-card">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Project title</label>
        <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" {{ $isOwner ? '' : 'readonly' }} required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" {{ $isOwner ? '' : 'readonly' }} required>{{ old('description', $project->description) }}</textarea>
    </div>

    <div class="form-group">
        <label for="subject">Subject / course</label>
        <input type="text" id="subject" name="subject" value="{{ old('subject', $project->subject) }}" {{ $isOwner ? '' : 'readonly' }} required>
    </div>

    <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline" value="{{ old('deadline', $project->deadline) }}" {{ $isOwner ? '' : 'readonly' }} required>
    </div>

    @if($isOwner)
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update project</button>
        </div>
    @endif
</form>

<section class="profile-card" style="margin-top:24px;max-width:560px">
    <h3 class="profile-card-title">Team members</h3>

    <ul class="team-list">
        @foreach($project->members as $member)
            <li class="team-list-item">
                <div class="team-list-info">
                    <span class="team-avatar team-avatar-lg">{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                    <div>
                        <strong>{{ $member->name }}</strong>
                        <span class="task-meta">{{ $member->email }}</span>
                        @if($member->pivot->role === 'owner')
                            <span class="team-role-badge">Owner</span>
                        @endif
                    </div>
                </div>
                @if($isOwner && $member->pivot->role !== 'owner')
                    <form action="{{ route('projects.members.remove', [$project, $member]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove {{ $member->name }} from the team?')">Remove</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>

    @if($isOwner)
        <form method="POST" action="{{ route('projects.members.add', $project) }}" class="team-add-form">
            @csrf
            <div class="form-group" style="margin-bottom:0;flex:1">
                <label for="email">Add teammate by email</label>
                <input type="email" id="email" name="email" placeholder="teammate@gmail.com" required>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Add</button>
        </form>
        <p class="file-hint" style="margin-top:10px">They must already have a registered account.</p>
    @endif
</section>

@endsection
