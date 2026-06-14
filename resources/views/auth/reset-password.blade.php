@extends('layouts.guest')

@section('content')

<h2 class="page-title">New password</h2>
<p class="page-subtitle">
    Use the <strong>latest</strong> reset link from <strong>{{ config('logging.channels.single.path') }}</strong>.
    Older links stop working after you request a new one.
</p>

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

    @include('layouts.partials.password-field', [
        'id' => 'password',
        'name' => 'password',
        'label' => 'New password',
        'required' => true,
    ])

    @include('layouts.partials.password-field', [
        'id' => 'password_confirmation',
        'name' => 'password_confirmation',
        'label' => 'Confirm password',
        'required' => true,
    ])

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Reset password</button>
    </div>
</form>

@endsection
