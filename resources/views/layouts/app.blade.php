<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ request()->routeIs('projects.*') ? 'Projects' : 'Tasks' }} — KIU Student Manager</title>
    @include('layouts.partials.theme-init')
    @include('layouts.partials.kiu-styles')
    <style>
        .site-header-inner { justify-content: space-between; }
        .header-brand { display: flex; align-items: center; gap: 14px; }
        .header-account {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .header-account form { display: inline; margin: 0; }
    </style>
</head>
<body>

    @php
        $onProjects = request()->routeIs('projects.*');
        $homeRoute = $onProjects ? route('projects.index') : route('tasks.index');
    @endphp

    <header class="site-header">
        <div class="site-header-inner">
            <a href="{{ $homeRoute }}" class="header-brand header-brand-link" title="Back to main screen">
                <img src="/images/kiu-logo.png" class="logo" alt="KIU Logo">
                <div class="site-header-text">
                    <h1>{{ $onProjects ? 'KIU Student Project Manager' : 'KIU Student Task Manager' }}</h1>
                    <p>{{ $onProjects ? 'Academic project &amp; team portal' : 'Academic task &amp; document portal' }}</p>
                </div>
            </a>
            <div class="header-account">
                @include('layouts.partials.theme-toggle')
                <div class="user-pill">
                    <a href="{{ route('profile.edit') }}" class="user-pill-link" title="Edit profile">
                        <span class="user-avatar" aria-hidden="true">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-header">Log out</button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main class="page-wrap">
        <div class="page-panel">
            <div class="page-body">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="site-footer">
        Kutaisi International University &mdash; Student Task Manager
    </footer>

    @include('layouts.partials.theme-script')
    @include('layouts.partials.password-toggle-script')

</body>
</html>
