<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --navy: #0c2d5a;
        --blue: #1a5fb4;
        --blue-mid: #3b82f6;
        --blue-light: #60a5fa;
        --blue-pale: #eff6ff;
        --blue-line: #dbeafe;
        --surface: #ffffff;
        --surface-raised: #f8fafc;
        --text: #0f172a;
        --text-soft: #64748b;
        --text-muted: #94a3b8;
        --success: #059669;
        --success-bg: #ecfdf5;
        --warning: #d97706;
        --warning-bg: #fffbeb;
        --danger: #dc2626;
        --danger-bg: #fef2f2;
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-full: 999px;
        --shadow-sm: 0 1px 2px rgba(15, 23, 42, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(15, 23, 42, 0.08), 0 2px 4px -2px rgba(15, 23, 42, 0.05);
        --shadow-lg: 0 10px 25px -5px rgba(15, 23, 42, 0.1), 0 8px 10px -6px rgba(15, 23, 42, 0.06);
        --transition: 0.18s ease;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: "Inter", system-ui, -apple-system, sans-serif;
        font-size: 15px;
        color: var(--text);
        background: linear-gradient(160deg, #f0f6ff 0%, #e8f0fe 45%, #f8fafc 100%);
        line-height: 1.6;
        min-height: 100vh;
        -webkit-font-smoothing: antialiased;
    }

    /* —— Header —— */
    .site-header {
        background: linear-gradient(135deg, #0c2d5a 0%, #1a4a7a 100%);
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .site-header-inner {
        max-width: 1100px;
        margin: 0 auto;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .site-header img.logo {
        height: 48px;
        width: auto;
        background: var(--surface);
        padding: 6px 10px;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-sm);
    }

    .site-header-text h1 {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 700;
        color: #fff;
        letter-spacing: -0.02em;
        line-height: 1.3;
    }

    .site-header-text p {
        margin: 2px 0 0;
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.65);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-weight: 500;
    }

    .header-brand-link {
        display: flex;
        align-items: center;
        gap: 14px;
        text-decoration: none;
        color: inherit;
        transition: opacity var(--transition);
    }

    .header-brand-link:hover { opacity: 0.9; }

    .header-tools {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .theme-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        padding: 0;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius-sm);
        background: rgba(255, 255, 255, 0.08);
        color: #fff;
        cursor: pointer;
        transition: background var(--transition), border-color var(--transition);
    }

    .theme-toggle:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.35);
    }

    .theme-toggle .icon-moon { display: none; }
    html[data-theme="dark"] .theme-toggle .icon-sun { display: none; }
    html[data-theme="dark"] .theme-toggle .icon-moon { display: block; }

    .user-pill {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 4px 4px 4px 12px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: var(--radius-full);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .user-name {
        font-size: 0.8125rem;
        font-weight: 600;
        color: #fff;
        white-space: nowrap;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .btn-header {
        background: rgba(255, 255, 255, 0.12);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 7px 14px;
        font-size: 0.8125rem;
        font-weight: 600;
        border-radius: var(--radius-full);
        cursor: pointer;
        font-family: inherit;
        transition: background var(--transition), border-color var(--transition);
    }

    .btn-header:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.35);
    }

    /* —— Layout —— */
    .page-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 28px 24px 40px;
    }

    .page-panel {
        background: var(--surface);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        overflow: hidden;
    }

    .page-body {
        padding: 28px 32px 36px;
    }

    .page-header {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 24px;
    }

    .page-title {
        margin: 0;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--navy);
        letter-spacing: -0.03em;
        line-height: 1.2;
    }

    .page-subtitle {
        margin: 6px 0 0;
        font-size: 0.9375rem;
        color: var(--text-soft);
        font-weight: 400;
    }

    /* —— Dashboard stats —— */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }

    .stat-card {
        padding: 18px 16px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-md);
        text-align: center;
        border-top: 3px solid var(--navy);
    }

    .stat-card-warning { border-top-color: var(--warning); }
    .stat-card-success { border-top-color: var(--success); }
    .stat-card-info { border-top-color: var(--blue-mid); }

    .stat-value {
        display: block;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--navy);
        line-height: 1.1;
        letter-spacing: -0.03em;
    }

    .stat-label {
        display: block;
        margin-top: 4px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-soft);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* —— Search —— */
    .search-bar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
    }

    .search-input-wrap {
        position: relative;
        flex: 1;
        min-width: 200px;
    }

    .search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: var(--text-muted);
        pointer-events: none;
    }

    .search-input {
        width: 100%;
        padding: 10px 14px 10px 40px;
        font-family: inherit;
        font-size: 0.9375rem;
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-sm);
        background: var(--surface);
        color: var(--text);
        transition: border-color var(--transition), box-shadow var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--blue-mid);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    .sort-form {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .sort-label {
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-soft);
    }

    .sort-select {
        padding: 8px 12px;
        font-family: inherit;
        font-size: 0.8125rem;
        font-weight: 500;
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-sm);
        background: var(--surface);
        color: var(--text);
        cursor: pointer;
    }

    .sort-select:focus {
        outline: none;
        border-color: var(--blue-mid);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    /* —— Profile —— */
    .profile-sections {
        display: grid;
        gap: 24px;
        max-width: 560px;
    }

    .profile-card {
        padding: 22px 24px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-md);
    }

    .profile-card-title {
        margin: 0 0 18px;
        font-size: 1rem;
        font-weight: 700;
        color: var(--navy);
    }

    .user-pill-link {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: inherit;
        border-radius: var(--radius-full);
        transition: opacity var(--transition);
    }

    .user-pill-link:hover { opacity: 0.85; }

    /* —— App navigation —— */
    .app-nav {
        display: inline-flex;
        gap: 6px;
        padding: 4px;
        margin-bottom: 22px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-full);
    }

    .app-nav-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-soft);
        text-decoration: none;
        border-radius: var(--radius-full);
        transition: background var(--transition), color var(--transition);
    }

    .app-nav-link:hover {
        color: var(--navy);
        background: var(--surface);
    }

    .app-nav-link.active {
        background: var(--navy);
        color: #fff;
    }

    /* —— Calendar —— */
    .calendar-toolbar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin-bottom: 16px;
        flex-wrap: wrap;
    }

    .calendar-month-title {
        margin: 0;
        min-width: 160px;
        text-align: center;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--navy);
        letter-spacing: -0.02em;
    }

    .calendar-nav-btn {
        padding: 8px 10px;
    }

    .calendar-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 16px;
        font-size: 0.8125rem;
        color: var(--text-soft);
    }

    .calendar-legend-item {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .calendar-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .calendar-dot-pending { background: var(--blue-mid); }
    .calendar-dot-overdue { background: var(--danger); }
    .calendar-dot-done { background: var(--success); }

    .calendar-grid {
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-md);
        overflow: hidden;
        background: var(--surface);
    }

    .calendar-weekdays,
    .calendar-week {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
    }

    .calendar-weekday {
        padding: 10px 8px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: center;
        color: var(--text-soft);
        background: var(--surface-raised);
        border-bottom: 1px solid var(--blue-line);
    }

    .calendar-week:not(:last-child) .calendar-day {
        border-bottom: 1px solid var(--blue-line);
    }

    .calendar-day {
        min-height: 100px;
        padding: 8px;
        border-right: 1px solid var(--blue-line);
        vertical-align: top;
    }

    .calendar-day:last-child { border-right: none; }

    .calendar-day-outside {
        background: var(--surface-raised);
        opacity: 0.55;
    }

    .calendar-day-today {
        background: var(--blue-pale);
    }

    .calendar-day-today .calendar-day-num {
        background: var(--navy);
        color: #fff;
    }

    .calendar-day-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--navy);
        border-radius: 50%;
        margin-bottom: 6px;
    }

    .calendar-tasks {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .calendar-task {
        display: block;
        padding: 3px 6px;
        font-size: 0.6875rem;
        font-weight: 600;
        line-height: 1.3;
        text-decoration: none;
        border-radius: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        border-left: 3px solid transparent;
        transition: opacity var(--transition);
    }

    .calendar-task:hover { opacity: 0.85; }

    .calendar-task-pending {
        color: #1d4ed8;
        background: #dbeafe;
        border-left-color: var(--blue-mid);
    }

    .calendar-task-overdue {
        color: #b91c1c;
        background: #fee2e2;
        border-left-color: var(--danger);
    }

    .calendar-task-done {
        color: #047857;
        background: #d1fae5;
        border-left-color: var(--success);
        text-decoration: line-through;
        opacity: 0.85;
    }

    /* —— Team / project members —— */
    .team-block {
        margin-top: 14px;
        padding: 14px 16px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-sm);
    }

    .team-avatars {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .team-member {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px 4px 4px;
        background: var(--surface);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-full);
        font-size: 0.8125rem;
    }

    .team-avatar {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--blue-mid), var(--blue));
        color: #fff;
        font-size: 0.6875rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .team-avatar-lg {
        width: 36px;
        height: 36px;
        font-size: 0.875rem;
    }

    .team-member-name {
        font-weight: 600;
        color: var(--navy);
    }

    .team-role {
        font-size: 0.6875rem;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    .team-role-badge {
        display: inline-block;
        margin-left: 6px;
        padding: 2px 8px;
        font-size: 0.6875rem;
        font-weight: 700;
        color: var(--blue);
        background: var(--blue-pale);
        border-radius: var(--radius-full);
        text-transform: uppercase;
    }

    .team-list {
        list-style: none;
        margin: 0 0 18px;
        padding: 0;
    }

    .team-list-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 10px 0;
        border-bottom: 1px solid var(--blue-line);
    }

    .team-list-item:last-child { border-bottom: none; }

    .team-list-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .team-list-info strong {
        display: block;
        color: var(--navy);
    }

    .team-add-form {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-end;
        gap: 10px;
        margin-top: 8px;
        padding-top: 16px;
        border-top: 1px solid var(--blue-line);
    }

    .project-task-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .project-task-item {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--blue-line);
    }

    .project-task-item:last-child { border-bottom: none; }

    /* —— Toolbar & filters —— */
    .toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        margin-bottom: 24px;
    }

    .filter-tabs {
        display: inline-flex;
        gap: 6px;
        padding: 4px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-full);
    }

    .filter-tabs a {
        padding: 8px 18px;
        text-decoration: none;
        color: var(--text-soft);
        font-size: 0.8125rem;
        font-weight: 600;
        border-radius: var(--radius-full);
        transition: background var(--transition), color var(--transition), box-shadow var(--transition);
    }

    .filter-tabs a:hover {
        color: var(--navy);
        background: var(--surface);
    }

    .filter-tabs a.active {
        background: var(--navy);
        color: #fff;
        box-shadow: var(--shadow-sm);
    }

    /* —— Buttons —— */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 18px;
        font-family: inherit;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        border-radius: var(--radius-sm);
        cursor: pointer;
        line-height: 1.2;
        transition: background var(--transition), color var(--transition), box-shadow var(--transition), transform 0.1s ease;
    }

    .btn:active { transform: scale(0.98); }

    .btn-primary {
        background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(12, 45, 90, 0.25);
    }

    .btn-primary:hover {
        box-shadow: 0 4px 14px rgba(12, 45, 90, 0.35);
    }

    .btn-outline {
        background: var(--surface);
        color: var(--navy);
        border: 1px solid var(--blue-line);
        box-shadow: var(--shadow-sm);
    }

    .btn-outline:hover {
        background: var(--blue-pale);
        border-color: var(--blue-mid);
    }

    .btn-blue {
        background: var(--blue-mid);
        color: #fff;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }

    .btn-blue:hover { background: #2563eb; }

    .btn-danger {
        background: var(--surface);
        color: var(--danger);
        border: 1px solid #fecaca;
    }

    .btn-danger:hover {
        background: var(--danger-bg);
        border-color: var(--danger);
    }

    .btn-sm { padding: 7px 12px; font-size: 0.8125rem; }

    .btn-icon svg { flex-shrink: 0; }

    /* —— Type badges —— */
    .type-tag {
        display: inline-flex;
        align-items: center;
        font-size: 0.625rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        padding: 4px 8px;
        border-radius: var(--radius-full);
        text-transform: uppercase;
    }

    .type-tag-task {
        color: #1d4ed8;
        background: #dbeafe;
        border: 1px solid #93c5fd;
    }

    .type-tag-project {
        color: #6d28d9;
        background: #ede9fe;
        border: 1px solid #c4b5fd;
    }

    /* —— Project cards —— */
    .project-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 16px;
    }

    .project-card {
        background: var(--surface);
        border: 1px solid #c4b5fd;
        border-left: 4px solid #7c3aed;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        transition: box-shadow var(--transition), border-color var(--transition);
        overflow: hidden;
    }

    .project-card:hover {
        box-shadow: var(--shadow-md);
        border-color: #a78bfa;
    }

    .project-card-top {
        padding: 18px 20px 14px;
        border-bottom: 1px solid #e9d5ff;
        background: linear-gradient(180deg, #faf5ff 0%, var(--surface) 100%);
    }

    .project-card-body { padding: 16px 20px 18px; }

    .project-actions {
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid #e9d5ff;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .project-actions form { display: inline; margin: 0; }

    .calendar-type-tabs {
        display: inline-flex;
        gap: 6px;
        padding: 4px;
        margin-bottom: 18px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-full);
    }

    .calendar-type-tab {
        padding: 8px 18px;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--text-soft);
        text-decoration: none;
        border-radius: var(--radius-full);
        transition: background var(--transition), color var(--transition);
    }

    .calendar-type-tab:hover { color: var(--navy); background: var(--surface); }
    .calendar-type-tab.active { background: var(--navy); color: #fff; }

    .calendar-dot-project { background: #7c3aed; }

    .calendar-task-project {
        color: #5b21b6;
        background: #ede9fe;
        border-left-color: #7c3aed;
    }

    .calendar-task-project-done {
        color: #047857;
        background: #d1fae5;
        border-left-color: var(--success);
        text-decoration: line-through;
        opacity: 0.85;
    }

    .calendar-task-project-overdue {
        color: #b91c1c;
        background: #fee2e2;
        border-left-color: var(--danger);
    }

    /* —— Task cards —— */
    .task-list {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 16px;
    }

    .task-card {
        background: var(--surface);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-sm);
        transition: box-shadow var(--transition), border-color var(--transition);
        overflow: hidden;
    }

    .task-card:hover {
        box-shadow: var(--shadow-md);
        border-color: #bfdbfe;
    }

    .task-card-top {
        padding: 18px 20px 14px;
        border-bottom: 1px solid var(--blue-line);
        background: linear-gradient(180deg, var(--surface-raised) 0%, var(--surface) 100%);
    }

    .task-card-title-row {
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
    }

    .task-card-head h2 {
        margin: 0;
        font-size: 1.0625rem;
        font-weight: 700;
        color: var(--navy);
        letter-spacing: -0.02em;
        line-height: 1.35;
    }

    .task-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
    }

    .task-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--text-soft);
        background: var(--blue-pale);
        border-radius: var(--radius-full);
        border: 1px solid var(--blue-line);
    }

    .chip svg {
        width: 13px;
        height: 13px;
        opacity: 0.7;
    }

    .chip-overdue {
        color: var(--danger);
        background: var(--danger-bg);
        border-color: #fecaca;
    }

    .task-card-body { padding: 16px 20px 18px; }

    .task-meta { font-size: 0.8125rem; color: var(--text-soft); }
    .task-meta strong { color: var(--navy); font-weight: 600; }

    .task-desc {
        margin: 0 0 14px;
        color: var(--text-soft);
        font-size: 0.9375rem;
        line-height: 1.55;
    }

    .status-tag {
        display: inline-flex;
        align-items: center;
        font-size: 0.6875rem;
        font-weight: 700;
        letter-spacing: 0.06em;
        padding: 4px 10px;
        border-radius: var(--radius-full);
        text-transform: uppercase;
    }

    .status-tag.pending {
        color: var(--warning);
        background: var(--warning-bg);
        border: 1px solid #fde68a;
    }

    .status-tag.done {
        color: var(--success);
        background: var(--success-bg);
        border: 1px solid #a7f3d0;
    }

    .status-tag.expired {
        color: var(--danger);
        background: var(--danger-bg);
        border: 1px solid #fecaca;
    }

    .task-actions {
        margin-top: 16px;
        padding-top: 14px;
        border-top: 1px solid var(--blue-line);
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }

    .task-actions form { display: inline; margin: 0; }

    .pdf-block {
        margin-top: 14px;
        padding: 14px 16px;
        background: var(--surface-raised);
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-sm);
    }

    .pdf-block-title {
        font-size: 0.6875rem;
        font-weight: 700;
        color: var(--text-soft);
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin: 0 0 10px;
    }

    .pdf-block ul { margin: 0; padding: 0; list-style: none; }
    .pdf-block li {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
        padding: 6px 0;
        border-bottom: 1px solid var(--blue-line);
        font-size: 0.875rem;
    }

    .pdf-block li:last-child { border-bottom: none; padding-bottom: 0; }

    .pdf-block a {
        color: var(--blue);
        font-weight: 600;
        text-decoration: none;
    }

    .pdf-block a:hover { color: var(--navy); text-decoration: underline; }

    /* —— Forms —— */
    .form-card { max-width: 560px; }

    .form-group { margin-bottom: 20px; }

    .form-group label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: var(--navy);
        margin-bottom: 6px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 11px 14px;
        font-family: inherit;
        font-size: 0.9375rem;
        border: 1px solid var(--blue-line);
        border-radius: var(--radius-sm);
        background: var(--surface);
        color: var(--text);
        transition: border-color var(--transition), box-shadow var(--transition);
    }

    input:focus, textarea:focus {
        outline: none;
        border-color: var(--blue-mid);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    textarea { min-height: 110px; resize: vertical; }
    .file-hint { font-size: 0.8125rem; color: var(--text-muted); margin: 6px 0 0; }

    .password-wrap { position: relative; }
    .password-wrap input { padding-right: 44px; }

    .password-toggle-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        padding: 0;
        border: none;
        border-radius: var(--radius-sm);
        background: transparent;
        color: var(--text-soft);
        cursor: pointer;
        transition: color var(--transition), background var(--transition);
    }

    .password-toggle-btn:hover {
        color: var(--navy);
        background: var(--blue-pale);
    }

    .password-toggle-btn .icon-eye-off { display: none; }
    .password-toggle-btn.is-visible .icon-eye { display: none; }
    .password-toggle-btn.is-visible .icon-eye-off { display: block; }

    .form-actions {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid var(--blue-line);
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .msg-box {
        padding: 14px 16px;
        margin-bottom: 20px;
        border-radius: var(--radius-sm);
        font-size: 0.875rem;
        border: 1px solid;
    }

    .msg-box.error {
        background: var(--danger-bg);
        border-color: #fecaca;
        color: #991b1b;
    }

    .msg-box.error ul { margin: 8px 0 0; padding-left: 18px; }

    .msg-box.success {
        background: var(--success-bg);
        border-color: #a7f3d0;
        color: #065f46;
    }

    .empty-state {
        text-align: center;
        padding: 56px 24px;
        color: var(--text-soft);
        border: 2px dashed var(--blue-line);
        border-radius: var(--radius-md);
        background: var(--surface-raised);
    }

    .empty-state-icon {
        width: 56px;
        height: 56px;
        margin: 0 auto 16px;
        color: var(--blue-mid);
        opacity: 0.6;
    }

    .empty-state p {
        margin: 0 0 18px;
        font-size: 1rem;
        font-weight: 500;
    }

    .site-footer {
        max-width: 1100px;
        margin: 0 auto;
        padding: 8px 24px 32px;
        font-size: 0.75rem;
        color: var(--text-muted);
        text-align: center;
    }

    a { color: var(--blue); text-decoration: none; }
    a:hover { color: var(--navy); }

    /* —— Auth pages —— */
    .auth-panel { max-width: 400px; margin: 0 auto; }
    .auth-panel .page-title { text-align: center; }
    .auth-panel .page-subtitle { text-align: center; margin-bottom: 24px; }

    .auth-links {
        margin-top: 20px;
        font-size: 0.875rem;
        text-align: center;
        color: var(--text-soft);
    }

    .auth-links a { font-weight: 600; }

    .remember-row {
        margin: 14px 0;
        font-size: 0.875rem;
        color: var(--text-soft);
    }

    .remember-row input { width: auto; margin-right: 6px; }

    .form-actions-between {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        margin-top: 24px;
    }

    /* —— Dark mode —— */
    html[data-theme="dark"] {
        --navy: #93c5fd;
        --blue: #60a5fa;
        --blue-mid: #3b82f6;
        --blue-light: #60a5fa;
        --blue-pale: #1e293b;
        --blue-line: #334155;
        --surface: #0f172a;
        --surface-raised: #1e293b;
        --text: #f1f5f9;
        --text-soft: #94a3b8;
        --text-muted: #64748b;
        --success-bg: #064e3b;
        --warning-bg: #451a03;
        --danger-bg: #450a0a;
        --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.3);
        --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.4);
        --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    html[data-theme="dark"] body {
        background: linear-gradient(160deg, #020617 0%, #0f172a 50%, #1e293b 100%);
    }

    html[data-theme="dark"] .site-header {
        background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
    }

    html[data-theme="dark"] .site-header img.logo { background: #fff; }

    html[data-theme="dark"] .page-panel,
    html[data-theme="dark"] .task-card {
        background: var(--surface);
        border-color: var(--blue-line);
    }

    html[data-theme="dark"] .task-card-top {
        background: linear-gradient(180deg, var(--surface-raised) 0%, var(--surface) 100%);
    }

    html[data-theme="dark"] .filter-tabs {
        background: var(--surface-raised);
    }

    html[data-theme="dark"] .filter-tabs a:hover {
        background: #334155;
        color: var(--text);
    }

    html[data-theme="dark"] .filter-tabs a.active {
        background: var(--blue-mid);
        color: #fff;
    }

    html[data-theme="dark"] .btn-primary {
        background: linear-gradient(135deg, #1d4ed8 0%, #3b82f6 100%);
        color: #fff;
    }

    html[data-theme="dark"] .btn-outline {
        background: var(--surface-raised);
        color: var(--text);
        border-color: var(--blue-line);
    }

    html[data-theme="dark"] .btn-outline:hover { background: #334155; }

    html[data-theme="dark"] .chip {
        background: var(--surface-raised);
        color: var(--text-soft);
    }

    html[data-theme="dark"] .status-tag.pending {
        color: #fbbf24;
        background: var(--warning-bg);
        border-color: #78350f;
    }

    html[data-theme="dark"] .status-tag.done {
        color: #34d399;
        background: var(--success-bg);
        border-color: #065f46;
    }

    html[data-theme="dark"] .status-tag.expired {
        color: #f87171;
        background: var(--danger-bg);
        border-color: #7f1d1d;
    }

    html[data-theme="dark"] .msg-box.error {
        color: #fca5a5;
        background: var(--danger-bg);
    }

    html[data-theme="dark"] .msg-box.success {
        color: #6ee7b7;
        background: var(--success-bg);
    }

    html[data-theme="dark"] input,
    html[data-theme="dark"] textarea,
    html[data-theme="dark"] input[type="file"] {
        background: #020617;
        color: var(--text);
        border-color: var(--blue-line);
    }

    html[data-theme="dark"] .empty-state {
        background: var(--surface-raised);
        border-color: var(--blue-line);
    }

    html[data-theme="dark"] .app-nav-link.active {
        background: var(--blue-mid);
        color: #fff;
    }

    html[data-theme="dark"] .calendar-day-today {
        background: #1e3a5f;
    }

    html[data-theme="dark"] .calendar-day-today .calendar-day-num {
        background: var(--blue-mid);
        color: #fff;
    }

    html[data-theme="dark"] .calendar-task-pending {
        color: #93c5fd;
        background: #1e3a5f;
    }

    html[data-theme="dark"] .calendar-task-overdue {
        color: #fca5a5;
        background: #450a0a;
    }

    html[data-theme="dark"] .calendar-task-done {
        color: #6ee7b7;
        background: #064e3b;
    }

    html[data-theme="dark"] .type-tag-task {
        color: #93c5fd;
        background: #1e3a5f;
        border-color: #3b82f6;
    }

    html[data-theme="dark"] .type-tag-project {
        color: #c4b5fd;
        background: #3b0764;
        border-color: #7c3aed;
    }

    html[data-theme="dark"] .project-card {
        border-color: #5b21b6;
        border-left-color: #a78bfa;
    }

    html[data-theme="dark"] .project-card-top {
        background: linear-gradient(180deg, #2e1065 0%, var(--surface) 100%);
        border-bottom-color: #5b21b6;
    }

    html[data-theme="dark"] .calendar-task-project {
        color: #c4b5fd;
        background: #3b0764;
    }

    html[data-theme="dark"] .calendar-type-tab.active {
        background: var(--blue-mid);
        color: #fff;
    }

    @media (max-width: 640px) {
        .page-body { padding: 20px 18px 28px; }
        .page-title { font-size: 1.5rem; }
        .user-name { display: none; }
        .task-card-top, .task-card-body, .project-card-top, .project-card-body { padding-left: 16px; padding-right: 16px; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .calendar-day { min-height: 72px; padding: 4px; }
        .calendar-task { font-size: 0.625rem; padding: 2px 4px; }
        .calendar-weekday { font-size: 0.625rem; padding: 6px 2px; }
    }
</style>
