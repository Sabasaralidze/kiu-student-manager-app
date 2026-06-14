<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project): bool
    {
        return $project->isOwner($user) || $project->hasMember($user);
    }

    public function update(User $user, Project $project): bool
    {
        return $project->isOwner($user) || $project->hasMember($user);
    }

    public function delete(User $user, Project $project): bool
    {
        return $project->isOwner($user);
    }

    public function manageMembers(User $user, Project $project): bool
    {
        return $project->isOwner($user);
    }
}
