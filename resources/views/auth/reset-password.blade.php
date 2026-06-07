@extends('layouts.guest')

@section('content')

<h2 class="page-title">New password</h2>

@if ($errors->any())
    <div class="msg-box error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('password.store') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus>
    </div>

    <div class="form-group">
        <label for="password">New password</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Reset password</button>
    </div>
</form>

@endsection
