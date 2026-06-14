<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();
        $projectsQuery = Project::forUser($user);

        $today = now()->startOfDay();

        $stats = [
            'pending' => (clone $projectsQuery)->where('status', 'pending')->count(),
            'overdue' => (clone $projectsQuery)->where('status', 'pending')
                ->whereDate('deadline', '<', $today)->count(),
            'completed_week' => (clone $projectsQuery)->where('status', 'done')
                ->where('updated_at', '>=', now()->startOfWeek())->count(),
            'team' => (clone $projectsQuery)->where('user_id', '!=', $user->id)->count(),
        ];

        $query = Project::forUser($user)->with(['owner', 'members']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $term = $request->q;
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                    ->orWhere('subject', 'like', "%{$term}%");
            });
        }

        if ($request->get('sort', 'deadline') === 'deadline') {
            $query->orderBy('deadline', 'asc');
        } else {
            $query->latest();
        }

        $projects = $query->get();

        return view('projects.index', compact('projects', 'stats'));
    }

    public function create(): View
    {
        return view('projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'subject' => 'required',
            'deadline' => 'required|date',
            'teammate_emails' => 'nullable|string',
        ]);

        $project = $request->user()->ownedProjects()->create([
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'status' => 'pending',
            'deadline' => $request->deadline,
        ]);

        $project->members()->attach($request->user()->id, ['role' => 'owner']);
        $this->syncTeammates($project, (string) ($request->input('teammate_emails') ?? ''), $request->user());

        return redirect()->route('projects.index');
    }

    public function edit(Project $project): View
    {
        $this->authorize('view', $project);

        $project->load(['owner', 'members']);

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $this->authorize('update', $project);

        if (! $project->isOwner($request->user())) {
            abort(403);
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'subject' => 'required',
            'deadline' => 'required|date',
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
            'subject' => $request->subject,
            'deadline' => $request->deadline,
        ]);

        return redirect()->route('projects.edit', $project)
            ->with('success', 'Project updated.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $this->authorize('delete', $project);

        $project->members()->detach();
        $project->delete();

        return redirect()->route('projects.index');
    }

    public function toggleStatus(Project $project): RedirectResponse
    {
        $this->authorize('update', $project);

        $project->status = $project->status === 'pending' ? 'done' : 'pending';
        $project->save();

        return redirect()->back();
    }

    public function addMember(Request $request, Project $project): RedirectResponse
    {
        $this->authorize('manageMembers', $project);

        $request->validate([
            'email' => 'required|email',
        ]);

        $teammate = User::where('email', strtolower($request->email))->first();

        if (! $teammate) {
            return back()->withErrors(['email' => 'No account found with that email. They must register first.']);
        }

        if ($teammate->id === $request->user()->id) {
            return back()->withErrors(['email' => 'You are already the project owner.']);
        }

        if ($project->hasMember($teammate)) {
            return back()->withErrors(['email' => 'This person is already on the team.']);
        }

        $project->members()->attach($teammate->id, ['role' => 'member']);

        return back()->with('success', $teammate->name.' added to the team.');
    }

    public function removeMember(Request $request, Project $project, User $member): RedirectResponse
    {
        $this->authorize('manageMembers', $project);

        if ($member->id === $project->user_id) {
            return back()->withErrors(['member' => 'The project owner cannot be removed.']);
        }

        if (! $project->hasMember($member)) {
            return back()->withErrors(['member' => 'This user is not on the team.']);
        }

        $project->members()->detach($member->id);

        return back()->with('success', $member->name.' removed from the team.');
    }

    private function syncTeammates(Project $project, string $emailsRaw, User $owner): void
    {
        $emails = collect(preg_split('/[\s,;]+/', $emailsRaw))
            ->map(fn ($email) => strtolower(trim($email)))
            ->filter()
            ->unique()
            ->reject(fn ($email) => $email === strtolower($owner->email));

        foreach ($emails as $email) {
            $teammate = User::where('email', $email)->first();

            if ($teammate && ! $project->hasMember($teammate)) {
                $project->members()->attach($teammate->id, ['role' => 'member']);
            }
        }
    }
}
