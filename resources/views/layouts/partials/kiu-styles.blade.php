<style>
    :root {
        --navy: #002855;
        --blue: #004b8d;
        --blue-mid: #1a6bb5;
        --blue-pale: #e8f0fa;
        --blue-line: #b8cfe8;
        --white: #ffffff;
        --text: #0a1f33;
        --text-soft: #3d5a73;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        font-family: Tahoma, "Segoe UI", Geneva, Verdana, sans-serif;
        font-size: 14px;
        color: var(--text);
        background: var(--blue-pale);
        line-height: 1.5;
    }

    .site-header {
        background: var(--navy);
        border-bottom: 4px solid var(--blue-mid);
    }

    .site-header-inner {
        max-width: 980px;
        margin: 0 auto;
        padding: 14px 24px;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .site-header img.logo {
        height: 58px;
        width: auto;
        background: var(--white);
        padding: 4px 8px;
        border: 1px solid var(--blue-line);
    }

    .site-header-text h1 {
        margin: 0;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 22px;
        font-weight: normal;
        color: var(--white);
        letter-spacing: 0.3px;
    }

    .site-header-text p {
        margin: 2px 0 0;
        font-size: 12px;
        color: #a8c4e0;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .header-brand-link {
        display: flex;
        align-items: center;
        gap: 18px;
        text-decoration: none;
        color: inherit;
        cursor: pointer;
    }

    .header-brand-link:hover {
        opacity: 0.92;
    }

    .header-brand-link .site-header-text h1,
    .header-brand-link .site-header-text p {
        color: inherit;
    }

    .page-wrap {
        max-width: 980px;
        margin: 0 auto;
        padding: 24px;
    }

    .page-panel {
        background: var(--white);
        border: 1px solid var(--blue-line);
        border-top: 3px solid var(--blue);
    }

    .page-body {
        padding: 24px 28px 32px;
    }

    .page-title {
        margin: 0 0 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--blue-line);
        font-family: Georgia, "Times New Roman", serif;
        font-size: 20px;
        font-weight: normal;
        color: var(--navy);
    }

    .toolbar {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 22px;
    }

    .filter-tabs {
        display: flex;
        gap: 0;
        border: 1px solid var(--blue-line);
    }

    .filter-tabs a {
        padding: 8px 16px;
        text-decoration: none;
        color: var(--text-soft);
        font-size: 13px;
        font-weight: bold;
        background: var(--white);
        border-right: 1px solid var(--blue-line);
    }

    .filter-tabs a:last-child { border-right: none; }
    .filter-tabs a:hover { background: var(--blue-pale); color: var(--navy); }
    .filter-tabs a.active { background: var(--navy); color: var(--white); }

    .btn {
        display: inline-block;
        padding: 8px 16px;
        font-family: inherit;
        font-size: 13px;
        font-weight: bold;
        text-decoration: none;
        border: 2px solid transparent;
        cursor: pointer;
        line-height: 1.2;
    }

    .btn-primary { background: var(--navy); color: var(--white); border-color: var(--navy); }
    .btn-primary:hover { background: var(--blue); border-color: var(--blue); }
    .btn-outline { background: var(--white); color: var(--navy); border-color: var(--navy); }
    .btn-outline:hover { background: var(--blue-pale); }
    .btn-blue { background: var(--blue); color: var(--white); border-color: var(--blue); }
    .btn-blue:hover { background: var(--blue-mid); border-color: var(--blue-mid); }
    .btn-sm { padding: 4px 10px; font-size: 12px; }

    .task-list { list-style: none; margin: 0; padding: 0; }
    .task-card { border: 1px solid var(--blue-line); margin-bottom: 14px; background: var(--white); }
    .task-card-head {
        background: var(--blue-pale);
        border-bottom: 1px solid var(--blue-line);
        padding: 10px 16px;
        display: flex;
        flex-wrap: wrap;
        align-items: baseline;
        justify-content: space-between;
        gap: 8px;
    }
    .task-card-head h2 {
        margin: 0;
        font-family: Georgia, "Times New Roman", serif;
        font-size: 17px;
        font-weight: bold;
        color: var(--navy);
    }
    .task-meta { font-size: 12px; color: var(--text-soft); }
    .task-meta strong { color: var(--navy); }
    .task-card-body { padding: 14px 16px 16px; }
    .task-desc { margin: 0 0 12px; }

    .status-tag {
        display: inline-block;
        font-size: 11px;
        font-weight: bold;
        letter-spacing: 0.5px;
        padding: 2px 8px;
        border: 1px solid;
        text-transform: uppercase;
    }
    .status-tag.pending { color: var(--blue); border-color: var(--blue); background: var(--white); }
    .status-tag.done { color: var(--white); border-color: var(--navy); background: var(--navy); }
    .status-tag.expired { color: var(--navy); border-color: var(--blue-mid); background: var(--blue-pale); margin-left: 6px; }

    .task-actions {
        margin-top: 14px;
        padding-top: 12px;
        border-top: 1px dashed var(--blue-line);
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        align-items: center;
    }
    .task-actions form { display: inline; margin: 0; }

    .pdf-block {
        margin-top: 12px;
        padding: 10px 12px;
        background: var(--blue-pale);
        border: 1px dashed var(--blue-line);
    }
    .pdf-block-title {
        font-size: 12px;
        font-weight: bold;
        color: var(--navy);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin: 0 0 8px;
    }
    .pdf-block ul { margin: 0; padding: 0 0 0 18px; }
    .pdf-block li { margin-bottom: 4px; }
    .pdf-block a { color: var(--blue); font-weight: bold; }
    .pdf-block a:hover { color: var(--navy); }

    .form-card { max-width: 640px; }
    .form-group { margin-bottom: 18px; }
    .form-group label {
        display: block;
        font-size: 12px;
        font-weight: bold;
        color: var(--navy);
        text-transform: uppercase;
        letter-spacing: 0.4px;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="date"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 9px 10px;
        font-family: inherit;
        font-size: 14px;
        border: 1px solid var(--blue-line);
        background: var(--white);
        color: var(--text);
    }

    input:focus, textarea:focus {
        outline: 2px solid var(--blue);
        outline-offset: 0;
        border-color: var(--blue);
    }

    textarea { min-height: 100px; resize: vertical; }
    .file-hint { font-size: 12px; color: var(--text-soft); margin: 5px 0 0; }

    .password-wrap {
        position: relative;
    }

    .password-wrap input {
        padding-right: 44px;
    }

    .password-toggle-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        padding: 0;
        border: none;
        background: transparent;
        color: var(--text-soft);
        cursor: pointer;
    }

    .password-toggle-btn:hover {
        color: var(--navy);
    }

    .password-toggle-btn .icon-eye-off { display: none; }
    .password-toggle-btn.is-visible .icon-eye { display: none; }
    .password-toggle-btn.is-visible .icon-eye-off { display: block; }

    .form-actions {
        margin-top: 24px;
        padding-top: 18px;
        border-top: 1px solid var(--blue-line);
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .msg-box {
        padding: 12px 14px;
        margin-bottom: 18px;
        border: 1px solid;
        font-size: 13px;
    }
    .msg-box.error { background: #f5f9ff; border-color: var(--blue); color: var(--navy); }
    .msg-box.error ul { margin: 6px 0 0; padding-left: 18px; }
    .msg-box.success { background: var(--blue-pale); border-color: var(--blue-line); color: var(--navy); }

    .empty-state {
        text-align: center;
        padding: 40px 20px;
        color: var(--text-soft);
        border: 1px dashed var(--blue-line);
        background: var(--blue-pale);
    }
    .empty-state p { margin: 0 0 14px; }

    .site-footer {
        max-width: 980px;
        margin: 0 auto;
        padding: 12px 24px 28px;
        font-size: 11px;
        color: var(--text-soft);
        text-align: center;
    }

    a { color: var(--blue); }
    a:hover { color: var(--navy); }

    /* —— Theme toggle —— */
    .header-tools {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .theme-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        padding: 0;
        border: 1px solid #a8c4e0;
        border-radius: 4px;
        background: transparent;
        color: var(--white);
        cursor: pointer;
    }

    .theme-toggle:hover {
        background: var(--blue);
        border-color: var(--blue);
    }

    .theme-toggle .icon-moon { display: none; }
    html[data-theme="dark"] .theme-toggle .icon-sun { display: none; }
    html[data-theme="dark"] .theme-toggle .icon-moon { display: block; }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-icon svg {
        flex-shrink: 0;
    }

    /* —— Dark mode —— */
    html[data-theme="dark"] {
        --navy: #6eb3f7;
        --blue: #4a9ae6;
        --blue-mid: #7ec0ff;
        --blue-pale: #152238;
        --blue-line: #2a4568;
        --white: #0f1a2e;
        --text: #e8f0fa;
        --text-soft: #a8c4e0;
    }

    html[data-theme="dark"] body {
        background: #0a1220;
    }

    html[data-theme="dark"] .site-header {
        background: #061018;
        border-bottom-color: var(--blue);
    }

    html[data-theme="dark"] .site-header img.logo {
        background: #fff;
    }

    html[data-theme="dark"] .page-panel,
    html[data-theme="dark"] .task-card,
    html[data-theme="dark"] .filter-tabs a {
        background: var(--white);
    }

    html[data-theme="dark"] .task-card-head,
    html[data-theme="dark"] .pdf-block,
    html[data-theme="dark"] .empty-state,
    html[data-theme="dark"] .msg-box.success {
        background: var(--blue-pale);
    }

    html[data-theme="dark"] .filter-tabs a:hover {
        background: #1e3352;
    }

    html[data-theme="dark"] .filter-tabs a.active {
        background: var(--blue);
        color: #061018;
    }

    html[data-theme="dark"] .btn-primary {
        background: var(--blue);
        color: #061018;
        border-color: var(--blue);
    }

    html[data-theme="dark"] .btn-outline {
        background: transparent;
        color: var(--navy);
        border-color: var(--navy);
    }

    html[data-theme="dark"] .btn-outline:hover {
        background: var(--blue-pale);
    }

    html[data-theme="dark"] .status-tag.pending {
        background: var(--white);
        color: var(--blue-mid);
    }

    html[data-theme="dark"] .status-tag.done {
        background: var(--blue);
        color: #061018;
        border-color: var(--blue);
    }

    html[data-theme="dark"] .msg-box.error {
        background: #152238;
        color: var(--text);
    }

    html[data-theme="dark"] input,
    html[data-theme="dark"] textarea,
    html[data-theme="dark"] input[type="file"] {
        background: #0a1220;
        color: var(--text);
        border-color: var(--blue-line);
    }

</style>
