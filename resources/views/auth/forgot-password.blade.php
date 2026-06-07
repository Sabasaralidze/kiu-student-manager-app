@extends('layouts.guest')

@section('content')

<h2 class="page-title">Reset password</h2>

<p class="file-hint" style="margin-bottom:18px">
    Enter your email and we will send you a link to choose a new password.
</p>

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

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Send reset link</button>
        <a href="{{ route('login') }}" class="btn btn-outline">Back to login</a>
    </div>
</form>

@endsection
