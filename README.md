# KIU Student Manager

A Laravel CRUD web application for managing academic **tasks** (with PDF attachments) and **team projects**, built for the KIU Web Programming final project.

## Features (syllabus mapping)

| Concept | Implementation |
|---------|----------------|
| **MVC** | Models, Blade views, controllers, policies |
| **Migrations** | `users`, `tasks`, `attachments`, `projects`, `project_user`, `student_profiles` |
| **Eloquent ORM** | Full model layer with relationships |
| **One-to-One** | `User` ↔ `StudentProfile` |
| **One-to-Many** | `User` → `Task`, `Task` → `Attachment`, `User` → `Project` |
| **Many-to-Many** | `Project` ↔ `User` (teammates via `project_user`) |
| **CRUD** | Tasks and Projects (create, read, update, delete) |
| **Blade** | Layouts, `@if`, `@foreach`, server-side rendering |
| **Authentication** | Register, login, logout, password reset |
| **Middleware** | `auth` / `guest` route protection |
| **Validation & CSRF** | Form validation + `@csrf` on all forms |
| **File uploads** | PDF attachments on tasks |
| **JSON API** | `GET /api/tasks`, `GET /api/tasks/{id}` (authenticated) |

## Requirements

- PHP 8.2+
- Composer
- SQLite (default) or MySQL

## Installation

```bash
git clone https://github.com/Sabasaralidze/kiu-student-manager-app.git
cd kiu-student-manager-app
composer install
cp .env.example .env   # Windows: copy .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed    # optional demo data
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000).

### Demo account (after `db:seed`)

| Email | Password |
|-------|----------|
| `demo@kiu.edu.ge` | `password` |
| `member@kiu.edu.ge` | `password` |

## Windows / OneDrive note

If `php artisan` fails because OneDrive locks files, uncomment the temp-path lines in `.env.example` and set paths under `%LOCALAPPDATA%\Temp\`.

## Password reset (local)

Set `MAIL_MAILER=log` in `.env` to write reset links to `storage/logs/laravel.log`, or configure Gmail SMTP in `.env.example`.

## Running tests

```bash
php artisan test
```

## JSON API

After logging in (session), authenticated users can read tasks as JSON:

| Method | URL | Description |
|--------|-----|-------------|
| GET | `/api/tasks` | List current user's tasks |
| GET | `/api/tasks/{id}` | Single task with attachments |

Example (while logged in via browser): open `http://localhost:8000/api/tasks`

## Project report

Full thesis draft with MVC and ER diagrams: `docs/PROJECT_REPORT.md`  
Diagram source files: `docs/diagrams/`  
Screenshots: `docs/screenshots/`

## Screenshots for thesis

Ready-made screenshots are in `docs/screenshots/` (see `SCREENSHOTS.txt` for suggested figure captions).

## Project structure

```
app/Models/          User, Task, Project, Attachment, StudentProfile
app/Http/Controllers TaskController, ProjectController, ProfileController, ...
app/Policies/        TaskPolicy, ProjectPolicy
database/migrations/ Schema definitions
resources/views/     Blade templates (tasks, projects, calendar, profile, auth)
routes/web.php       Application routes
routes/api.php       JSON API routes
docs/PROJECT_REPORT.md  Thesis / project report draft
```

## License

MIT — Laravel framework license applies to the underlying skeleton.
