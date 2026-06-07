@extends('layouts.guest')

@section('content')

<h2 class="page-title">Create account</h2>

@if ($errors->any())
    <div class="msg-box error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="form-group">
        <label for="name">Full name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Register</button>
    </div>
</form>

<p class="auth-links">
    Already have an account? <a href="{{ route('login') }}">Sign in</a>
</p>

@endsection
