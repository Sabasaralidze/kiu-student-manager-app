<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIU Student Task Manager</title>
    @include('layouts.partials.theme-init')
    @include('layouts.partials.kiu-styles')
    <style>
        .auth-panel {
            max-width: 420px;
            margin: 0 auto;
        }

        .auth-panel .page-title {
            text-align: center;
        }

        .auth-links {
            margin-top: 16px;
            font-size: 13px;
            text-align: center;
        }

        .auth-links a {
            font-weight: bold;
        }

        .remember-row {
            margin: 12px 0;
            font-size: 13px;
        }

        .remember-row input {
            width: auto;
            margin-right: 6px;
        }

        .form-actions-between {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
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
