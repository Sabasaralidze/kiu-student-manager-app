@extends('layouts.guest')

@section('content')

<h2 class="page-title">Sign in</h2>
<p class="page-subtitle">Welcome back — enter your credentials to continue.</p>

@if (session('status'))
    <div class="msg-box success">{{ session('status') }}</div>
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

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    @include('layouts.partials.password-field', [
        'id' => 'password',
        'name' => 'password',
        'label' => 'Password',
        'required' => true,
    ])

    <div class="remember-row">
        <label>
            <input type="checkbox" name="remember"> Remember me
        </label>
    </div>

    <div class="form-actions-between">
        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Forgot password?</a>
        @endif
        <button type="submit" class="btn btn-primary">Log in</button>
    </div>
</form>

<p class="auth-links">
    No account? <a href="{{ route('register') }}">Register here</a>
</p>

@endsection
