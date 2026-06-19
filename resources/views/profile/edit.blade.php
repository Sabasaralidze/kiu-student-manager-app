@extends('layouts.app')

@section('content')

<div class="page-header">
    <div>
        <h2 class="page-title">Profile</h2>
        <p class="page-subtitle">Update your account and student information.</p>
    </div>
    <a href="{{ route('tasks.index') }}" class="btn btn-outline">Back to tasks</a>
</div>

@if (session('success'))
    <div class="msg-box success">{{ session('success') }}</div>
@endif

<div class="profile-sections">
    <section class="profile-card">
        <h3 class="profile-card-title">Account information</h3>

        @if ($errors->any() && ! $errors->getBag('updatePassword')->any())
            <div class="msg-box error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="form-card">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="student_id">Student ID</label>
                <input type="text" id="student_id" name="student_id" value="{{ old('student_id', $profile->student_id) }}" placeholder="e.g. ST2024001">
            </div>

            <div class="form-group">
                <label for="faculty">Faculty / Program</label>
                <input type="text" id="faculty" name="faculty" value="{{ old('faculty', $profile->faculty) }}" placeholder="e.g. Computer Science">
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}" placeholder="e.g. +995 555 123 456">
            </div>

            <div class="form-actions" style="border-top: none; padding-top: 0; margin-top: 8px;">
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </section>

    <section class="profile-card">
        <h3 class="profile-card-title">Change password</h3>

        @if ($errors->hasBag('updatePassword'))
            <div class="msg-box error">
                <ul>
                    @foreach ($errors->getBag('updatePassword')->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="form-card">
            @csrf
            @method('PUT')

            @include('layouts.partials.password-field', [
                'id' => 'current_password',
                'name' => 'current_password',
                'label' => 'Current password',
                'required' => true,
            ])

            @include('layouts.partials.password-field', [
                'id' => 'password',
                'name' => 'password',
                'label' => 'New password',
                'required' => true,
            ])

            @include('layouts.partials.password-field', [
                'id' => 'password_confirmation',
                'name' => 'password_confirmation',
                'label' => 'Confirm new password',
                'required' => true,
            ])

            <div class="form-actions" style="border-top: none; padding-top: 0; margin-top: 8px;">
                <button type="submit" class="btn btn-primary">Update password</button>
            </div>
        </form>
    </section>
</div>

@endsection
