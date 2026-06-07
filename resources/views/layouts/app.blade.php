<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIU Student Task Manager</title>
    @include('layouts.partials.theme-init')
    @include('layouts.partials.kiu-styles')
    <style>
        .site-header-inner { justify-content: space-between; }
        .header-brand { display: flex; align-items: center; gap: 18px; }
        .header-brand-link { text-decoration: none; color: inherit; }
        .header-account {
            display: flex;
            align-items: center;
            gap: 14px;
            color: var(--white);
            font-size: 13px;
        }
        .header-account .user-name { font-weight: bold; white-space: nowrap; }
        .header-account form { display: inline; margin: 0; }
        .header-account .btn-header {
            background: transparent;
            color: var(--white);
            border: 1px solid #a8c4e0;
            padding: 5px 12px;
            font-size: 12px;
            cursor: pointer;
            font-family: inherit;
            font-weight: bold;
        }
        .header-account .btn-header:hover { background: var(--blue); border-color: var(--blue); }
    </style>
</head>
<body>

    <header class="site-header">
        <div class="site-header-inner">
            <a href="{{ route('tasks.index') }}" class="header-brand header-brand-link" title="Back to main screen">
                <img src="/images/kiu-logo.png" class="logo" alt="KIU Logo">
                <div class="site-header-text">
                    <h1>KIU Student Task Manager</h1>
                    <p>Academic task &amp; document portal</p>
                </div>
            </a>
            <div class="header-account">
                @include('layouts.partials.theme-toggle')
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-header">Log out</button>
                </form>
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

</body>
</html>
