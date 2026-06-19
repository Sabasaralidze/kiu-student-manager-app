<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_tasks(): void
    {
        $this->get('/tasks')->assertRedirect('/login');
    }

    public function test_authenticated_user_can_create_task(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/tasks', [
            'title' => 'New assignment',
            'description' => 'Finish lab work',
            'subject' => 'Programming',
            'deadline' => now()->addWeek()->toDateString(),
        ]);

        $response->assertRedirect('/tasks');
        $this->assertDatabaseHas('tasks', [
            'user_id' => $user->id,
            'title' => 'New assignment',
            'status' => 'pending',
        ]);
    }

    public function test_user_cannot_edit_another_users_task(): void
    {
        $owner = User::factory()->create();
        $other = User::factory()->create();
        $task = Task::create([
            'user_id' => $owner->id,
            'title' => 'Private task',
            'description' => 'Only owner',
            'subject' => 'Math',
            'status' => 'pending',
            'deadline' => now()->addDay()->toDateString(),
        ]);

        $this->actingAs($other)
            ->get('/tasks/'.$task->id.'/edit')
            ->assertForbidden();
    }
}
