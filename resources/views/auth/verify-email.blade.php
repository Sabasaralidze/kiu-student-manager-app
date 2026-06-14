@extends('layouts.guest')

@section('content')

<h2 class="page-title">Verify your email</h2>

<p class="file-hint" style="margin-bottom:18px">
    Thanks for registering. Click the link we sent to <strong>{{ auth()->user()->email }}</strong> before using your tasks.
    Check your spam folder too. Did not get it? Use the button below to send another.
</p>

@if (session('mail-error'))
    <div class="msg-box error">{{ session('mail-error') }}</div>
@endif

@if (session('status') === 'verification-link-sent')
    <div class="msg-box success">
        @if (session('mail-log-hint'))
            Verification link saved to <strong>{{ config('logging.channels.single.path') }}</strong> (local mode).
            Open that file, search for <strong>Verify Email Address:</strong>, and open the link in your browser.
        @else
            A new verification link has been sent to your email address.
        @endif
    </div>
@endif

<div class="form-actions-between">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn btn-primary">Resend verification email</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-outline">Log out</button>
    </form>
</div>

@endsection
