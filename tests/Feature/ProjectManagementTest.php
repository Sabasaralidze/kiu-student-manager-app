<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_create_project_with_teammate(): void
    {
        $owner = User::factory()->create(['email' => 'owner@kiu.edu.ge']);
        $member = User::factory()->create(['email' => 'member@kiu.edu.ge']);

        $response = $this->actingAs($owner)->post(route('projects.store'), [
            'title' => 'Capstone Project',
            'description' => 'Team deliverable',
            'subject' => 'Web Programming',
            'deadline' => now()->addMonth()->toDateString(),
            'teammate_emails' => 'member@kiu.edu.ge',
        ]);

        $response->assertRedirect(route('projects.index'));

        $project = Project::first();
        $this->assertNotNull($project);
        $this->assertSame($owner->id, $project->user_id);
        $this->assertTrue($project->hasMember($member));
    }
}
