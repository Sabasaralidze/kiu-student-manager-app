<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIU Student Task Manager</title>
    @include('layouts.partials.theme-init')
    @include('layouts.partials.kiu-styles')
</head>
<body>

    <header class="site-header">
        <div class="site-header-inner" style="justify-content: space-between;">
            <a href="{{ url('/') }}" class="header-brand-link" title="Back to home">
                <img src="/images/kiu-logo.png" class="logo" alt="KIU Logo">
                <div class="site-header-text">
                    <h1>KIU Student Task Manager</h1>
                    <p>Student sign in</p>
                </div>
            </a>
            @include('layouts.partials.theme-toggle')
        </div>
    </header>

    <main class="page-wrap">
        <div class="page-panel">
            <div class="page-body auth-panel">
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
